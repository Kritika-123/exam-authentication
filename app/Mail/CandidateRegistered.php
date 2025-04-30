<?php
namespace App\Mail;

use App\Models\Candidate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $candidate;
    public $qrCodePath;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Candidate  $candidate
     * @param  string  $qrCodePath
     * @return void
     */
    public function __construct(Candidate $candidate, $qrCodePath)
    {
        $this->candidate = $candidate;
        $this->qrCodePath = $qrCodePath;
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->view('emails.candidate_registered')
                    ->subject('Candidate Registration Successful')
                    ->with([
                        'candidate' => $this->candidate,
                        'qrCodePath' => $this->qrCodePath,
                    ]);
    }
}
