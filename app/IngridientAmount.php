<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngridientAmount extends Model
{
    protected $fillable = ['product_id', 'ingridient_id', 'amount'];
}
