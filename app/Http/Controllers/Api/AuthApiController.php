<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthApiController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function signup(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'mobile_number' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        /** @var User $user */
        $user = $this->authService->register($validated);

        $token = $user->createToken('visionboard_auth')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'action' => [
                'type' => 'navigate',
                'to' => '/profile',
            ],
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'mobile_number' => $user->mobile_number,
            ],
            'token' => $token,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = $this->authService->validateCredentials($data['email'], $data['password']);

        if (! $user) {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'credentials' => ['These credentials do not match our records.'],
                ],
            ], 401);
        }

        $token = $user->createToken('visionboard_auth')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'action' => [
                'type' => 'navigate',
                'to' => '/',
            ],
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'mobile_number' => $user->mobile_number,
            ],
            'token' => $token,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        return response()->json([
            'status' => 'success',
            'action' => [
                'type' => 'navigate',
                'to' => '/',
            ],
        ]);
    }
}
