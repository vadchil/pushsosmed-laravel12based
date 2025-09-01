<?php

use Livewire\Volt\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    // Properti public supaya bisa diakses di Blade
    public $orders;

    // Mount method dijalankan saat komponen pertama kali di-load
    public function mount()
    {
        $this->orders = Order::where('user_id', Auth::id())
                             ->latest()
                             ->get();
    }
    
    // Optional: method untuk refresh data
    public function refreshOrders()
    {
        $this->orders = Order::where('user_id', Auth::id())
                             ->latest()
                             ->get();
    }
};
?>

<div wire:poll.5s>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pesanan</h2>

    <a href="#"
       class="inline-block mb-6 px-5 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
        + Buat Pesanan Baru
    </a>

    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="text-gray-600 border-b border-gray-200">
                    <th class="pb-2 text-left">ID</th>
                    <th class="pb-2 text-left">Layanan</th>
                    <th class="pb-2 text-left">Jumlah</th>
                    <th class="pb-2 text-left">Status</th>
                    <th class="pb-2 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition-colors">
                        <td class="py-2">{{ $order->id }}</td>
                        <td class="py-2">{{ $order->service->name ?? '-' }}</td>
                        <td class="py-2">{{ $order->quantity }}</td>
                        <td class="py-2">
                            <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold rounded-full shadow-sm
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
                        <td class="py-2">{{ $order->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">Belum ada pesanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
