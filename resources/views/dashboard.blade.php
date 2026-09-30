<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @php
        $cards = [
            ['label' => 'Pendaftaran hari ini', 'value' => $data['hari_ini']],
            ['label' => 'Menunggu',             'value' => $data['menunggu']],
            ['label' => 'Dipanggil',            'value' => $data['dipanggil']],
            ['label' => 'Selesai',              'value' => $data['selesai']],
            ['label' => 'Pendaftaran bulan ini','value' => $data['bulan_ini']],
            ['label' => 'Total pasien',         'value' => $data['total_pasien']],
            ['label' => 'Total dokter',         'value' => $data['total_dokter']],
            ['label' => 'Total poli',           'value' => $data['total_poli']],
        ];
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
                        @foreach ($cards as $card)
                            <div class="rounded-lg border-l-4 bg-white p-4 shadow">
                                <p class="text-sm text-gray-500">{{ $card['label'] }}</p>
                                <p class="mt-1 text-3xl font-bold">{{ number_format($card['value']) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
