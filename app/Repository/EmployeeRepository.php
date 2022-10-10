<?php

namespace App\Repository;

use App\Repository\BaseRepository;
use App\Models\Employee;

class EmployeeRepository extends BaseRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Employee::class;
    }

    public function getEmployee()
    {
        return $this->model->where('del_flag', config('constant.DELETED_OFF'))->get();
    }

    public function getInforSearch($data)
    {
        return $this->model->where('last_name', 'LIKE', '%' . $data['name'] . '%')->where('del_flag',config('constant.DELETED_OFF'))->get();
    }

}
