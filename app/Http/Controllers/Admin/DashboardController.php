<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\Lead;
use App\Models\Order;
use App\Models\Product;
use App\Models\Franchise;
use App\Models\User;
use App\Models\Sale;
use App\Models\LoginLog;
use App\Models\Chef;
use App\Models\WarehouseItem;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index()
    {
        $franchises = Franchise::count();
        $chefs = Chef::count();
        $orders = Order::count();
        $products = Product::count();
        $active_products = Product::whereStatus(1)->count();
        $total_sales = Sale::count();
        $warehouse_items = WarehouseItem::count();

        $leads = Lead::count();
        $fresh_leads = Lead::where('status', 'Fresh')->count();
        $interested_leads = Lead::where('status', 'Interested')->count();
        $non_leads = Lead::where('status', 'Non Contactable')->count();
        $paspect_leads = Lead::where('status', 'Paspect')->count();
        $closed_leads = Lead::where('status', 'Closed')->count();
        $not_interested_leads = Lead::where('status', 'Not Interested')->count();
        $converted_leads = Lead::where('status', 'Converted')->count();


        $sales = Sale::sum('price');
        $sale_quantity = Sale::sum('quantity');
        $monthlySales = Sale::whereMonth('created_at', now()->month)->sum('price');
        $monthlySalesQuantity = Sale::whereMonth('created_at', now()->month)->sum('quantity');

        $users = Administrator::count();

        $leads_data  = Lead::whereNotNull('next_call_datetime')->whereNotIn('status', ['Converted'])->orderBy('id', 'desc')->paginate(20);

        return view('admin.dashboard.dashboard', compact('franchises', 'orders', 'users', 'leads', 'leads', 'fresh_leads', 'interested_leads', 'non_leads', 'paspect_leads', 'closed_leads', 'not_interested_leads', 'converted_leads', 'products', 'sales', 'monthlySales', 'leads_data', 'total_sales', 'chefs', 'active_products', 'warehouse_items', 'sale_quantity', 'monthlySalesQuantity'));
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


    public function adminIntendLogin(Request $request, $id)
    {
        session(['impersonator_id' => Auth::id()]);

        $user = Administrator::whereId($id)->first();

        if (!is_null($user)) {
            Auth::guard('administrator')->login($user);

            LoginLog::create([
                'admin_id' => Auth::guard('administrator')->user()->id,
                'user_type' => 'admin',
                'ip_address' => $request->ip(),
            ]);

            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
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
