<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends \Eloquent
{
    public $timestamps = false;
    protected $fillable = [

        'coursetitle',
        'cdesc',
        'requirements',
        'forWhom',
        'image'
    ];
}
