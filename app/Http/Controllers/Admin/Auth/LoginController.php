<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Administrator;
use App\Models\LoginLog;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest:administrator')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required|min:6'
        ]);


        if (Auth::guard('administrator')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {

            LoginLog::create([
                'admin_id' => Auth::guard('administrator')->user()->id,
                'user_type' => 'admin',
                'ip_address' => $request->ip(),
            ]);

            return redirect()->intended(route('admin.dashboard'));
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
        Auth::guard('administrator')->logout();

        if (session()->has('impersonator_id')) {
            $admin = Administrator::find(session()->get('impersonator_id'));
            Auth::guard('administrator')->login($admin);
            session()->forget('impersonator_id');
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login');
    }
}
