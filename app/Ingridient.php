<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingridient extends Model
{

use SoftDeletes;

    protected $fillable = [
        'ingridient_name',
    ];

    protected $guarded = [];

    /**
     * The products that belong to the Ingridient
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
