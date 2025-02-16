<?php

namespace App\Http\Controllers\Api\Technician;

use App\Http\Controllers\Controller;
use App\Models\Technician;
use App\Models\PassCode;
use App\Notifications\SendPasscodeNotification;
use App\Notifications\Technician\ResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator      = Validator::make($request->all(), [
            'email'     => ['required', 'string', 'email', 'max:255'],
            'password'  => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        if (Auth::guard('technician')->attempt([
            'email'     => $request->email,
            'password'  => $request->password
        ])) {

            $technician             = Technician::find(auth()->guard('technician')->user()->id);
            $technician->token      = $technician->createToken('Technician', ['technician'])->accessToken;
            $technician->avatar     = isset($technician->avatar) ? asset('storage/uploads/technician/' . $technician->avatar) : URL::to('assets/images/users/avatar.png');

            return response()->json($technician, 200);
        } else {
            return response()->json(['errors' => ['email' => 'These credentials do not match our records.']], 200);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'phone'     => ['required', 'min:8', 'unique:technicians'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:technicians'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $input                  = $request->all();
        $input['password']      = bcrypt($input['password']);
        $input['status']        = false;
        $technician             = Technician::create($input);
        $technician->token      = $technician->createToken('Technician', ['technician'])->accessToken;
        $technician->avatar     = isset($technician->avatar) ? asset('storage/uploads/technician/' . $technician->avatar) : URL::to('assets/images/users/avatar.png');


        return response()->json($technician, 200);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $technician                 = Auth::user();
        $technician->avatar         = isset($technician->avatar) ? asset('storage/uploads/technician/' . $technician->avatar) : URL::to('assets/images/users/avatar.png');
        return response()->json(['success' => $technician], 200);
    }

    public function updateProfile(Request $request)
    {
        $id             = Auth::user()->id;

        $validator      = Validator::make($request->all(), [
            'firstname'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:technicians,email,' . $id],
            'phone'             => ['required', 'min:8', 'unique:technicians,phone,' . $id]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $technician                       = Technician::find($id);
        $technician->firstname            = $request->firstname;
        $technician->lastname             = $request->lastname;
        $technician->email                = $request->email;
        $technician->email_additional     = $request->email_additional;
        $technician->dialcode             = $request->dialcode;
        $technician->phone                = $request->phone;
        $technician->gender               = $request->gender;
        $technician->address              = $request->address;
        $technician->city                 = $request->city;
        $technician->state                = $request->state;
        $technician->zipcode              = $request->zipcode;
        $technician->iso2                 = $request->iso2;

        if ($request->hasfile('avatar')) {

            $image      = $request->file('avatar');

            $name       = $image->getClientOriginalName();

            $image->storeAs('uploads/technician/', $name, 'public');

            if (isset($technician->avatar)) {

                $path   = 'public/uploads/technician/' . $technician->avatar;

                Storage::delete($path);
            }

            $technician->avatar = $name;
        }

        $technician->save();

        return response()->json(['success' => 'Profile has been updated'], 200);
    }

    public function logout()
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(['success' => 'Logged Out Successfully!'], 200);
    }

     public function testnotify()
    {
        return response()->json(['success' => 'Logged Out Successfully!'], 200);
    }

    public function forgotPassword(Request $request){

        $validator = Validator::make($request->all(), [
            'email'     => ['required', 'string', 'email', 'max:255', 'exists:technicians']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        PassCode::where('model', 'Technician')->where('email', $request->email)->delete();

        $user       = Technician::where('email', $request->email)->first();
        $passcode   = mt_rand(11111,99999);
        PassCode::create([
            'email' => $request->email,
            'model' => 'Technician',
            'code'  => $passcode
        ]);

        $user->notify((new SendPasscodeNotification($passcode))->delay(Carbon::now()->addMinutes(1)));

        return response()->json([
            'success' => 'Passcode sent successfully!',
            'message' => 'Please enter the passcode sent on your email!'
        ], 200);
    }

    public function confirmPasscode(Request $request){
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'string', 'email', 'max:255', 'exists:technicians'],
            'code'     => ['required', 'digits:5', 'exists:pass_codes']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $user              = Technician::where('email', $request->email)->first();
        $passcode_exists   = Passcode::where('email', $user->email)->where('model', 'Technician')->where('code', $request->code)->exists();

        if($passcode_exists){
            return response()->json(['success' => 'Passcode matched successfully!'] , 200);
        }else{
            return response()->json(['errors' => ['code' => 'Please enter correct Passcode.']], 200);
        }
    }

    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email'    => ['required', 'string', 'email', 'max:255', 'exists:technicians'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        Technician::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json(['success' => 'Password has been reset successfully!'] , 200);
    }
    public function updateDeviceId(Request $request){
          $validator = Validator::make($request->all(), [
            'device_id'    => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $id       = Auth::user()->id;
         Technician::where('id',  $id)->update([
            'device_id' => $request->device_id
        ]);
         $technician = Technician::find($id);


        return response()->json([
            'success' => 'Device Id has been reset successfully!',
            'technician' => $technician,

        ] , 200);
    }
     public function updateLocation(Request $request){
        $id             = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'latitude'     => ['required'],
            'longitude'    => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        $technician                 = Technician::find($id);
        $technician->latitude       = $request->latitude;
        $technician->longitude      = $request->longitude;
        $technician->save();

         return response()->json([
            'success' => 'Location update successfully!',
            'technician' => $technician,

        ] , 200);
    }
     public function forgotPasswordLink(Request $request){

        $validator = Validator::make($request->all(), [
            'email'     => ['required', 'string', 'email', 'max:255', 'exists:technicians']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }

        PassCode::where('model', 'Technician')->where('email', $request->email)->delete();

        $user       = Technician::where('email', $request->email)->first();
        $passcode   = Str::random(50);
        PassCode::create([
            'email' => $request->email,
            'model' => 'Technician',
            'code'  => $passcode
        ]);

        $user->notify((new ResetPasswordNotification($passcode)));

        return response()->json([
            'success' => 'Passcode sent successfully!',
            'message' => 'Please enter the passcode sent on your email!'
        ], 200);
    }
}
