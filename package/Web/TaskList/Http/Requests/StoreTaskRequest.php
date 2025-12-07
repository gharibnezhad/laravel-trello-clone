<?php

namespace Web\TaskList\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreTaskRequest extends FormRequest
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
            'name' => trim($this->input('name')),]);
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
            'position' => ['required','integer'],
            'board_id' =>['required','exists:boards,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام تسک لیست الزامی است.',
            'name.min' => 'نام تسک لیست باید حداقل ۳ کاراکتر باشد.',
            'position.required' => 'مقدار ترتیب نمایش الزامی است.',
            'position.integer' => 'مقدار ترتیب نمایش باید از اعداد صحیح باشد.',
            'board_id.required' => 'انتخاب برد الزامی است.',
        ];
    }
}
