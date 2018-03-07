<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'platform_id',
        'publisher_id',
        'ean',
        'description',
        'release_date',
        'video',
        'pegi'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function price()
    {
        return $this->hasMany(Price::class);
    }
}
