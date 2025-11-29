<?php

namespace Web\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'title' => $this->filled('title') ? trim($this->title) : $this->title,
            'slug' => $this->filled('slug') ? Str::slug($this->slug) : $this->slug,
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required','string','min:3','max:255'],
            'slug' => ['required','string','min:3','max:255','regex:/^[a-z0-9\-]+$/',
                Rule::unique('categories','slug')->ignore($this->category->id)],
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'عنوان دسته بندی الزامی است.',
            'title.min' => 'عنوان دسته بندی باید حداقل ۳ کاراکتر باشد.',
            'slug.required' => 'نام انگلیسی دسته بندی الزامی است.',
            'slug.min' => 'نام انگلیسی دسته بندی باید حداقل ۳ کاراکتر باشد.',
            'slug.unique' => 'این نام انگلیسی قبلاً استفاده شده است.',
            'slug.regex' => 'نام انگلیسی باید شامل حروف کوچک، اعداد و - باشد.',
        ];
    }
}
