<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

new class extends Component {
    public $name;
    public $username;
    public $email;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;
    public $successMessage;
    public $errors = [];

    // Untuk preview
    public $previewName;
    public $previewUsername;
    public $previewEmail;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $this->previewName = $user->name;
        $this->username = $this->previewUsername = $user->username;
        $this->email = $this->previewEmail = $user->email;
    }

    // Live preview saat input berubah
    public function updated($property)
    {
        if (in_array($property, ['name','username','email'])) {
            $this->{'preview'.ucfirst($property)} = $this->$property;
        }
    }

    public function updateProfile()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_dash|unique:users,username,'.Auth::id(),
            'email' => 'required|email|max:255|unique:users,email,'.Auth::id(),
        ]);

        Auth::user()->update($validated);

        $this->successMessage = "Profil berhasil diperbarui.";
    }

    public function changePassword()
    {
        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->errors['current_password'] = "Password saat ini salah.";
            return;
        }

        if ($this->new_password !== $this->new_password_confirmation) {
            $this->errors['new_password_confirmation'] = "Konfirmasi password tidak cocok.";
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->successMessage = "Password berhasil diperbarui.";

        $this->current_password = $this->new_password = $this->new_password_confirmation = '';
    }
};
?>

<div class="min-h-screen bg-gray-50">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Pengaturan Akun</h2>

    @if($successMessage)
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            {{ $successMessage }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col gap-6 max-w-md">
        <h3 class="text-lg font-semibold text-gray-700">Informasi Profil</h3>

        <div class="flex flex-col gap-3">
            <label class="text-gray-600">Nama</label>
            <input type="text" wire:model="name" class="border p-2 rounded" />
            @if(isset($errors['name'])) <span class="text-red-600 text-sm">{{ $errors['name'] }}</span> @endif

            <label class="text-gray-600">Username</label>
            <input type="text" wire:model="username" class="border p-2 rounded" />
            @if(isset($errors['username'])) <span class="text-red-600 text-sm">{{ $errors['username'] }}</span> @endif

            <label class="text-gray-600">Email</label>
            <input type="email" wire:model="email" class="border p-2 rounded" />
            @if(isset($errors['email'])) <span class="text-red-600 text-sm">{{ $errors['email'] }}</span> @endif

            <button wire:click="updateProfile"
                    class="mt-2 px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
                Simpan Profil
            </button>
        </div>

        <hr class="my-4">

        <h3 class="text-lg font-semibold text-gray-700">Preview Profil</h3>
        <div class="bg-gray-50 p-4 rounded border border-gray-200 flex flex-col gap-2">
            <div><strong>Nama:</strong> {{ $previewName }}</div>
            <div><strong>Username:</strong> {{ $previewUsername }}</div>
            <div><strong>Email:</strong> {{ $previewEmail }}</div>
        </div>

        <hr class="my-4">

        <h3 class="text-lg font-semibold text-gray-700">Ubah Password</h3>

        <div class="flex flex-col gap-3">
            <label class="text-gray-600">Password Saat Ini</label>
            <input type="password" wire:model="current_password" class="border p-2 rounded" />
            @if(isset($errors['current_password'])) <span class="text-red-600 text-sm">{{ $errors['current_password'] }}</span> @endif

            <label class="text-gray-600">Password Baru</label>
            <input type="password" wire:model="new_password" class="border p-2 rounded" />
            @if(isset($errors['new_password'])) <span class="text-red-600 text-sm">{{ $errors['new_password'] }}</span> @endif

            <label class="text-gray-600">Konfirmasi Password Baru</label>
            <input type="password" wire:model="new_password_confirmation" class="border p-2 rounded" />
            @if(isset($errors['new_password_confirmation'])) <span class="text-red-600 text-sm">{{ $errors['new_password_confirmation'] }}</span> @endif

            <button wire:click="changePassword"
                    class="mt-2 px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700 transition">
                Ubah Password
            </button>
        </div>
    </div>
</div>
