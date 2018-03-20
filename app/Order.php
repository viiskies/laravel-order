<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PENDING = 0;
    const UNCONFIRMED = 1;
    const CONFIRMED = 2;
    public $timestamps = false;
    protected $fillable = ['status'];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeAsCart($query)
    {
        return $query->where('status', Order::UNCONFIRMED);
    }
	
	public function scopeInCart($query)
	{
		return $query->where('status', Order::PENDING);
	}

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }
}
