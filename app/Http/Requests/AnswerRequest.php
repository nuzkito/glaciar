<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AnswerRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'body' => 'required',
        ];
    }
}
