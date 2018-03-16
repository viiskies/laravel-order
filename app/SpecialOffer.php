<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    protected $fillable = [
        'client_id',
        'expiration_date'
    ];
    public $timestamps = false;

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
}
