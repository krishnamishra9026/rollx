<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use App\Notifications\WalletBalanceAdded;


use App\Models\Franchise;

class WalletController extends Controller
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
        $filter                     = [];
        $filter['franchise']             = $request->franchise;

        $franchises  = Franchise::with('wallet');
        $franchises  = isset($filter['franchise']) ? $franchises->where('id', $filter['franchise']) : $franchises;
        $franchises  = $franchises->orderBy('created_at', 'desc')->paginate(20);     

        $franchise_list = Franchise::all();

        return view('admin.wallet.list', compact('franchises', 'franchise_list'));
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

        $franchise_id = $request->franchise_id;

        $franchise = Franchise::find($franchise_id);

        $franchise->wallet->deposit($request->amount);

        // Notify the franchise
        $franchise->notify(new WalletBalanceAdded($request->amount, $franchise->balance));

        return redirect()->back()->with('success', 'Balance added successfully.');
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
