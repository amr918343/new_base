<?php

namespace App\Http\Requests\API\Dashboard\Admin\Auth;

use App\Http\Requests\General\ApiMasterRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends ApiMasterRequest
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
     * Validate identifier for phone or email according to the user input.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identifier' => [
                'required'
            ],
            'password' => ['required'],
        ];
    }

    // public function getValidatorInstance()
    // {
    //     $data = $this->all();
    //     if (isset($data['identifier']) && $data['identifier']) {
    //         $data['identifier'] = filter_mobile_number($data['identifier']);
    //         $this->getInputSource()->replace($data);
    //     }
    //     return parent::getValidatorInstance();
    // }
}
