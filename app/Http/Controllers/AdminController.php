<?php
namespace App\Http\Controllers;
use App\Services\AdminService;

use App\Services\UserService;
use Illuminate\Http\Request;
class AdminController extends UserController
{
    protected $adminService;

    public function __construct(AdminService $adminService, UserService $userService)
    {
        parent::__construct($userService);
        $this->adminService = $adminService;
    }
    public function approveUser($id)
    {
        return response()->json($this->adminService->approveUser($id));
    }

    public function suspendUser($id)
    {
        return response()->json($this->adminService->suspendUser($id));
    }
    public function approveProduct($id)
    {
        return response()->json($this->adminService->approveProduct($id));
    }

    public function suspendProduct($id)
    {
        return response()->json($this->adminService->suspendProduct($id));
    }
    public function approveArticle($id)
    {
        return response()->json($this->adminService->approveArticle($id));
    }

    public function suspendArticle($id)
    {
        return response()->json($this->adminService->suspendArticle($id));
    }
    public function getStatistics()
    {
        return response()->json($this->adminService->getStatistics());
    }
}
