<?php
namespace App\Repositories\Interfaces;
interface AdminRepositoryInterface
{
    public function fetchUsers(array $params);
    public function approveUser($id);
    public function suspendUser($id);
    public function approveProduct($id);
    public function suspendProduct($id);
    public function approveArticle($id);
    public function suspendArticle($id);
    public function getStatistics();
}
