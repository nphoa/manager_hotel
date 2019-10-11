<?php

namespace App\Repositories\Eloquents;

use App\Models\Image;
use App\Repositories\Base\BaseRepository;

class ImageRepository extends BaseRepository {
    public function __construct(Image $model)
    {
        $this->model = $model;
    }
}
