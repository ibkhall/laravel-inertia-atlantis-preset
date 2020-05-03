<?php

namespace App\Repositories;
use App\User;
use App\Repositories\Repository;

class UserRepository extends Repository
{
    protected $searchables = ['id', 'name', 'email'];

    public function __construct(User $model) {
        parent::__construct($model);
    }
}
