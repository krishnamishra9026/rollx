<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Franchise;
use App\Models\Chef;
use Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('guest.home');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function loginChef($id)
    {
        $chef = Chef::find($id);              

        if (!$chef) {
            return redirect()->back()->with('error', 'Chef not found.');
        }

        $token = encrypt(['id' => $chef->id, 'expires' => now()->addMinutes(5)]);

        return redirect()->to(route('direct-chef-login', urlencode($token)));
    }

    public function directChefLogin($token)
    {              
        if (!$token) {
            return redirect()->route('chef.login')->with('error', 'Invalid token.');
        }

        try {
            $data = decrypt($token);

            if (now()->greaterThan($data['expires'])) {
                return redirect()->route('chef.login')->with('error', 'Token expired.');
            }

            $chef = Chef::where('id', $data['id'])->first();

            if ($chef) {
                Auth::guard('chef')->login($chef);
                return redirect()->route('chef.dashboard');
            }

        } catch (\Exception $e) {
            return redirect()->route('chef.login')->with('error', 'Invalid token.');
        }
    }


    public function loginFranchise($id)
    {
        $franchise = Franchise::find($id);              

        if (!$franchise) {
            return redirect()->back()->with('error', 'Franchise not found.');
        }

        $token = encrypt(['id' => $franchise->id, 'expires' => now()->addMinutes(5)]);

        return redirect()->to(route('direct-franchise-login', urlencode($token)));
    }

    public function directFranchiseLogin($token)
    {              
        if (!$token) {
            return redirect()->route('franchise.login')->with('error', 'Invalid token.');
        }

        try {
            $data = decrypt($token);

            if (now()->greaterThan($data['expires'])) {
                return redirect()->route('franchise.login')->with('error', 'Token expired.');
            }

            $franchise = Franchise::where('id', $data['id'])->first();

            if ($franchise) {
                Auth::guard('franchise')->login($franchise);
                return redirect()->route('franchise.dashboard');
            }

        } catch (\Exception $e) {
            return redirect()->route('franchise.login')->with('error', 'Invalid token.');
        }
    }


}
