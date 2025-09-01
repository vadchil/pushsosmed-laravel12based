<?php

use Livewire\Volt\Component;
use App\Models\Service;

new class extends Component {
    public $services;

    public function mount()
    {
        $this->loadServices();
    }

    // Ambil semua layanan dari database
    public function loadServices()
    {
        $this->services = Service::orderBy('name')->get();
    }
};
?>

<div class="min-h-screen bg-gray-50">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Layanan</h2>

    <div class="bg-white p-6 rounded-2xl shadow-md overflow-x-auto">
        <table class="w-full text-sm border-collapse">
            <thead>
                <tr class="text-gray-600 border-b border-gray-200">
                    <th class="pb-2 text-left">ID</th>
                    <th class="pb-2 text-left">Nama Layanan</th>
                    <th class="pb-2 text-left">Harga</th>
                    <th class="pb-2 text-left">Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr class="border-b border-gray-200 odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition-colors">
                        <td class="py-2">{{ $service->id }}</td>
                        <td class="py-2">{{ $service->name }}</td>
                        <td class="py-2">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td class="py-2">{{ $service->description ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada layanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
