<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email'] = strtolower($validated['email']); // pastikan email lowercase

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard'));
    }
};
?>

<div class="bg-white rounded-2xl shadow p-8">
    <!-- Header -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create an account</h1>
        <p class="text-gray-800 mt-2">Enter your details below to create your account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center text-sm text-green-600" :status="session('status')" />

    <!-- Form -->
    <form method="POST" wire:submit.prevent="register" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-800">Full name</label>
            <input id="name" type="text" wire:model="name" name="name" placeholder="John Doe"
                   required autofocus autocomplete="name"
                   class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-medium text-gray-800">Username</label>
            <input id="username" type="text" wire:model="username" name="username" placeholder="johndoe123"
                   required autocomplete="username"
                   class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
            @error('username')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-800">Email address</label>
            <input id="email" type="email" wire:model="email" name="email" placeholder="email@example.com"
                   required autocomplete="email"
                   class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-800">Password</label>
            <input id="password" type="password" wire:model="password" name="password" placeholder="********"
                   required autocomplete="new-password"
                   class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-800">Confirm password</label>
            <input id="password_confirmation" type="password" wire:model="password_confirmation" name="password_confirmation" placeholder="********"
                   required autocomplete="new-password"
                   class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit"
                class="w-full px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
            Create account
        </button>
    </form>

    <!-- Login link -->
    <p class="mt-5 text-center text-sm text-gray-800">
        Already have an account?
        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log in</a>
    </p>
</div>
