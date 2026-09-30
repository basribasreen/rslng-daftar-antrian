<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Daftar Pendaftaran</h2>
            <a href="{{ route('pendaftarans.create') }}"
               class="rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                + Pendaftaran Baru
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto sm:px-8 lg:px-12">
            @include('pendaftarans._filter')
            <div class="space-y-3">
                @include('pendaftarans._table')
            </div>

            {{-- lalu paginasi: --}}
            <div class="mt-6">{{ $data->links() }}</div>
        </div>
    </div>
</x-app-layout>