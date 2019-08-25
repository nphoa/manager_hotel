<?php
namespace App\Repositories\Base;
use App\Models\Base\BaseModel;
use App\Repositories\Base\BaseRepositoryInterface;
abstract class BaseRepository implements BaseRepositoryInterface {

    protected $model;

    public function create($attribute){
//        var_dump($attribute['id']);die('6');
        return $this->model->updateOrCreate(array('id' => $attribute['id']) ,$attribute);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getPagination($number)
    {
        return $this->model->where(array('del_flg'=>0))->paginate($number);
    }

}
