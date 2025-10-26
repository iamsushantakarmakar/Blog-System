<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            Log::info('Social login callback started', ['provider' => $provider]);

            $socialUser = Socialite::driver($provider)->user();

            Log::info('Social user retrieved', [
                'email' => $socialUser->getEmail(),
                'name' => $socialUser->getName(),
                'id' => $socialUser->getId()
            ]);

            // Check if user exists
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                Log::info('Existing user found', ['user_id' => $user->id]);

                // Update provider info if not set
                if (!$user->provider) {
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                        'avatar' => $socialUser->getAvatar(),
                    ]);
                }
            } else {
                Log::info('Creating new user');

                // Create new user
                $user = User::create([
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'password' => Hash::make(Str::random(24)),
                    'email_verified_at' => now(),
                ]);

                Log::info('New user created', ['user_id' => $user->id]);
            }

            Auth::login($user, true);

            Log::info('User logged in', ['user_id' => $user->id, 'authenticated' => Auth::check()]);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            Log::error('Social login error', [
                'provider' => $provider,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect('/login')->with('error', 'Unable to login with ' . $provider . ': ' . $e->getMessage());
        }
    }
}
