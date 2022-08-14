<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'Vote';
    protected $fillable = ['voter', 'candidate'];

    public $timestamps = false;
}