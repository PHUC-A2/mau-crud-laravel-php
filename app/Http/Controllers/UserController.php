<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return ApiResponse::success($users, 'Lấy danh sách người dùng thành công');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return ApiResponse::success($user, 'Tạo người dùng thành công', 201);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) return ApiResponse::error('Người dùng không tồn tại', 404);

        return ApiResponse::success($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) return ApiResponse::error('Người dùng không tồn tại', 404);

        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return ApiResponse::success($user, 'Cập nhật người dùng thành công');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) return ApiResponse::error('Người dùng không tồn tại', 404);

        $user->delete();
        return ApiResponse::success(null, 'Người dùng đã bị xoá');
    }
}
