<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['paid_money', 'total_amount','received_amount', 'remain_amount', 'remain_money', 'total_money', 'user_id', 'product_id', 'who_buys'];
    /**
     * Get the user that owns the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The sales that belong to the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
/**
 * The products that belong to the Sale
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
public function product()
{
    return $this->belongsTo(Product::class);
}
}
