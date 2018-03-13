<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $fillable = [
        'status'
    ];

    public function items()
    {
        return $this->hasMany(ImportItem::class);
    }
}
