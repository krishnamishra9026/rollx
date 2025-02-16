<?php

namespace App\Http\Controllers\Technician;

use App\Models\PassCode;
use App\Models\Technician;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Controller
{
    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('technician.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function updatePassword(Request $request){

        $request->validate([
              'email' => 'required|email|exists:technicians',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
          $updatePassword = PassCode::where('email',$request->email)
                            ->where('code',$request->token)
                            ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          Technician::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
          PassCode::where(['email'=> $request->email])->delete();

          return redirect()->back()->with('status', 'Your password has been changed!');
    }
}
