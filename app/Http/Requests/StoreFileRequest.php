<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|file|mimetypes:application/vnd.ms-excel,' .
            'text/xml,' .
            'application/msexcel,' .
            'application/x-msexcel,' .
            'application/x-ms-excel,' .
            'application/x-excel,' .
            'application/x-dos_ms_excel,' .
            'application/xls,' .
            'application/x-xls,' .
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];
    }
}
