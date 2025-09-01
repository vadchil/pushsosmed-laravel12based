<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $amount;
    public $successMessage;
    public $errors = [];

    public function updatedAmount()
    {
        if (!is_numeric($this->amount) || $this->amount <= 0) {
            $this->errors['amount'] = "Masukkan nominal valid lebih dari 0.";
        } else {
            $this->errors['amount'] = null;
        }
    }

    public function submitTopUp()
    {
        $this->updatedAmount(); // cek validasi

        if (!empty($this->errors['amount'])) {
            return;
        }

        $user = Auth::user();
        $user->balance += $this->amount;
        $user->save();

        // Simpan riwayat top up
        $user->topUps()->create([
            'amount' => $this->amount,
            'status' => 'completed',
        ]);

        $this->successMessage = "Top up Rp ".number_format($this->amount,0,',','.')." berhasil.";
        $this->amount = '';
    }
};
?>

<div class="min-h-screen bg-gray-50 max-w-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Top Up Saldo</h2>

    @if($successMessage)
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
            {{ $successMessage }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col gap-4">
        <label class="text-gray-600">Nominal Top Up (Rp)</label>
        <input type="number" wire:model="amount" class="border p-2 rounded" />
        @if(isset($errors['amount'])) <span class="text-red-600 text-sm">{{ $errors['amount'] }}</span> @endif

        <button wire:click="submitTopUp"
                class="mt-2 px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">
            Top Up Sekarang
        </button>
    </div>
</div>
