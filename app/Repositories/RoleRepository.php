<?php

namespace App\Repositories;
use Spatie\Permission\Models\Role;
use App\Repositories\Repository;

class RoleRepository extends Repository
{
    protected $searchables = ['id', 'name'];

    public function __construct(Role $model) {
        parent::__construct($model);
    }
}
