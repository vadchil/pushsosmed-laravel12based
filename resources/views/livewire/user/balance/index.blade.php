<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $balance;

    public function mount()
    {
        $this->loadBalance();
    }

    // Method untuk load saldo terbaru
    public function loadBalance()
    {
        $this->balance = Auth::user()->balance ?? 0;
    }
};
?>

<div class="min-h-screen bg-gray-50">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Saldo Saya</h2>

    <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col gap-4">
        <div class="text-gray-600">Total Saldo Saat Ini:</div>
        <div class="text-4xl font-bold text-green-600">
            Rp {{ number_format($balance, 0, ',', '.') }}
        </div>

        <button wire:click="loadBalance"
                class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
            Refresh Saldo
        </button>
    </div>
</div>
