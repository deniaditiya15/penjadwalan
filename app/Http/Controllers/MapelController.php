<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{



      /**
     * Panel kepsek: daftar mapel read-only (tanpa CRUD).
     */
    public function indexKepsek(Request $request)
    {
        $search = $request->input('search');

        $mapels = Mapel::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_mapel', 'like', "%{$search}%");
            })
            ->orderBy('nama_mapel', 'asc')
            ->paginate(10);

        $mapels->appends(['search' => $search]);

        // arahkan ke view guru.data_mapel.index
        return view('kepsek.data_mapel.index', compact('mapels', 'search'));
    }


      /**
     * Panel Guru: daftar mapel read-only (tanpa CRUD).
     */
    public function indexMapel(Request $request)
    {
        $search = $request->input('search');

        $mapels = Mapel::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_mapel', 'like', "%{$search}%");
            })
            ->orderBy('nama_mapel', 'asc')
            ->paginate(10);

        $mapels->appends(['search' => $search]);

        // arahkan ke view guru.data_mapel.index
        return view('guru.data_mapel.index', compact('mapels', 'search'));
    }
    /**
     * Tampilkan daftar mapel dengan pagination dan search.
     */
    public function index(Request $request)
    {
        $search = $request->input('search'); // Ambil keyword search

        $query = Mapel::query();

        // Jika ada keyword search, filter berdasarkan nama mapel
        if ($search) {
            $query->where('nama_mapel', 'like', "%{$search}%");
        }

        // Ambil data dengan pagination 10 per halaman
        $mapels = $query->orderBy('nama_mapel')->paginate(10);

        // Supaya keyword search tetap ada di URL saat pindah halaman
        $mapels->appends(['search' => $search]);

        return view('admin.data_mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('admin.data_mapel.tambah_mapel');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string',
            'kkm' => 'nullable|integer',
            'semester' => 'required|string',
        ]);

        Mapel::create($request->all());

        return redirect()->route('admin.data_mapel.index')->with('success', 'Data Mapel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('admin.data_mapel.edit_mapel', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);

        $request->validate([
            'nama_mapel' => 'required|string',
            'kkm' => 'nullable|integer',
            'semester' => 'required|string',
        ]);

        $mapel->update($request->all());

        return redirect()->route('admin.data_mapel.index')->with('success', 'Data Mapel berhasil diupdate.');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return redirect()->route('admin.data_mapel.index')->with('success', 'Data Mapel berhasil dihapus.');
    }
}
