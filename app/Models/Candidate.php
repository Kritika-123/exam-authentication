<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $fillable = [
        'name',
        'aadhar_number',
        'fingerprint_hash',
        'email', // email is required for sending emails
        'phone', // Include phone here
        'photo'  // Include photo in the fillable property if needed
    ];

    public function hallTicket()
    {
        return $this->hasOne(HallTicket::class);
    }
}

