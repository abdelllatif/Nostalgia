<?php
namespace App\Repositories;

use App\Models\Bid;
use App\Repositories\Interfaces\BidRepositoryInterface;

class BidRepository implements BidRepositoryInterface{

public function getAllbids($idproduct)
{
return Bid::with('user')->where('product_id',$idproduct)->orderby('created_at','desc')->get();
}

public function addBid(array $data)
{
return Bid::create($data);
}


}
