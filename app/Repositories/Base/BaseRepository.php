<?php
namespace App\Repositories\Base;
use App\Models\Base\BaseModel;
use App\Repositories\Base\BaseRepositoryInterface;
abstract class BaseRepository implements BaseRepositoryInterface {

    protected $model;

    public function create($attribute){

        return $this->model->create($attribute);
    }


}
