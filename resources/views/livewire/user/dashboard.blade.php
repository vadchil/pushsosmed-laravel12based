<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

new class extends Component {
    public $balance;
    public $orders;

    public function mount()
    {
        $this->balance = Auth::user()->balance ?? 0;

        $this->orders = Order::with('service')->where('user_id', Auth::id())->latest()->take(5)->get();
    }
};
?>

<div class="min-h-screen bg-gray-50">
    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Judul -->
        <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>

        <!-- Saldo -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <p class="text-gray-700 font-medium">Saldo Anda</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">Rp {{ number_format($balance, 0, ',', '.') }}</p>
        </div>

        <!-- Pesanan Terbaru -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <h3 class="text-lg font-semibold mb-4 text-gray-900">Pesanan Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead>
                        <tr class="text-gray-600 border-b border-gray-200">
                            <th class="pb-2 text-left">Layanan</th>
                            <th class="pb-2 text-left">Jumlah</th>
                            <th class="pb-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition-colors">
                                <td class="py-2 text-gray-800">{{ $order->service->name }}</td>
                                <td class="py-2 text-gray-800">{{ $order->quantity }}</td>
                                <td class="py-2 text-center">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold rounded-full shadow-sm
                                        @if($order->status === 'completed') bg-green-100 text-green-700
                                        @elseif($order->status === 'processing') bg-yellow-100 text-yellow-700
                                        @elseif($order->status === 'canceled') bg-red-100 text-red-700
                                        @else bg-gray-100 text-gray-700 @endif">
                                        @if($order->status === 'completed') ✅
                                        @elseif($order->status === 'processing') ⏳
                                        @elseif($order->status === 'canceled') ❌
                                        @else ⬜ @endif
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-4 text-center text-gray-500">Belum ada pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tombol Buat Pesanan Baru -->
        <div class="pt-2">
            <a href="#" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl shadow-md font-semibold transition">
                + Buat Pesanan Baru
            </a>
        </div>
    </div>
</div>

