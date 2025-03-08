<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use App\Models\Franchise;
use MannikJ\Laravel\Wallet\Models\Transaction;
use DB;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = [
            'name' => $request->name,
            'type' => $request->type,
        ];

        $searchName = $request->name;

        $transactions = Transaction::with(['wallet', 'wallet.owner']);

        if ($searchName) {
            $transactions = $transactions->whereHas('wallet.owner', function ($query) use ($searchName) {
                $query->where('firstname', 'LIKE', "%{$searchName}%")
                ->orWhere('lastname', 'LIKE', "%{$searchName}%")
                ->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'LIKE', "%{$searchName}%");
            });
        }

        if ($request->type) {
            $transactions = $transactions->where('type', 'LIKE', "%{$request->type}%");
        }

        $transactions = $transactions->latest()->paginate(20);


        $transaction_list = Transaction::select(DB::raw("DATE(created_at) as date"), 'type', DB::raw("COUNT(*) as count"))
        ->groupBy('date', 'type')
        ->orderBy('date', 'ASC');

        if ($request->type) {
            $transaction_list->where('type', 'LIKE', "%{$request->type}%");
        }

        $transaction_list = $transaction_list->get();

        $franchises = Franchise::all();


        return view('admin.transactions.list', compact('transactions', 'filter', 'franchises', 'transaction_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statement = DB::select("SHOW TABLE STATUS LIKE 'transactions'");
        $nextId = $statement[0]->Auto_increment;
        return view('admin.transactions.create', compact('nextId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {              

        $this->validate($request, [
            'name'          => ['required'],
            'model_number'      => ['required', 'unique:transactions'],
            'quantity'          => ['required'],
            'status'            => ['required'],

        ]);

        $part                = new WalletTransaction();
        $part->name          = $request->name;
        $part->description   = $request->description;
        $part->price         = $request->price;
        $part->model_number  = $request->model_number;
        $part->serial_number = $request->serial_number;
        $part->quantity      = $request->quantity;
        $part->refrence      = $request->refrence;
        $part->status        = $request->status;
        $part->save();

       if($request->hasfile('images'))
        {
           foreach($request->file('images') as $file)
           {
               $image_name      = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/transactions/'.$part->id.'/images', $image_name, 'public');
               WalletTransactionImage::create([
                   'product_id'    => $part->id,
                   'name'       => $image_name
               ]);
           }
        }

        return redirect()->route('admin.transactions.index')->with('success', 'WalletTransaction created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product       = WalletTransaction::find($id);
        return view('admin.transactions.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product       = WalletTransaction::find($id);
        return view('admin.transactions.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'              => ['required'],
            'model_number'      => ['required', 'unique:transactions,model_number,' . $id],
            'quantity'          => ['required'],
            'status'            => ['required'],
        ]);

        $part                       = WalletTransaction::find($id);
        $part->name          = $request->name;
        $part->description   = $request->description;
        $part->price         = $request->price;
        $part->model_number  = $request->model_number;
        $part->serial_number = $request->serial_number;
        $part->quantity      = $request->quantity;
        $part->refrence      = $request->refrence;
        $part->status        = $request->status;
        $part->save();

       if($request->hasfile('images'))
        {
           foreach($request->file('images') as $file)
           {
               $image_name = time().rand(1,50).'.'.$file->extension();
               $file->storeAs('uploads/transactions/'.$part->id.'/images', $image_name, 'public');
               WalletTransactionImage::create([
                   'product_id' => $part->id,
                   'name'     => $image_name
               ]);
           }
        }

        return redirect()->route('admin.transactions.index')->with('success', 'WalletTransaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        WalletTransaction::find($id)->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'WalletTransaction deleted successfully');
    }

    public function deleteImage(Request $request, $id){
        WalletTransactionImage::find($id)->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }

    public function deleteDocument(Request $request, $id){
        WalletTransactionDocument::find($id)->delete();
        return redirect()->back()->with('success', 'Document deleted successfully');
    }
}
