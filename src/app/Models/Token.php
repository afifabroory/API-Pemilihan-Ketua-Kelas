<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'token';
    protected $fillable = ['Voter_NIM', 'token'];

    public $timestamps = false;
}