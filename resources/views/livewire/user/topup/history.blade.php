<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $topUps;

    public function mount()
    {
        $this->loadHistory();
    }

    public function loadHistory()
    {
        $this->topUps = Auth::user()->topUps()->latest()->get();
    }
};
?>

<div class="min-h-screen bg-gray-50">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Top Up</h2>

    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="text-gray-600 border-b border-gray-200">
                    <th class="pb-2 text-left">ID</th>
                    <th class="pb-2 text-left">Nominal</th>
                    <th class="pb-2 text-left">Status</th>
                    <th class="pb-2 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topUps as $topUp)
                    <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition-colors">
                        <td class="py-2">{{ $topUp->id }}</td>
                        <td class="py-2">Rp {{ number_format($topUp->amount,0,',','.') }}</td>
                        <td class="py-2">
                            <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold rounded-full shadow-sm
                                @if($topUp->status === 'completed') bg-green-100 text-green-700
                                @elseif($topUp->status === 'pending') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700 @endif">
                                
                                @if($topUp->status === 'completed') ✅
                                @elseif($topUp->status === 'pending') ⏳
                                @else ⬜ @endif

                                {{ ucfirst($topUp->status) }}
                            </span>
                        </td>
                        <td class="py-2">{{ $topUp->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada riwayat top up</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
