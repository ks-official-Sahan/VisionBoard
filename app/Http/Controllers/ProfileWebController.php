<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileWebController extends Controller
{
    public function __construct(private readonly ProfileService $profileService)
    {
    }

    public function show(Request $request): View
    {
        return view('public.pages.profile');
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile_number' => ['required', 'string', 'max:20'],
            'current_password' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (! empty($validated['password']) && ! $this->profileService->checkCurrentPassword($user, $validated['current_password'] ?? null)) {
            return back()
                ->withErrors(['current_password' => 'Your current password is incorrect.'])
                ->withInput($request->except('password', 'password_confirmation'));
        }

        $this->profileService->updateProfile($user, $validated);

        return redirect()->route('profile');
    }

    public function uploadImage(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'profile_image' => ['required', 'image', 'max:2048'],
        ]);

        $this->profileService->updateProfileImage($user, $validated['profile_image']);

        return redirect()->route('profile');
    }
}
