<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportItem extends Model
{
    const IN_PROGRESS = 1;
    const DONE = 2;
    const FAIL = 3;
    protected $fillable = [
        'import_id',
        'status',
        'product_id',
        'product_name',
        'error_message'
    ];

    public function getImportStatusAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'Waiting';
                break;
            case 1:
                return 'In progress';
                break;
            case 2:
                return 'Success';
                break;
            case 3:
                return 'Fail';
                break;
        }
    }
}
