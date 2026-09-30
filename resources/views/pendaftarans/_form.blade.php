<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium">Nomor Registrasi</label>
        <input type="text" name="kode"
               value="{{ old('kode', $pendaftaran->kode ?? '') }}"
               class="mt-1 w-full rounded border px-3 py-2">
        @error('kode')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tanggal" class="block text-sm font-medium">
            Tanggal Pendaftaran
        </label>

        <input
            id="tanggal"
            type="date"
            name="tanggal"
            value="{{ old('tanggal', isset($pendaftaran->tanggal) ? $pendaftaran->tanggal->format('Y-m-d') : now()->format('Y-m-d')) }}"
            class="mt-1 w-full rounded border px-3 py-2"
        >

        @error('tanggal')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="nomor_antrian" class="block text-sm font-medium">
            Nomor Antrian
        </label>

        <input
            id="nomor_antrian"
            type="text"
            name="nomor_antrian"
            value="{{ old('nomor_antrian', $pendaftaran->nomor_antrian ?? '') }}"
            class="mt-1 w-full rounded border px-3 py-2"
        >

        @error('nomor_antrian')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="id_pasien" class="block text-sm font-medium">
            Pasien
        </label>

        <select
            id="id_pasien"
            name="id_pasien"
            class="mt-1 w-full rounded border px-3 py-2"
        >
            <option value="">-- Pilih Pasien --</option>

            @foreach ($pasiens as $pasien)
                <option
                    value="{{ $pasien->id }}"
                    @selected(old('id_pasien', $pendaftaran->id_pasien ?? '') == $pasien->id)
                >
                    {{ $pasien->kode }} - {{ $pasien->nama }}
                </option>
            @endforeach
        </select>

        @error('id_pasien')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="id_dokter" class="block text-sm font-medium">
            Dokter
        </label>

        <select
            id="id_dokter"
            name="id_dokter"
            class="mt-1 w-full rounded border px-3 py-2"
        >
            <option value="">-- Pilih Dokter --</option>

            @foreach ($dokters as $dokter)
                <option
                    value="{{ $dokter->id }}"
                    @selected(old('id_dokter', $pendaftaran->id_dokter ?? '') == $dokter->id)
                >
                    {{ $dokter->kode }} - {{ $dokter->nama }}
                </option>
            @endforeach
        </select>

        @error('id_dokter')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="id_poli" class="block text-sm font-medium">
            Poliklinik
        </label>

        <select
            id="id_poli"
            name="id_poli"
            class="mt-1 w-full rounded border px-3 py-2"
        >
            <option value="">-- Pilih Poliklinik --</option>

            @foreach ($polis as $poli)
                <option
                    value="{{ $poli->id }}"
                    @selected(old('id_poli', $pendaftaran->id_poli ?? '') == $poli->id)
                >
                    {{ $poli->kode }} - {{ $poli->nama }}
                </option>
            @endforeach
        </select>

        @error('id_poli')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="id_pembayaran" class="block text-sm font-medium">
            Jenis Pembayaran
        </label>

        <select
            id="id_pembayaran"
            name="id_pembayaran"
            class="mt-1 w-full rounded border px-3 py-2"
        >
            <option value="">-- Pilih Jenis Pembayaran --</option>

            @foreach ($jenisPembayaran as $jp)
                <option
                    value="{{ $jp->id }}"
                    @selected(old('id_pembayaran', $pendaftaran->id_pembayaran ?? '') == $jp->id)
                >
                    {{ $jp->kode }} - {{ $jp->nama }}
                </option>
            @endforeach
        </select>

        @error('id_pembayaran')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="block text-sm font-medium">
            Status
        </label>
        <select
            id="status"
            name="status"
            class="mt-1 w-full rounded border px-3 py-2"
        >
            <option value="">-- Pilih Status --</option>
            <option
                value="menunggu"
                @selected(old('status', $pendaftaran->status ?? '') === 'menunggu')
            >
                Menunggu
            </option>
            <option
                value="dipanggil"
                @selected(old('status', $pendaftaran->status ?? '') === 'dipanggil')
            >
                Dipanggil
            </option>
            <option
                value="selesai"
                @selected(old('status', $pendaftaran->status ?? '') === 'selesai')
            >
                Selesai
            </option>
        </select>

        @error('status')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
        Simpan
    </button>
    <a href="{{ route('pendaftarans.index') }}" class="ml-2 text-gray-600">Batal</a>
</div>