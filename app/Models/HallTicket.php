<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallTicket extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'candidate_id',
        'qr_code_path',
    ];

    /**
     * A hall ticket belongs to a candidate.
     */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
