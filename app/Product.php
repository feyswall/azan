<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    protected $fillable = [
        'product_name',
        'product_cost',
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

    /**
     * The sales that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * The stocks that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function stockTraces()
    {
        return $this->belongsToMany(Stock::class);
    }
}
