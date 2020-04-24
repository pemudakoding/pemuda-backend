<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppRequest extends FormRequest
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
            'app_name'  => 'required|max:191',
            'mimetypes' => 'mimetypes:image/jpg,image/png',
            'email'     => 'required|email',
            'number'    => 'required',
            'address'   => 'required',
            'facebook'  => 'nullable',
            'instagram' => 'nullable',
            'twitter'   => 'nullable'
        ];
    }
}
