<?php

use Livewire\Volt\Component;

new class extends Component {
    //
};
?>

<div class="p-6">
    <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow">
            <h2 class="text-lg font-semibold">Jumlah User</h2>
            <p class="text-2xl mt-2">150</p>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow">
            <h2 class="text-lg font-semibold">Order Hari Ini</h2>
            <p class="text-2xl mt-2">23</p>
        </div>

        <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl shadow">
            <h2 class="text-lg font-semibold">Pendapatan</h2>
            <p class="text-2xl mt-2">Rp 1.200.000</p>
        </div>
    </div>
</div>
