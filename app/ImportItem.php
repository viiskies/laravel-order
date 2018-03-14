<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportItem extends Model
{
    const WAITING = 0;
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
            case ImportItem::WAITING:
                return 'Waiting';
                break;
            case ImportItem::IN_PROGRESS:
                return 'In progress';
                break;
            case ImportItem::DONE:
                return 'Success';
                break;
            case ImportItem::FAIL:
                return 'Fail';
                break;
        }
    }
}
