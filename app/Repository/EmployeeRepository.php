<?php

namespace App\Repository;

use App\Repository\BaseRepository;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeRepository extends BaseRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Employee::class;
    }

    public function getEmployee()
    {
        return $this->model->get();
    }

    public function getInforSearch($data)
    {
        // return $this->model->where('last_name', 'LIKE', '%' . $data['name'] . '%')->get();
        if (empty($data)) {
            return $this->model->select('id', 'team_id', 'first_name', 'last_name', 'email','salary')
                ->Paginate(config('constant.LIMIT_PER_PAGE'));
        }

        return $this->model->when(!empty($data['name']), function ($query) use ($data) {
            return $query->where('first_name', 'like', '%' . $data['name'] . '%')
                ->orWhere('last_name', 'like', '%' . $data['name'] . '%')
                ->orWhere(DB::raw("concat(first_name, ' ', last_name)"), 'like', '%' . $data['name'] . '%');
        })
            ->when(!empty($data['team']), function ($query) use ($data) {
                return $query->where('team_id', $request['team']);
            })
            ->when(!empty($data['email']), function ($query) use ($data) {
                return $query->where('email', 'LIKE', '%' . $data['email'] . '%');
            })
            ->when(!empty($data['sort_field'] && $data['sort_type'] == 'desc'), function ($query) use ($data) {
                return $query->orderByDesc($data['sort_field']);
            })
            ->when(!empty($data['sort_field'] && $data['sort_type'] == 'asc'), function ($query) use ($data) {
                return $query->orderBy($data['sort_field']);
            })
            ->Paginate(config('constant.LIMIT_PER_PAGE'));
    }

    public function create($attributes = [])
    {
        $attributes['avatar'] = session()->get('createEmployee')['file_name'];
        $attributes['password'] = Auth::user()->password;
        $attributes['email'] = Auth::user()->email;
        session()->forget('addEmployee');
        session()->forget('currentImgUrl');

        return parent::create($attributes);
    } 

    public function update($id, $attributes = [])
    {
        // if (session()->has('editEmployee')) {
        //     $attributes['avatar'] = session()->get('editEmployee')['file_name'];
        // }
        $attributes['password'] = Auth::user()->password;
        session()->forget('editEmployee');
        session()->forget('currentImgUrl');

        return parent::update($id, $attributes);
    }
}
