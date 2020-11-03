<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'=>'required|max:100',
            'nickname'=>'required|max:100|exists:users,nickname',
            'title'=>'required|max:100',
            'date_of_birth'=>'required',
            'city'=>'required|max:100',
            'state'=>'required|max:100',
            'country'=>'required|max:100',
            'postal_or_zip_code'=>'required|max:100',
            'timezone'=>'required|max:100',
            'role'=>'required',
            'receive_email_updates'=>'required',
        ];
    }
}
