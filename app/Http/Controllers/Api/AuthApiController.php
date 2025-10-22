<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\AdminHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if (!AdminHelper::isAdmin($user)) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya admin yang dapat login ke sistem ini'
                ], 403);
            }
            
            // Generate Sanctum token for API authentication
            $token = $user->createToken('auth-token')->plainTextToken;
            
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'username' => $user->username,
                        'email' => $user->email,
                        'role' => $user->role,
                    ],
                    'token' => $token
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username atau password salah'
        ], 401);
    }

    public function register(Request $request)
    {
        // Allow bootstrapping: if there is no admin yet, allow creating the first admin without auth
        $adminCount = User::where('role', 'admin')->count();
        $isBootstrapping = ($adminCount === 0);

        if (!$isBootstrapping) {
            // Use Sanctum guard for token-based auth on this public route
            $authUser = auth('sanctum')->user();
            if (!$authUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu'
                ], 401);
            }
            if (!AdminHelper::isAdmin($authUser)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya admin yang dapat melakukan registrasi user baru'
                ], 403);
            }
        }

        // Only admin accounts are allowed to be created via this API
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            // role forced to admin
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $newUser = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'admin',
        ]);

        return response()->json([
            'success' => true,
            'message' => $isBootstrapping ? 'Admin pertama berhasil dibuat' : 'Admin baru berhasil dibuat',
            'data' => [
                'user' => [
                    'id' => $newUser->id,
                    'name' => $newUser->name,
                    'username' => $newUser->username,
                    'email' => $newUser->email,
                    'role' => $newUser->role,
                ]
            ]
        ], 201);
    }

    public function logout(Request $request)
    {
        // Revoke the Sanctum token that was used to authenticate the request (if any)
        $authUser = $request->user();
        if ($authUser && $authUser->currentAccessToken()) {
            $authUser->currentAccessToken()->delete();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    public function profile()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Silakan login terlebih dahulu'
            ], 401);
        }

        $user = Auth::user();
        
        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->role,
                ]
            ]
        ]);
    }
}
