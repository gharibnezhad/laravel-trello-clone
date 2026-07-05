<?php

namespace Web\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Web\User\Rules\ValidationPassword;

class ConfirmPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'current_password'=>['required', 'current_password']
        ];
    }


}
