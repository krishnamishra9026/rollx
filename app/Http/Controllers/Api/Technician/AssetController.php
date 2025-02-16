<?php

namespace App\Http\Controllers\Api\Technician;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{

    public function countries(){
        $countries = Country::get(['code', 'name']);
        return response()->json([
            'success' => 'Countries fetched successfully!',
            'countries'    => $countries
        ] , 200);
    }
    
    public function help(Request $request){
        $validator = Validator::make($request->all(), [
            'message'  => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages()]);
        }
       
        $id       = Auth::user()->id;

        Help::create([
            'technician_id' => $id,
            'message'       => $request->message
        ]);

        return response()->json([
            'success' => 'Your message has been sent successfully!',       
        ] , 200);
    }

    public function test(){
        return response()->json(['success' => 'Hi Ganesh, If you can see this response, it means api is working'], 200);
    }
}
