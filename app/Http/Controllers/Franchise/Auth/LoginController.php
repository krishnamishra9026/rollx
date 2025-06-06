<?php

namespace App\Http\Controllers\Franchise\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginLog;
use App\Models\Franchise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:franchise')->except('logout');
    }

    public function showLoginForm()
    {
        return view('franchise.auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required|min:6'
        ]);


        if (Auth::guard('franchise')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            LoginLog::create([
                'franchise_id' => Auth::guard('franchise')->user()->id,
                'user_type' => 'franchise',
                'ip_address' => $request->ip(),
            ]);

            return redirect()->intended(route('franchise.dashboard'));
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

        if (Auth::guard('franchise')->check()) 
        {
            Auth::guard('franchise')->logout();
            return redirect()->route('franchise.login');
        }
    }

    
}
