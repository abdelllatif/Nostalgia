<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Services\BidService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\AuctionUpdated;

class BidController extends Controller
{
    protected $bidservice;
    protected $productController;

    public function __construct(BidService $bidService,ProductController $productController)
    {
    $this->bidservice=$bidService;
    $this->productController=$productController;
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
        $existingBids = $this->bidservice->getproductbids($request->product_id);
        if($existingBids->isEmpty()){
            if($request->amount>$this->productController->show($request->product_id)){
                return back()->with('error','Your bid must be greater than or equal to the starting price');
            }
        }
        else{
            $bigbid=$existingBids->first();
            if($request->amount<=$bigbid->amount){

        //        dd($request->amount<=$bigbid,$request->amount,$bigbid->amount);
                return back()->with('error','Your bid must be greater than the last bid');
            }
        }
        $bid=$this->bidservice->storeaBid($validater);
        if(!$bid){
            return back()->with('error','your bid not added');
        }
        event(new AuctionUpdated($bid));

        return back()->with('success','your bid  added succsesfully.'.$bid);
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
