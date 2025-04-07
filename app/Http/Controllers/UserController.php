<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return response()->json($this->userService->getAllUsers());
    }

    public function show($id)
    {
        $user = $this->userService->findUserById($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'first_name' => 'required|string|max:40',
            'phone_number' => 'nullable|string|max:15',
            'identity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        if ($request->hasFile('identity_image')) {
            $path = $request->file('identity_image')->store('identity_images', 'public');
            $validated['identity_image'] = $path;
        }
        $user = $this->userService->createUser($validated);
        return response()->json($user);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user = $this->userService->updateUser($id, $validated);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function destroy($id)
    {
        $deleted = $this->userService->deleteUser($id);
        if (!$deleted) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json(['message' => 'User deleted successfully']);
    }
}
