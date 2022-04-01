<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

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

    public function getAllConditionWithCount($attributes = [],$relation=[])
    {
        return $this->model->where($attributes)->withCount($relation)->get();
    }

    public function getAllByCondition($attributes = [])
    {
        return $this->model->where($attributes)->get();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }

        return false;
    }

    /**
     * @param mixed $value
     * @return mixed|Model|static
     */
    public function findBy($value)
    {
        return $this->model->where($value)->first();
    }

    public function paginate(int $perPage, array $relation = [])
    {
        return $this->model->with($relation)->orderBy('id', 'DESC')->paginate($perPage);
    }

    public function updateOrCreate($matchThese = [],$attributes = [])
    {
        return $this->model->updateOrCreate($matchThese,$attributes);
    }

    public function paginateCondition(int $perPage, array $where = [],array $relation = [],string $sort = 'id',string $orderBy = 'DESC')
    {
        return $this->model->where($where)->with($relation)->orderBy($sort, $orderBy)->paginate($perPage);
    }

    public function whereOne($where,array $relation = [])
    {
        return $this->model->where($where)->with($relation)->first();
    }

}
