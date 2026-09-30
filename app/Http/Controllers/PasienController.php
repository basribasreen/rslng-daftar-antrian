<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Pasien::class);
        $data = Pasien::query()
        ->search($request->query('q'))
        ->status($request->query('status'))
        ->latest()
        ->paginate(10)
        ->withQueryString();
        return view('pasiens.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Pasien::class);
        $item = new Pasien();
        return view('pasiens.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Pasien::class);
        $data = $request->validate([
            'kode'       => 'required|string|max:20|unique:pasien,kode',
            'nik'       => 'required|string|max:20|unique:pasien,nik',
            'nama'       => 'required|string|max:255',
            'phone' => 'nullable|string|max:16',
            'jenis_kelamin' => 'required|string|max:1'
        ]);

        Pasien::create($data);

        return redirect()->route('pasiens.index')
            ->with('success', 'data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        $this->authorize('view', $pasien);   
        return view('pasiens.show', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        $this->authorize('update', $pasien);
        return view('pasiens.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $this->authorize('update', $pasien);
        $data = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pasiens', 'kode')
                    ->ignore($pasien->id),
            ],
            'nik' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pasiens', 'nik')
                    ->ignore($pasien->id),
            ],
            'nama'          => 'required|string|max:255',
            'phone' => 'nullable|string|max 16',
            'jenis_kelamin' => 'required|string|max:1',
            'is_active'     => 'boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $pasien->update($data);

        return redirect()->route('pasiens.index')
            ->with('success', 'data diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        $this->authorize('delete', $pasien);
        $pasien->delete();
        return back()->with('success', 'data dihapus.');
    }
}
