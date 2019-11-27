<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:30',
            'content' => 'required|string|max:1000',
            'tag_category_id' => 'required|int|between:1, 4',
        ];
    }

    public function messages()
    {
        return [
            'require' => '入力必須の項目です。',
            'string' => '文字列形式で入力してください',
            'int' => '数値形式で入力してください。',
            'max' => ':max文字以内で入力してください。',
            'between' => ':minから:maxの間の数値で入力してください。',
        ];
    }
}
