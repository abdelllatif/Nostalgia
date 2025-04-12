<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Services\BidService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    protected $bidservice;
    public function __construct(BidService $bidService)
    {
    $this->bidservice=$bidService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validater=$request->validate([
            'amount'=>'required|numeric|min:0',
            'product_id'=>'required|exists:products,id'
        ]);
        $validater['user_id']=Auth::user()->id;
        $bid=$this->bidservice->storeaBid($validater);
        if(!$bid){
            return back()->with('error','your bid not added');
        }
        return back()->with('success','your bid  added succsesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($bidId)
    {
        return $this->bidservice->getproductbids($bidId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bid $bid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
