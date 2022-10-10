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
            // 'avatar' => 'required',
            'team_id' => 'required',
            'first_name' => 'required|max:129',
            'last_name' => 'required|max:129',
            'email' => 'required|max:129',
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
        return [
            'team_id.required' => 'Team ',
            'first_name.required' => 'Fist name is not blank!',
            'last_name.required' => 'Last name is not blank!',
            'email.required' => 'Email is not blank!',
            'gender.required' => 'Gender is not blank!',
            'birthday.required' => 'Birthday is not blank!',
            'address.required' => 'Address is not blank!',
            'salary.required' => 'Salary is not blank!',
            'position.required' => 'Position is not blank!',
            'type_of_work.required' => 'Gender is not blank!',
            'status.required' => 'Gender is not blank!',

        ];
    }

    public function upload()
    {
        $all = parent::upload();

        $fileName = null;
        $imageUrl = null;

        if (request()->hasFile('avatar')) {
            $image = request()->file('avatar');
            $fileName = 'avatar' . time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/avatars/', $fileName);
            $imageUrl = 'storage/avatars/' . $fileName;

            session()->put('currentImgUrl', $imageUrl);

        } else {
            $imageFileName = str_replace('storage/avatars/', '', session()->get('currentImgUrl'));
            $imageUrl = session()->get('currentImgUrl');
        }


        request()->merge([
            'file_name' => $imageFileName,
            'file_path' => $imageUrl,
        ]);

        request()->flash();
        return $all;
    }
}
