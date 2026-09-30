<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">Daftar Dokter</h2>
            <a href="{{ route('dokters.create') }}"
               class="rounded bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">
                + Dokter Baru
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-3">
                @forelse ($data as $dokter)
                    <div class="flex items-start justify-between rounded bg-white p-4 shadow">
                        <div>
                            <h2 class="font-semibold">
                                {{ $dokter->kode }}
                            </h2>
                            <h3 class="font-semibold">
                                {{ $dokter->nama }}
                            </h3>
                            <h3 class="font-semibold">
                                {{ $dokter->spesialis }}
                            </h3>
                            @if ($dokter->nohp)
                                <p class="text-sm text-gray-600">{{ $dokter->nohp }}</p>
                            @endif
                            @if ($dokter->jenis_kelamin)
                                <p class="text-sm text-gray-600">{{ $dokter->jenis_kelamin }}</p>
                            @endif
                        </div>

                        <div class="flex gap-2 text-sm">
                            <a href="{{ route('dokters.edit', $dokter) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('dokters.destroy', $dokter) }}" method="POST"
                                onsubmit="return confirm('Hapus Data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada Data Dokter.</p>
                @endforelse
            </div>

            {{-- lalu paginasi: --}}
            <div class="mt-6">{{ $data->links() }}</div>
        </div>
    </div>
</x-app-layout>