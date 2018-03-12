<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;
    protected $fillable = ['filename', 'product_id', 'featured'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute()
    {
        $path = 'storage/image/';
        $path .= $this->filename;
        return asset($path);
    }
}

