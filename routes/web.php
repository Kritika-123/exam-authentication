<?php

use Illuminate\Support\Facades\Route;



use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;

// Candidate routes
Route::get('/register', [CandidateController::class, 'showForm']);
Route::post('/register', [CandidateController::class, 'register']);
Route::get('/generate/{id}', [CandidateController::class, 'generateHallTicket']);
Route::get('/verify', [CandidateController::class, 'verifyForm']);
Route::post('/verify', [CandidateController::class, 'verify']);

// Admin routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/logout', [AdminController::class, 'logout']);

use App\Http\Controllers\HallTicketController;



Route::get('/hallticket/{id}', [CandidateController::class, 'showHallTicket'])->name('hallticket.show');

Route::get('/test-email', function () {
    // Assuming you have a candidate with ID 1 in your database
    $candidate = App\Models\Candidate::find(1);

    // Ensure $candidate is not null
    if ($candidate) {
        $qrCodePath = 'qr_codes/hallticket_' . $candidate->id . '.svg';  // Correct QR Code path

        Mail::to('k91114111@gmail.com')->send(new \App\Mail\CandidateRegistered($candidate, $qrCodePath));

        return 'Test email sent';
    } else {
        return 'Candidate not found.';
    }
});
