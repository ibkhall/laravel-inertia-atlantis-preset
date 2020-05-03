<?php

namespace App\Repositories;
use App\Models\Config;
use App\Repositories\Repository;

class ConfigRepository extends Repository
{
    protected $searchables = ['id'];

    public function __construct(Config $model) {
        parent::__construct($model);
    }
}
