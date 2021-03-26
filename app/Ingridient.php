<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingridient extends Model
{
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
