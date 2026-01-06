<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Register a new user.
     */
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Attempt a session-based login. Returns the authenticated user or null.
     */
    public function attemptLogin(array $credentials, bool $remember = false): ?Authenticatable
    {
        if (! Auth::attempt($credentials, $remember)) {
            return null;
        }

        return Auth::user();
    }

    /**
     * Attempt an API login and return the user if credentials are valid.
     */
    public function validateCredentials(string $email, string $password): ?User
    {
        /** @var User|null $user */
        $user = User::where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }
}
