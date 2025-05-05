<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Candidate;

class Election extends Model
{
    protected $fillable = ['name', 'end_date'];

    public function candidates()
    {
    return $this->hasMany(Candidate::class);
    }
    public function votes() {
        return $this->hasMany(Vote::class);
    }

}
