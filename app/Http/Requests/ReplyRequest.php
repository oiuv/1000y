<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        return [
            'reply' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            // Validation messages
        ];
    }
}
