<?php

namespace App\Services;

use App\Contracts\UserRepositoryContract as UserRepository;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private UserRepository $repository;
    private array $relations;

    public function __construct(UserRepository $userRepository)
    {
        $this->relations = ['roles'];
        $this->repository = $userRepository;
    }

    public function index(array $dataValidated): Collection|array
    {
        $users = $this->repository->getUsers($dataValidated);
        return $users->load($this->relations);
    }
}
