<?php

namespace App\Http\Controllers\API\Dashboard\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Dashboard\Admin\Auth\{LoginRequest, LogoutRequest};
use App\Services\Dashboard\Admin\Auth\AuthService;

class AuthController extends Controller
{
    private $_auth_service;
    public function __construct(AuthService $auth_service) {
        $this->_auth_service = $auth_service;
    }
    public function login(LoginRequest $request) {
        return $this->_auth_service->login($request);
    }

    public function logout(LogoutRequest $request)
    {
        return $this->_auth_service->logout($request);
    }
}
