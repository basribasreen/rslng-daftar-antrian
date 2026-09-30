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
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-3">
                @forelse ($data as $item)
                    <div class="flex items-start justify-between rounded bg-white p-4 shadow">
                        <div>
                            <h2 class="font-semibold">
                                {{ $item->kode }}
                            </h2>
                        </div>

                        <div class="flex gap-2 text-sm">
                            <a href="{{ route('pendaftarans.edit', $item) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('pendaftarans.destroy', $item) }}" method="POST"
                                onsubmit="return confirm('Hapus Data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada Data Pendaftaran.</p>
                @endforelse
            </div>

            {{-- lalu paginasi: --}}
            <div class="mt-6">{{ $data->links() }}</div>
        </div>
    </div>
</x-app-layout>