<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Product;

class StockTrace extends Model
{
    protected $fillable = ['product_id', 'amount', 'user_id'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
