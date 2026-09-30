<?php

namespace App\Http\Controllers;

use App\Models\JenisPembayaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JenisPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', JenisPembayaran::class);
        $data = JenisPembayaran::query()
        ->search($request->query('q'))
        ->status($request->query('status'))
        ->latest()
        ->paginate(10)
        ->withQueryString();
        return view('pembayarans.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', JenisPembayaran::class);
        $item = new JenisPembayaran();
        return view('pembayarans.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', JenisPembayaran::class);
        $data = $request->validate([
            'kode'       => 'required|string|max:20|unique:pembayarans,kode',
            'nama'       => 'required|string|max:255',
        ]);

        JenisPembayaran::create($data);

        return redirect()->route('pembayarans.index')
            ->with('success', 'data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisPembayaran $jenisPembayaran)
    {
        $this->authorize('view', $jenisPembayaran);   
        return view('pemabayarans.show', compact('jenisPembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisPembayaran $jenisPembayaran)
    {
        $this->authorize('update', $jenisPembayaran);
        return view('pembayarans.edit', compact('jenisPembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisPembayaran $jenisPembayaran)
    {
        $this->authorize('update', $jenisPembayaran);
        $data = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pembayarans', 'kode')
                    ->ignore($jenisPembayaran->id),
            ],
            'nama'          => 'required|string|max:255',
            'is_active'     => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $jenisPembayaran->update($data);

        return redirect()->route('pembayarans.index')
            ->with('success', 'data diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisPembayaran $jenisPembayaran)
    {
        $this->authorize('delete', $jenisPembayaran);
        $jenisPembayaran->delete();
        return back()->with('success', 'data dihapus.');
    }
}
