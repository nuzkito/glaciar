<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CourseRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'teachers' => [
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->whereIn('role', ['admin', 'teacher']);
                }),
            ],
        ];
    }
}
