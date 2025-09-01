<?php

use Livewire\Volt\Component;
use App\Models\SupportTicket;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    public $tickets;

    public function mount()
    {
        $this->loadTickets();
    }

    // Ambil semua tiket support user
    public function loadTickets()
    {
        $this->tickets = SupportTicket::where('user_id', Auth::id())
                                      ->latest()
                                      ->get();
    }
};
?>

<div class="min-h-screen bg-gray-50" wire:poll.5s>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Support / Bantuan</h2>

    <a href="#"
       class="inline-block mb-6 px-5 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition">
        + Buat Tiket Baru
    </a>

    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="text-gray-600 border-b border-gray-200">
                    <th class="pb-2 text-left">ID</th>
                    <th class="pb-2 text-left">Judul</th>
                    <th class="pb-2 text-left">Status</th>
                    <th class="pb-2 text-left">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                    <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition-colors">
                        <td class="py-2">{{ $ticket->id }}</td>
                        <td class="py-2">{{ $ticket->title }}</td>
                        <td class="py-2">
                            <span class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold rounded-full shadow-sm
                                @if($ticket->status === 'open') bg-yellow-100 text-yellow-700
                                @elseif($ticket->status === 'closed') bg-green-100 text-green-700
                                @else bg-gray-100 text-gray-700 @endif">
                                
                                @if($ticket->status === 'open') ⏳
                                @elseif($ticket->status === 'closed') ✅
                                @else ⬜ @endif

                                {{ ucfirst($ticket->status) }}
                            </span>
                        </td>
                        <td class="py-2">{{ $ticket->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada tiket</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
