<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public $timestamps = false;
    protected $fillable = ['quantity','product_id','price'];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
