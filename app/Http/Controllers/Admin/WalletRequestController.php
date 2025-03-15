<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WalletRequest;
use App\Models\Franchise;
use App\Notifications\WalletBalanceAdded;

class WalletRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index(Request $request)
    {
        $query = WalletRequest::with(['franchise', 'admin'])->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }


        if ($request->franchise) {
            $query->where('franchise_id', $request->franchise);
        }

        $requests = $query->paginate(20);


              

        $franchises = Franchise::all();

        return view('admin.wallet.requests.list', compact('requests', 'franchises'));        
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
        //
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
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $walletRequest = WalletRequest::find($id);

        if ($request->status == 'approved') {
            $franchise = Franchise::find($walletRequest->franchise_id);
            $franchise->wallet->deposit($walletRequest->amount);
            $franchise->notify(new WalletBalanceAdded($walletRequest->amount, $franchise->balance));
        }

        $walletRequest->update(['status' => $request->status, 'admin_id' => auth()->user()->id]);

        return redirect()->route('admin.wallet-requests.index')->with('success', 'Request updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
