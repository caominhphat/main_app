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
            $user = $this->_model
                ->where('email', $request['email'])
                ->where('password', $request['password'])
                ->first();
            if(empty($user)) {
                return [
                    'success' => false
                ];
            }
            Auth::login($user);
            $loginUser = Auth::user();
            $user['access_token'] = $loginUser->createToken('authToken')
                ->plainTextToken;
            $user['token_type'] = 'Bearer';
            return [
                'user' => $user->toArray(),
                'success' => true
            ];
        }
    }

    public function logout ($request) {
        $auth = Auth::user();
        if ($auth) {
            $request->user()->currentAccessToken()->delete();
        }
    }
}
