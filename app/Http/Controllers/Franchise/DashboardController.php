<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Equipment;
use App\Models\Job;
use App\Models\Part;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Franchise;
use App\Models\Technician;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:franchise');
    }

    public function index()
    {

        $total_orders = Order::count();
        $not_started = Order::where('status', 'PO Generated')->count();
        $in_progress = Order::where('status', 'In Progress')->count();
        $delivered = Order::where('status', 'Delivered')->count();
        $completed = Order::where('status', 'Completed')->count();

        $totalSales = Sale::sum('price');
        $monthlySales = Sale::whereMonth('created_at', now()->month)->sum('price');

        return view('franchise.dashboard.dashboard', compact('total_orders', 'not_started', 'in_progress', 'delivered', 'completed', 'totalSales', 'monthlySales'));
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
