<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $fillable = [
        'product_name',
        
    ];

    /**
     * The ingridients that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ingridients()
    {
        return $this->belongsToMany(Ingridient::class);
    }
}
