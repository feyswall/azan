<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingridient extends Model
{
    protected $fillable = [
        'ingridient_name',
    ];

    protected $guarded = [];
}
