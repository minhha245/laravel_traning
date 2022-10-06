<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'avatar' => 'nullable|mimes:png,gif,jpeg|max:10000',
            'team_id' => 'required',
            'first_name' => 'required|max:129',
            'last_name' => 'required|max:129',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required|max:256',
            'salary' => 'required|min:0',
            'position' => 'required',
            'type_of_work' => 'required',
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return[

        ];
    }
}
