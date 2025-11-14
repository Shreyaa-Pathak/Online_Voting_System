<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreapprovedUser extends Model
{
    use HasFactory;

    protected $table = 'preapproved_users';

    protected $fillable = [
        'name',
        'email',
        'dob',
        'phonenumber',
        'key_hash',
    ];
}
