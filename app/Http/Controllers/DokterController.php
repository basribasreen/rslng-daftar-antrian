<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Dokter::class);
        $data = Dokter::query()
        ->search($request->query('q'))
        ->status($request->query('status'))
        ->latest()
        ->paginate(10)
        ->withQueryString();
        return view('dokters.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Dokter::class);
        $item = new Dokter();
        return view('dokters.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Dokter::class);
        $data = $request->validate([
            'kode'       => 'required|string|max:20|unique:dokter,kode',
            'nama'       => 'required|string|max:255',
            'spesialis'       => 'nullable|string|max:100',
            'phone' => 'nullable|string|max 16',
            'jenis_kelamin' => 'required|string|max:1'
        ]);

        Dokter::create($data);

        return redirect()->route('dokter.index')
            ->with('success', 'data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        $this->authorize('view', $dokter);   
        return view('dokters.show', compact('dokter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokter $dokter)
    {
        $this->authorize('update', $dokter);
        return view('dokters.edit', compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokter $dokter)
    {
        $this->authorize('update', $dokter);
        $data = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:20',
                Rule::unique('dokters', 'kode')
                    ->ignore($dokter->id),
            ],
            'nama'          => 'required|string|max:255',
            'spesialis'       => 'nullable|string|max:100',
            'phone' => 'nullable|string|max 16',
            'jenis_kelamin' => 'required|string|max:1',
            'is_active'     => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $dokter->update($data);

        return redirect()->route('dokters.index')
            ->with('success', 'data diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokter $dokter)
    {
        $this->authorize('delete', $dokter);
        $dokter->delete();
        return back()->with('success', 'data dihapus.');
    }
}
