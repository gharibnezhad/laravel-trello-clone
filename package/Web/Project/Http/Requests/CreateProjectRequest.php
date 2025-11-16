<?php

namespace Web\Project\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class CreateProjectRequest extends FormRequest
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
            'name' => $this->has('name') ? trim($this->input('name')) : null,
            'slug' => $this->filled('slug') ?
                Str::slug($this->input('slug'))
                : ($this->filled('name') ? Str::slug($this->input('name')) : null),

            'visibility' => $this->input('visibility') ?? 'public',
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
            'name' => ['required','string','min:3','max:255'],
            'slug' => ['required','string','max:255','regex:/^[a-z0-9\-]+$/',Rule::unique('projects')],
            'description' =>['required','string','min:3','max:2000'],
            'category_id' => ['nullable','exists:categories,id'],
            'visibility' => ['string','in:public,private'],
            'file' => ['required','image','mimes:jpg,png,jpeg'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام پروژه الزامی است.',
            'name.min' => 'نام پروژه باید حداقل ۳ کاراکتر باشد.',
            'slug.required' => 'نام انگلیسی پروژه الزامی است.',
            'slug.unique' => 'این نام انگلیسی قبلاً استفاده شده است.',
            'slug.regex' => 'نام انگلیسی باید شامل حروف کوچک، اعداد و - باشد.',
            'description.string' => 'توضیحات باید به صورت متن باشد.',
            'description.max' => 'توضیحات باید حداکثر :max کاراکتر باشد.',
            'category_id.exists' => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
            'file.required' => 'عکس پروژه الزامی است.',
            'file.image' => 'فایل انتخاب شده باید یک تصویر باشد.',
            'file.mimes' => 'عکس آپلود شده باید از نوع jpg,png,jpeg.',
            'visibility.in' => 'قابلیت مشاهده نامعتبر است.',
        ];
    }
}
