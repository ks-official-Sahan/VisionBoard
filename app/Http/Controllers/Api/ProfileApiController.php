<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileApiController extends Controller
{
    public function __construct(private readonly ProfileService $profileService)
    {
    }

    public function show(Request $request): JsonResponse
    {
        $profile = $this->profileService->profileArray($request->user());

        return response()->json([
            'status' => 'success',
            'profile' => $profile,
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'mobile_number' => ['sometimes', 'required', 'string', 'max:20'],
            'current_password' => ['required_with:password', 'string'],
            'password' => ['sometimes', 'required', 'string', 'min:8', 'confirmed'],
        ]);

        if (isset($validated['password']) && ! $this->profileService->checkCurrentPassword($user, $validated['current_password'] ?? null)) {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'current_password' => ['The current password you entered is incorrect.'],
                ],
            ], 422);
        }

        // Merge current user data with provided fields
        $data = [
            'name' => $validated['name'] ?? $user->name,
            'mobile_number' => $validated['mobile_number'] ?? $user->mobile_number,
            'password' => $validated['password'] ?? null,
        ];

        $this->profileService->updateProfile($user, $data);

        return response()->json([
            'status' => 'success',
        ]);
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'profile_image' => ['required', 'image', 'max:2048'],
        ]);

        $path = $this->profileService->updateProfileImage($user, $validated['profile_image']);

        return response()->json([
            'status' => 'success',
            'profile_image_url' => asset('storage/' . $path),
        ], 201);
    }
}
