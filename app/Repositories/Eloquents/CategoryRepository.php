<?php

namespace App\Repositories\Eloquents;


use App\Models\Category;
use App\Repositories\Base\BaseRepository;

class CategoryRepository extends BaseRepository {
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
