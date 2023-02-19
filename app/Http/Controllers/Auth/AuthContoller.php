<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\Rules\Password;

class AuthContoller extends Controller
{

    protected $maxAttempts = 3;
    protected $decayMinutes = 1;

    public function showFormLogin() {
        if(Auth::check()) {
            return view('Dashboard');
        }
        return view('auth.Login');
    }

    public function showFormRegister() {
        return view('auth.Register');
    }

    public function login(Request $request) {
        $request->validate([
            'email'    => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ]);

        try{

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                RateLimiter::clear($this->throttleKey());
                return redirect()->intended('dashboard')->withSuccess('Signed in');
            }
            
            RateLimiter::hit($this->throttleKey());
        }catch(Exception $e){
            report($e->getMessage());
        }
        
        return redirect('login')->withErrors('Login details are not valid');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'confirmed', Password::min(10)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()
            ->uncompromised()],
        ]);
           
        $data = $request->all();
        $this->create($data);
         
        return redirect("login")->withSuccess('You have already to signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'role'  => 2,
        'password' => Hash::make($data['password'])
      ]);
    }  
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function throttleKey() {
        return Str::lower($this->input('email')). '|'.$this->ip();
    }
}
