<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IORMRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(IORMRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        return $users;
    }

    public function show($id)
    {
        $user = $this->userRepository->find($id);
        return $user;
    }
}
