<?php

    namespace App\Http\Controllers;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Laravel\Socialite\Facades\Socialite;

    class SocialLoginController
    {
        protected User $user;
        public function __construct(User $user)
        {
            $this->user = $user;
        }

        public function index(Request $request, $provider, $action) {
            if (method_exists($this, $action)) {
                return $this->{$action}($provider);
            }
        }

        public function attach($provider) {
            $uri = Socialite::driver($provider)
                ->stateless()
                ->redirect()
                ->getTargetUrl();
            return [
                'success'=> true,
                'data' => $uri
            ];
        }

        public function callback($provider) {
            $socialResponse = Socialite::driver($provider)->stateless()->user();
            $user = $this->user->where('email', $socialResponse['email'])->first();
            if(!empty($user->toArray())){
                Auth::login($user);
                $loginUser = Auth::user();
                $user['access_token'] = $loginUser->createToken('authToken')->plainTextToken;
                $user['token_type'] = 'Bearer';
                return view('auth.login', ['user' => $user]);
            }
            return false;
        }
    }
