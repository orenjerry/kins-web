<?php

namespace App\Repositories\Data;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Data;

class DataRepositoryImplement extends Eloquent implements DataRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Data $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
