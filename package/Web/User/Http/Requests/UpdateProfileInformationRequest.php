<?php

namespace Web\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
        $userId = $this->route('user')->id;
        return [
            "name" => "required|min:3|max:190",
            "email" => ['required','min:3','max:190',Rule::unique('users')->ignore($userId)],
            "username" => ['nullable','min:3','max:190',Rule::unique('users')->ignore($userId)],
            "mobile" => ['nullable','regex:/[0]{1}[0-9]{10}/',Rule::unique('users')->ignore($userId)],
            "password" => ['nullable',new ValidationPassword()]
        ];
    }


}
