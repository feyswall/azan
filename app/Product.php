<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ingridient;
use App\Sale;
use App\Stock;
use App\stockTraces;


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
        return $this->hasMany(StockTrace::class);
    }
}
