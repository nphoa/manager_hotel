<?php

namespace App\Repositories\Base;

interface BaseRepositoryInterface {

    public function create($input);

    public function getAll();

    public function getById($id);

    public function getPagination($number);

}
