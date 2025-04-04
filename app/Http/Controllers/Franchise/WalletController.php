<?php

namespace App\Http\Controllers\Franchise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;

class WalletController extends Controller
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
        $user = auth()->user();

        $filter = [
            'type' => $request->type,
        ];

        $type = request('type');

        $transactions = $user->wallet->transactions()
        ->when($type, function ($query) use ($type) {
            return $query->where('type', $type); 
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20);           


        return view('franchise.wallet.list', compact('transactions', 'filter'));
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

        $user = auth()->user();

        $user->wallet->deposit($request->amount);

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
