<?php
namespace App\Repositories\Interfaces;
interface AdminRepositoryInterface
{
    public function fetchUsers(array $params);
    public function approveUser(int $id);
    public function suspendUser(int $id);

    public function approveProduct(int $id);
    public function suspendProduct(int $id);

    public function approveArticle(int $id);
    public function suspendArticle(int $id);
    public function getStatistics();
}
