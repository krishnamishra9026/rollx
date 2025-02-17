<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Equipment;
use App\Models\Job;
use App\Models\Part;
use App\Models\Order;
use App\Models\Chef;
use App\Models\Technician;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:chef');
    }

    public function index()
    {

        $total_orders = Order::count();
        $not_started = Order::where('status', 'PO Generated')->count();
        $in_progress = Order::where('status', 'In Progress')->count();
        $delivered = Order::where('status', 'Delivered')->count();
        $completed = Order::where('status', 'Completed')->count();

        $orders = Order::where('franchise_id', auth()->user()->franchise_id)
                ->where('stock', '>', 0)
                ->where(function ($query) {
                    $query->where('status', 'completed')
                          ->orWhere('status', 'delivered');
                })->orderBy("id", "desc")->paginate(20);

        $quantity_per_plate = Setting::get('quantity_per_plate');

        return view('chef.dashboard.dashboard', compact('total_orders', 'not_started', 'in_progress', 'delivered', 'completed', 'orders', 'quantity_per_plate'));
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
                'success'=>false
            ],500);
        }
    }
}
