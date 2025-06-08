<?php

namespace Web\Project\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required','string','min:3','max:255'],
            'slug' => ['required','string','max:255','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/','unique:projects,slug'],
            'description' =>['nullable','string'],
            'category_id' => ['nullable','exists:categories,id']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام پروژه الزامی است.',
            'name.min' => 'نام پروژه باید حداقل ۳ کاراکتر باشد.',
            'slug.required' => 'نام انگلیسی پروژه الزامی است.',
            'slug.unique' => 'این نام انگلیسی قبلاً استفاده شده است.',
            'slug.regex' => 'نام انگلیسی باید فقط شامل حروف کوچک، اعداد و خط تیره باشد.',
            'description.string' => 'توضیحات باید به صورت متن باشد.',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
        ];
    }
}
