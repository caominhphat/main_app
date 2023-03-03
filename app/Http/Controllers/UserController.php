<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController
{
    protected UserRepository $userRepository;
    public function __construct(UserRepository $userRepository){
        parent::__construct($userRepository);
    }

    public function register (Request $request) {
       return $this->repository->register($request->toArray());
    }

    public function login (Request $request) {
        return $this->repository->login($request->toArray());
    }

    public function logout (Request $request) {
        return $this->repository->logout($request);
    }
}
