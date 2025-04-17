<?php
namespace App\Http\Controllers;
use App\Services\AdminService;
use App\Models\User;
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

    public function users(Request $request)
    {
        $users = $this->adminService->fetchUsers($request->all());

        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    }


    public function approveUser($id)
    {
        $response = $this->adminService->approveUser($id);
        return response()->json($response, $response['success'] ? 200 : 404);
    }

    public function suspendUser($id)
    {
        $response = $this->adminService->suspendUser($id);
        return response()->json($response, $response['success'] ? 200 : 404);
    }

    public function approveProduct($id)
    {
        $response = $this->adminService->approveProduct($id);
        return response()->json($response, $response['success'] ? 200 : 404);
    }

    public function suspendProduct($id)
    {
        $response = $this->adminService->suspendProduct($id);
        return response()->json($response, $response['success'] ? 200 : 404);
    }

    public function approveArticle($id)
    {
        $response = $this->adminService->approveArticle($id);
        return response()->json($response, $response['success'] ? 200 : 404);
    }

    public function suspendArticle($id)
    {
        $response = $this->adminService->suspendArticle($id);
        return response()->json($response, $response['success'] ? 200 : 404);
    }

    public function getStatistics()
    {
        $response = $this->adminService->getStatistics();
        return response()->json($response, 200);
    }
}
