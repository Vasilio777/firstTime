<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lection extends \Eloquent
{
    protected $fillable = [
        'idcourse',
        'ltitle',
        'ldesc'
    ];
    public $timestamps = false;
}
