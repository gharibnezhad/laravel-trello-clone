<?php

namespace Web\Task\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Web\Task\Models\Task;


class
UpdateTaskRequest extends FormRequest
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
            'title' => trim($this->input('title')),
            'description' => $this->filled('description') ? trim($this->input('description')) : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $task = $this->route('task');
        return [
            'board_id' => ['required', 'integer', 'exists:boards,id'],
            'task_list_id' => ['required', 'integer',
                Rule::exists('task_lists','id')->where(fn($q) =>
                $q->where('board_id',$this->board_id)),],
            'title' => ['required','string','min:3','max:255'],
            'description' =>['nullable','string','max:2000'],
            'due_time' => ['required','date','after_or_equal:'.$task->due_time],
            'order' => ['required','integer','min:1'],
            'priority' => ['required',Rule::in(Task::$priority)],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'نام تسک الزامی است.',
            'title.min' => 'نام تسک باید حداقل ۳ کاراکتر باشد.',
            'board_id.required' => 'انتخاب برد الزامی است.',
            'task_list_id.required' => 'انتخاب تسک لیست الزامی است.',
            'description.string' => 'توضیحات باید به صورت متن باشد.',
            'description.max' => 'توضیحات باید حداکثر :max کاراکتر باشد.',
            'due_time.after_or_equal' => 'تاریخ تحویل جدید باید بعد یا برابر تاریخ فعلی باشد.'
        ];
    }
}
