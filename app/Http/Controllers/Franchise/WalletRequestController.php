<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WalletRequest;
use App\Models\Franchise;
use App\Models\Administrator;

use App\Notifications\WalletBalanceRequestNotification;



class WalletRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:franchise');
    }

    public function index(Request $request)
    {
        $requests = WalletRequest::with('franchise')->latest()->paginate(20);
        return view('franchise.wallet.requests.list', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        WalletRequest::create([
            'franchise_id' => auth()->user()->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        $franchise = auth()->user();
        $amount = request('amount');

        $sale_admins = Administrator::role('sales')->get();
        $admins = Administrator::role('Administrator')->get();
              
        foreach ($sale_admins as $admin) {
            $admin->notify(new WalletBalanceRequestNotification($franchise, $amount));
        }

        foreach ($admins as $admin) {
            $admin->notify(new WalletBalanceRequestNotification($franchise, $amount));
        }

        return redirect()->back()->with('success', 'Request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
