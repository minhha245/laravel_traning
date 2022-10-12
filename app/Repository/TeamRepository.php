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
        return $this->model->get();
    }
    public function getInforSearch($data)
    {
        if (empty($data)) {
            return $this->model->select('id', 'name')->Paginate(config('constant.LIMIT_PER_PAGE'));
        }

        return $this->model->when(!empty($data['name']), function ($q) use ($data) {
            return $q->where('name', 'like', '%' . $data['name'] . '%');
        })
            ->when(!empty($data['sort_field'] && $data['sort_type'] == 'desc'), function ($q) use ($data) {
                return $q->orderByDesc($data['sort_field']);
            })
            ->when(!empty($data['sort_field'] && $data['sort_type'] == 'asc'), function ($q) use ($data) {
                return $q->orderBy($data['sort_field']);
            })
            ->Paginate(config('constant.LIMIT_PER_PAGE'));
    }
}
