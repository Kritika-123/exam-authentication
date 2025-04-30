<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\HallTicket;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\CandidateRegistered;

class CandidateController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'aadhar_number' => 'required|unique:candidates',
            'fingerprint_hash' => 'required',
            'email' => 'required|email|unique:candidates,email',
            'phone' => 'required|digits:10',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validate photo
        ], [
            'name.required' => 'Please enter your name.',
            'aadhar_number.required' => 'Aadhar number is required.',
            'email.required' => 'Email address is required.',
          
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = $photo->storeAs('photos', $photoName, 'public');  
        } else {
            $photoPath = null;
        }
        $candidate = Candidate::create([
            'name' => $request->name,
            'aadhar_number' => $request->aadhar_number,
            'fingerprint_hash' => $request->fingerprint_hash,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo' => $photoPath,  // Save photo path
        ]);

        $this->generateHallTicket($candidate->id);

        $qrCodePath = 'qr_codes/hallticket_' . $candidate->id . '.svg';

        try {
            Mail::to($candidate->email)->send(new CandidateRegistered($candidate, $qrCodePath));
            Log::info('Email sent successfully to: ' . $candidate->email);
        } catch (\Exception $e) {
            Log::error('Error sending email to: ' . $candidate->email . ' - ' . $e->getMessage());
            return back()->with('error', 'There was an error sending the email. Please try again later.');
        }

        return redirect()->route('hallticket.show', ['id' => $candidate->id])->with('success', 'Registration successful and email sent!');
    }

    public function generateHallTicket($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);

        $data = "CandidateID:$candidate->id;Aadhar:$candidate->aadhar_number;Time:" . now();

        $folder = public_path('qr_codes');
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }

        $filename = "qr_codes/hallticket_$candidateId.svg";

        $qrCode = QrCode::format('svg')->size(200)->generate($data);

        file_put_contents(public_path($filename), $qrCode);

        HallTicket::create([
            'candidate_id' => $candidateId,
            'qr_code_path' => $filename,
        ]);

        return "✅ Hall Ticket QR Code generated for Candidate ID: $candidateId";
    }

    public function verifyForm()
    {
        return view('verify');
    }

    public function verify(Request $request)
    {
        $candidate = Candidate::where('aadhar_number', $request->aadhar_number)->first();

        if ($candidate && $candidate->fingerprint_hash === $request->fingerprint_hash) {
            
            $hallTicket = HallTicket::where('candidate_id', $candidate->id)->first();

            if ($hallTicket) {
                return view('hallticket', compact('hallTicket', 'candidate'));
            } else {
                return view('verify_result', [
                    'status' => false,
                    'message' => "❌ No hall ticket found for this candidate."
                ]);
            }
        }

        // Authentication failed
        return view('verify_result', [
            'status' => false,
            'message' => "❌ Authentication Failed"
        ]);
    }

    public function showHallTicket($id)
    {
        $hallTicket = HallTicket::where('candidate_id', $id)->first();

        if (!$hallTicket) {
            return "❌ No hall ticket found for Candidate ID: $id";
        }

        $candidate = Candidate::find($id);
        return view('hallticket', compact('hallTicket', 'candidate'));
    }
}
