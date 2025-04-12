<?php
namespace App\Repositories;

use App\Models\Bid;
use App\Repositories\Interfaces\BidRepositoryInterface;

class BidRepository implements BidRepositoryInterface{

public function getAllbids($idproduct)
{
return Bid::where('product_id',$idproduct)->get();
}

public function addBid(array $data)
{

}


}
