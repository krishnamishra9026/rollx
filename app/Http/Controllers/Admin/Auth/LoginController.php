<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Administrator;
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

        Cookie()->forget('admin_id');

        $this->validate($request, [
            'email'         => 'required|email',
            'password'      => 'required|min:6'
        ]);


        if (Auth::guard('administrator')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
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

        echo $adminId = $request->cookie('admin_id');
        die;

        if ($adminId) {
            $admin = Administrator::find($adminId);

            if($admin){

                Auth::guard('administrator')->login($user);
                return redirect()->route('admin.dashboard');
            }else{
                Auth::guard('administrator')->logout();
                return redirect()->route('admin.login');
            }
        }

        return redirect()->route('admin.login');
    }
}
