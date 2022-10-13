<?php

namespace App\Repository;

use App\Repository\RepositoryInterface;
use Illuminate\Support\Facades\Auth;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

   //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        $attributes['ins_id'] = Auth::id();
        $attributes['ins_datetime'] = date("Y-m-d H:i:s");

        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->model->find($id);

        if ($result) {
            $attributes['upd_id'] = Auth::id();
            $attributes['upd_datetime'] = date("Y-m-d H:i:s");
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $value['del_flag'] = config('constant.DELETED_ON');
            $value['upd_id'] = Auth::id();
            $value['upd_datetime'] = date("Y-m-d H:i:s");
            $result->update($value);

            return true;
        }

        return false;
    }
}
