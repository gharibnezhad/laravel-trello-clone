<?php

namespace Web\Board\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Web\Board\Models\Board;


class BoardRequest extends FormRequest
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
            'name' => $this->has('name')
                ? trim($this->input('name')) : null,
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
            'project_id' => ['required','exists:projects,id'],
            'position' => ['required','integer','min:0'],
            'visibility' => ['required','string',Rule::in(array_values(Board::getVisibilities()))]
        ];
    }

    public function attributes()
    {
        return [
            'visibility' => 'قابلیت مشاهده',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام برد الزامی است.',
            'name.min' => 'نام برد باید حداقل ۳ کاراکتر باشد.',
            'project_id.required' => 'انتخاب پروژه الزامی است.',
            'position.required' => 'عدد ترتیب نمایش الزامی می باشد.',
            'position.integer' => 'عدد ترتیب نمایش باید از اعداد صحیح باشد.',
            'visibility.in' => 'قابلیت مشاهده نامعتبر است.',
        ];
    }
}
