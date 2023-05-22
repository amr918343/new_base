<?php

namespace App\Http\Requests\General;

use App\Http\Requests\ApiMasterRequest;

class FilterRequest extends ApiMasterRequest
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
            'per_page' => 'integer|between:1,1000',
        ];
    }
}
