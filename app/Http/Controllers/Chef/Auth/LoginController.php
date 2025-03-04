<?php

namespace App\Http\Controllers\Chef\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:chef')->except('logout');
    }

    public function showLoginForm()
    {
        return view('chef.auth.login');
    }

    public function directLogin($token)
    {

        if (!$token) {
            return redirect()->route('chef.login')->with('error', 'Invalid token.');
        }

        try {
            $data = decrypt($token);

            if (now()->greaterThan($data['expires'])) {
                return redirect()->route('chef.login')->with('error', 'Token expired.');
            }

            $chef = Chef::where('id', $data['id'])->first();
            if ($chef) {
                Auth::guard('chef')->login($chef);
                return redirect()->intended(route('chef.dashboard'));
            }

        } catch (\Exception $e) {
            return redirect()->route('chef.login')->with('error', 'Invalid token.');
        }

    }

    public function login(Request $request)
    {              
        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required|min:6'
        ]);


        if (Auth::guard('chef')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('chef.dashboard'));
        } else {

            return $this->sendFailedLoginResponse($request);
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        if (Auth::guard('chef')->check()) 
        {
            Auth::guard('chef')->logout();
            return redirect()->route('chef.login');
        }
    }
}
