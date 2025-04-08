<?php
namespace App\Repositories\Interfaces;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll($filterby);
    public function findById($id);
    public function create(array $data);
    public function GetUserproduct($userId);
    public function update($id, array $data);
    public function delete($id);
}
