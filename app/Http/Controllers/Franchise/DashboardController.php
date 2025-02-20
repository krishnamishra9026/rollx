<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Equipment;
use App\Models\Job;
use App\Models\Product;
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

        $total_orders = Order::where('franchise_id', auth()->user()->id)->count();
        $not_started = Order::where('franchise_id', auth()->user()->id)->where('status', 'PO Generated')->count();
        $in_progress = Order::where('franchise_id', auth()->user()->id)->where('status', 'Pending')->count();
        $delivered = Order::where('franchise_id', auth()->user()->id)->where('status', 'Delivered')->count();
        $completed = Order::where('franchise_id', auth()->user()->id)->where('status', 'Completed')->count();

        $totalSales = Sale::where('franchise_id', auth()->user()->id)->sum('price');
        $monthlySales = Sale::where('franchise_id', auth()->user()->id)->whereMonth('created_at', now()->month)->sum('price');


        $salesData = Sale::where('franchise_id', auth()->user()->id)->selectRaw('product_id, sum(quantity) as total_quantity, sum(price) as total_sales')
                        ->groupBy('product_id')
                        ->get();

        $productNames = Product::whereIn('id', $salesData->pluck('product_id'))->pluck('name', 'id');

        $sales = $salesData->map(function ($sale) use ($productNames) {
            return [
                'name' => $productNames[$sale->product_id],
                'quantity' => $sale->total_quantity,
                'sales' => $sale->total_sales,
            ];
        });


        return view('franchise.dashboard.dashboard', compact('total_orders', 'not_started', 'in_progress', 'delivered', 'completed', 'totalSales', 'monthlySales', 'sales'));
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
