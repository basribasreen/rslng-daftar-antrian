<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Daftar Poliklinik</h2>
            <a href="{{ route('polis.create') }}"
               class="rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                + Poliklinik Baru
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-3">
                @forelse ($data as $poli)
                    <div class="flex items-start justify-between rounded bg-white p-4 shadow">
                        <div>
                            <h2 class="font-semibold">
                                {{ $poli->kode }}
                            </h2>
                            <h3 class="font-semibold">
                                {{ $poli->nama }}
                            </h3>
                            @if ($poli->deskripsi)
                                <p class="text-sm text-gray-600">{{ $poli->deskripsi }}</p>
                            @endif
                        </div>

                        <div class="flex gap-2 text-sm">
                            <a href="{{ route('polis.edit', $poli) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('polis.destroy', $poli) }}" method="POST"
                                onsubmit="return confirm('Hapus Poliklinik ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada tugas.</p>
                @endforelse
            </div>

            {{-- lalu paginasi: --}}
            <div class="mt-6">{{ $data->links() }}</div>
        </div>
    </div>
</x-app-layout>