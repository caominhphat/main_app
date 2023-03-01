<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class UserRepository extends ModelRepository
{

    public function getModel()
    {
        return User::class;
    }

    public function getRules()
    {
        return [
            'register' => [
                'email' => 'required|email',
                'password' => 'required',
                'name' => 'required'
            ],
            'login' => [
                'email' => 'required|email',
                'password' => 'required'
            ]
        ];
    }

    public function register ($request) {
        $existEmail = [];
        if(!empty($request)) {
           $existEmail = $this->_model->where('email', $request['email'])->get()->toArray();
        }

        if(!empty($existEmail)) {
            return 'Email has exist';
        }

        return $this->_model->create($request);
    }

    public function login ($request) {
        if(!empty($request)) {
            $user = Auth::getProvider()->retrieveByCredentials($request);
            if(!empty($user->toArray())) {
                Auth::login($user);
            }
            return [
                'user' => $user->toArray(),
                'success' => true
            ];
        }
    }
}
