<?php

namespace App\Models;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Election;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'election_id',
        'candidate_id',
        'commitment',
        'encrypted_vote',
        'tampered'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
    public function election()
    {
        return $this->belongsTo(Election::class);
    }
}
