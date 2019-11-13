<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
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
            'reporting_time' => 'required|date',
            'title' => 'required|string|max:30',
            'content' => 'required|string|max:1000',
        ];    
    }
  
    public function messages()
    {
        return [
            'required' => '入力必須の項目です。',
            'date' => '日付形式で入力してください。',
            'title.string' => 'タイトルが文字列になっていません',
            'title.max' => '30文字以下で入力してください。',
            'content.string' => 'コンテンツが文字列になっていません。',
            'content.max' => '1000文字以下で入力してください',
        ];
    }
}

