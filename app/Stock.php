<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'amount',
        'date',
        'product_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
