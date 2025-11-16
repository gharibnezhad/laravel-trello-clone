<?php

namespace Web\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Web\User\Rules\ValidationPassword;

class UpdateProfileInformationRequest extends FormRequest
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
        $userId = $this->route('id');
        return [
            "name" => "required|min:3|max:190",
            "email" => "required|min:3|max:190|unique:users,email,{$userId}",
            "username" => "nullable|min:3|max:190|unique:users,username,{$userId}",
            "mobile" => "nullable|unique:users,mobile,{$userId}",
            "password" => ['nullable',new ValidationPassword()]
        ];
    }


}
