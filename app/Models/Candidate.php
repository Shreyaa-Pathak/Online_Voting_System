<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Election;
use App\Models\Vote;

class Candidate extends Model
{
    protected $fillable = ['election_id','candidatename', 'partyname', 'address', 'candidatenumber','photo'];

    public function election()
{
    return $this->belongsTo(Election::class);
}
public function votes()
{
    return $this->hasMany(Vote::class);
}

}
