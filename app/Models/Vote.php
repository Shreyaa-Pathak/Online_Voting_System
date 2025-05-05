<?php

namespace App\Models;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Election;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['user_id', 'election_id', 'candidate_id'];

    public function candidate()
    {
       return $this->belongsTo(Candidate::class);
    }
    public function user()
     {
        return $this->belongsTo(User::class);
    }
    public function election() 
    {
        return $this->belongsTo(Election::class);
    }
}
