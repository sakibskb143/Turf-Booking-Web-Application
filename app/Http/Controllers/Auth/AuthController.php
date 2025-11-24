<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registerUser(Request $request): RedirectResponse
    {
        return $this->handleRegistration(
            $request,
            role: 'user',
            redirectRoute: 'user.dashboard',
            message: 'Account created successfully.'
        );
    }

    public function registerOwner(Request $request): RedirectResponse
    {
        return $this->handleRegistration(
            $request,
            role: 'owner',
            redirectRoute: 'owner.dashboard',
            message: 'Owner account created successfully.'
        );
    }

    public function registerAdmin(Request $request): RedirectResponse
    {
        return $this->handleRegistration(
            $request,
            role: 'admin',
            redirectRoute: 'admin.dashboard',
            message: 'Admin account created successfully.'
        );
    }

    public function loginUser(Request $request): RedirectResponse
    {
        return $this->attemptLogin($request, 'user', 'user.dashboard');
    }

    public function loginOwner(Request $request): RedirectResponse
    {
        return $this->attemptLogin($request, 'owner', 'owner.dashboard');
    }

    public function loginAdmin(Request $request): RedirectResponse
    {
        return $this->attemptLogin($request, 'admin', 'admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $role = $request->user()?->role;

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $redirectRoute = match ($role) {
            'owner' => 'owners.login',
            'admin' => 'admin.login',
            default => 'users.login',
        };

        return redirect()->route($redirectRoute)->with('status', 'You have been logged out.');
    }

    protected function validateRegistration(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'terms' => ['sometimes', 'accepted'],
        ]);
    }

    protected function attemptLogin(Request $request, string $role, string $redirectRoute): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials['role'] = $role;
        $credentials['status'] = 'active';

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route($redirectRoute));
    }

    protected function createAccount(array $validated, string $role): User
    {
        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'password' => $validated['password'],
            'role' => $role,
            'status' => 'active',
        ]);
    }

    protected function handleRegistration(
        Request $request,
        string $role,
        string $redirectRoute,
        string $message
    ): RedirectResponse {
        $validated = $this->validateRegistration($request);

        $account = $this->createAccount($validated, $role);

        Auth::login($account);
        $request->session()->regenerate();

        return redirect()->route($redirectRoute)->with('status', $message);
    }
}

