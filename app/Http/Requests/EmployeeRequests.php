<?php

namespace App\Http\Requests;

use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use App\Repository\EmployeeRepository;


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
        $validate = [
            'avatar' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1920,max_height=1920',
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
        if (!$this->hasFile('avatar') && !session()->has('currentImgUrl')) {
            $validate['avatar'] = 'required|mimes:png,gif,jpeg|max:10000';
        }

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $validate['avatar'] = [
                'mimes:png,gif,jpeg|max:10000',
            ];
        }

        return $validate;
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

    protected function failedValidation(Validator $validator)
    {
        if ($validator->errors()->has('avatar')) {
            session()->forget('currentImgUrl');
        }
        parent::failedValidation($validator);
    }

//    public $employeeRepo;
//
//    public function __construct(EmployeeRepository $employeeRepo)
//    {
//        $this->employeeRepo = $employeeRepo;
//    }
//    public function checkMail()
//    {
//        parent::checkMail();
//        if (request()->has('email')) {
//            $email = request()->input('email');
//            $result = $this->employeeRepo->findByEmail($email);
//            if ($result){
//                return
//            }
//        }
//    }
}
