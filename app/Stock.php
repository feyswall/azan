<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Stock extends Model
{
    protected $fillable = ['product_id', 'amount', 'user_id'];

    /**
     * Get the product associated with the stock
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
