<?php

namespace App\Http\Controllers;

use App\Http\Requests\SortFilterRequest;
use App\Http\Resources\UserCollection;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function index(SortFilterRequest $request): UserCollection
    {
        return UserCollection::make($this->service->index($request->validated()));
    }
}
