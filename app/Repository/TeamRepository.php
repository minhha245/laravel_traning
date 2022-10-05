<?php

namespace App\Repository;

use App\Repository\BaseRepository;
use App\Models\Team;

class TeamRepository extends BaseRepository
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Team::class;
    }

    public function getTeam()
    {
        return $this->model->where('del_flag', '0')->take(5)->get();
    }

    public function getInforSearch($data)
    {
        return $this->model->where('name', 'LIKE', '%' . $data . '%')->where('del_flag', '0')->get();
    }
}
