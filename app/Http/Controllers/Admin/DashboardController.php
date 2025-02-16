<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Equipment;
use App\Models\Help;
use App\Models\Job;
use App\Models\Order;
use App\Models\Product;
use App\Models\Franchise;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index()
    {
        $franchises = Franchise::count();
        $orders = Order::count();
        $users = Administrator::count();
        return view('admin.dashboard.dashboard', compact('franchises', 'orders', 'users'));
    }

    public function updateToken(Request $request){
        try{
            $request->user()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>$e
            ],500);
        }
    }

    public function help(){
        $helps = Help::orderBy('id', 'desc')->paginate(20);
        return view('admin.support.list', compact('helps'));
    }

    public function bulkDelete(Request $request)
    {
        Help::whereIn('id', $request->helps)->delete();
        return response()->json(['success' => 'Selected Messages deleted successfully!'], 200);
    }

    public function appFlow(){
        return view('admin.flow-chart');
    }
}
