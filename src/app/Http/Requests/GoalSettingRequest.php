<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'target_weight' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if (strlen((string)(int)$value) > 4) {
                        $fail('4桁までの数字で入力してください');
                    }
                    if (preg_match('/^\d+(\.\d{2,})$/', $value)) {
                        $fail('小数点は1桁で入力してください');
                    }
                },
            ],
        ];
    }

    public function messages()
    {
        return [
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric' => '4桁までの数字で入力してください',
        ];
    }
}
