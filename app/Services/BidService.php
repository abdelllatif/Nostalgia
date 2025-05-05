<?php
namespace App\Services;

use App\Repositories\BidRepository;

class BidService{
protected $bidrepository;

public function __construct(BidRepository $bidrepository)
{
$this->bidrepository=$bidrepository;
}
public function getproductbids($id){
    return $this->bidrepository->getAllbids($id);
}
public function storeaBid($data){
    return $this->bidrepository->addBid($data);
}
}
