<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'initial_weight' => ['required', 'numeric', 'regex:/^\d{1,3}(\.\d)?$/'],
            'target_weight' => ['required', 'numeric', 'regex:/^\d{1,3}(\.\d)?$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'initial_weight.required' => '現在の体重を入力してください',
            'initial_weight.numeric' => '現在の体重は数値で入力してください',
            'initial_weight.regex' => '4桁までの数字、小数点は1桁で入力してください',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric' => '目標の体重は数値で入力してください',
            'target_weight.regex' => '4桁までの数字、小数点は1桁で入力してください',
        ];
    }
}
