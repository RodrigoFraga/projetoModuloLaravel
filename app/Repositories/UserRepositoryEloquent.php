<?php

namespace projetoModuloLaravel\Repositories;

use projetoModuloLaravel\Entities\User;
use projetoModuloLaravel\Repositories\UserRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use projetoModuloLaravel\Presenters\UserPresenter;


class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $fieldSearchable = [
        'name'
    ];
	
    public function model()
    {
        return User::class;
    }

    public function presenter()
    {
        return UserPresenter::class;
    }
}