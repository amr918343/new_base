<?php

namespace App\Http\Requests\API\Dashboard\Admin;

use App\Http\Requests\ApiMasterRequest;

class AdminRequest extends ApiMasterRequest
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
        $admin = $this->admin;
        $required = $this->admin ? '' : 'required';
        return [
            'fullname' => $required . '|string|between:2,100',
            'phone' => $required .  '|numeric|digits_between:5,20|unique:users,phone,' . $admin,
            'age' => $required . '|numeric|between:1,100',
            'is_active' => 'nullable|in:1,0',
            'is_ban' => 'nullable|in:1,0',
            'ban_reason' => 'nullable|string|between:3,10000',
            'gender' => $required . '|in:male,female',
            'email' => $required .  '|email|unique:users,email,' . $admin,
            'password' => '|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp',
        ];
    }
}
