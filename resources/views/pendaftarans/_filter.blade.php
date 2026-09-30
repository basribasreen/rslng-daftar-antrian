<form method="GET" action="{{ route('pendaftarans.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="q" value="{{ request('q') }}"
           placeholder="Cari Pendaftaran..."
           class="flex-1 rounded border px-3 py-2">

    <select name="status" class="rounded border px-3 py-2">
        <option value="">Semua</option>
        <option value="menunggu" @selected(request('status') === 'menunggu')>Menunggu</option>
        <option value="dipanggil" @selected(request('status') === 'dipanggil')>Dipanggil</option>
        <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
    </select>

    <button class="rounded bg-gray-800 px-4 py-2 text-white">Cari</button>

    @if (request()->hasAny(['q', 'status']))
        <a href="{{ route('pendaftarans.index') }}" class="px-2 py-2 text-gray-600">Reset</a>
    @endif
</form>