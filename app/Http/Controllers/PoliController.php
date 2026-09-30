<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Poli::class);
        $data = Poli::query()
        ->search($request->query('q'))
        ->status($request->query('status'))
        ->latest()
        ->paginate(10)
        ->withQueryString();
        return view('polis.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Poli::class);
        $item = new Poli();
        return view('polis.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Poli::class);
        $data = $request->validate([
            'kode'       => 'required|string|max:20|unique:polis,kode',
            'nama'       => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Poli::create($data);

        return redirect()->route('polis.index')
            ->with('success', 'data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poli $poli)
    {
        $this->authorize('view', $poli);   
        return view('polis.show', compact('poli'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poli $poli)
    {
        $this->authorize('update', $poli);
        return view('polis.edit', compact('poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poli $poli)
    {
        $this->authorize('update', $poli);
        $data = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:20',
                Rule::unique('polis', 'kode')
                    ->ignore($poli->id),
            ],
            'nama'          => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'is_active'     => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $poli->update($data);

        return redirect()->route('polis.index')
            ->with('success', 'data diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poli $poli)
    {
        $this->authorize('delete', $poli);
        $poli->delete();
        return back()->with('success', 'data dihapus.');
    }
}
