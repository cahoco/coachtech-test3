<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => ['required', 'date'],
            'weight' => ['required','numeric',
                function ($attribute, $value, $fail) {
                    $input = request()->input($attribute);
                    if (strlen((string)(int)$value) > 4) {
                        $fail('4桁までの数字で入力してください');
                    }
                    if (preg_match('/^\d+(\.\d{2,})$/', $input)) {
                        $fail('小数点は1桁で入力してください');
                    }
                },
            ],
            'calories' => ['required', 'numeric'],
            'exercise_time' => ['required'],
            'exercise_content' => ['nullable', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください。',
            'weight.required' => '体重を入力してください。',
            'weight.numeric' => '数字で入力してください。',
            'calories.required' => '摂取カロリーを入力してください。',
            'calories.numeric' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください。',
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }

    public function getRedirectUrl()
    {
        if ($this->route('id')) {
            $page = $this->input('page');
            return url('/weight_logs/' . $this->route('id')) . ($page ? '?page=' . $page : '');
        }

        return url('/weight_logs?modal=open');
    }
}
