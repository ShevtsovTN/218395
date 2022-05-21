<?php

namespace App\Contracts;

interface UserRepositoryContract
{
    public function getUsers(array $data);

    public function filterByAttributes(array $data);

    public function orderByAttributes(array $data);
}
