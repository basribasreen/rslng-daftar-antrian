<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JenisPembayaran;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Pendaftaran::class);
        $data = Pendaftaran::query()
        ->search($request->query('q'))
        ->status($request->query('status'))
        ->latest()
        ->paginate(10)
        ->withQueryString();
        return view('pendaftarans.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Pendaftaran::class);
        $item = new Pendaftaran();
        $pasien = Pasien::all(['id', 'kode', 'nama']);
        $dokter = Dokter::all(['id', 'kode', 'nama']);
        $polis = Poli::all(['id', 'kode', 'nama']);
        $jenisPembayaran = JenisPembayaran::all(['id', 'kode','nama']);
        return view('pendaftarans.create', [
            'pendaftaran' => $item,
            'pasiens' => $pasien,
            'dokters' => $dokter,
            'polis' => $polis,
            'jenisPembayaran' => $jenisPembayaran,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Pendaftaran::class);
        $data = $request->validate([
            // 'kode'       => 'required|string|max:20|unique:pendaftaran,kode',
            'kode'       => 'required|string|max:20|unique:pendaftarans',
            'id_pasien'       => 'required|string|max:255',
            'id_poli'       => 'required|string|max:255',
            'id_dokter'       => 'required|string|max:255',
            'id_pembayaran'       => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'nomor_antrian'       => 'nullable|string|max:10',
            'status' => 'string|max:20',
        ]);

        $result = Pendaftaran::create($data);
        var_dump($result);
        return redirect()->route('pendaftarans.index')
            ->with('success', 'data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        $this->authorize('view', $pendaftaran);   
        return view('pendaftarans.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        $this->authorize('update', $pendaftaran);
        return view('pendaftarans.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $this->authorize('update', $pendaftaran);
        $data = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pendaftarans', 'kode')
                    ->ignore($pendaftaran->id),
            ],
            // 'kode'       => 'required|string|max:20|unique:pendaftaran,kode',
            'id_pasien'       => 'required|string|max:255',
            'id_poli'       => 'required|string|max:255',
            'id_dokter'       => 'required|string|max:255',
            'id_pembayaran'       => 'required|string|max:255',
            'tanggal'       => 'required|date',
            'nomor_antrian'       => 'nullable|string|max:10',
            'status' => 'string|max:20',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $pendaftaran->update($data);

        return redirect()->route('pendaftarans.index')
            ->with('success', 'data diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        $this->authorize('delete', $pendaftaran);
        $pendaftaran->delete();
        return back()->with('success', 'data dihapus.');
    }
}
