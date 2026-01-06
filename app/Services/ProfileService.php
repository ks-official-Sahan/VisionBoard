<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    public function updateProfile(User $user, array $data): void
    {
        $user->name = $data['name'];
        $user->mobile_number = $data['mobile_number'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();
    }

    public function checkCurrentPassword(User $user, ?string $currentPassword): bool
    {
        if ($currentPassword === null || $currentPassword === '') {
            return false;
        }

        return Hash::check($currentPassword, $user->password);
    }

    public function updateProfileImage(User $user, UploadedFile $file): string
    {
        if ($user->profile_image_path) {
            Storage::disk('public')->delete($user->profile_image_path);
        }

        $path = $file->store('profile-images', 'public');

        $user->profile_image_path = $path;
        $user->save();

        return $path;
    }

    public function profileArray(User $user): array
    {
        $imageUrl = $user->profile_image_path
            ? Storage::disk('public')->url($user->profile_image_path)
            : null;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'mobile_number' => $user->mobile_number,
            'profile_image_url' => $imageUrl,
        ];
    }
}
