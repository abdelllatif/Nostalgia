<?php
namespace App\Repositories;

use App\Models\Bid;
use App\Repositories\Interfaces\BidRepositoryInterface;

class BidRepository implements BidRepositoryInterface{

public function getAllbids($idproduct)
{
return Bid::with('user')->where('product_id',$idproduct)->get();
}

public function addBid(array $data)
{
return Bid::create($data);
}


}
