<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{

/**
     * Panel kepsek: daftar kelas read-only (tanpa CRUD).
     */
    public function indexKepsek(Request $request)
    {
        $search = $request->input('search');

        $kelas = Kelas::query()
            ->when($search, function ($query, $search) {
                $query->where('kelas', 'like', "%{$search}%")
                      ->orWhere('nama_walikelas', 'like', "%{$search}%");
            })
            ->orderBy('kelas', 'asc')
            ->paginate(10);

        $kelas->appends(['search' => $search]);

        return view('kepsek.data_kelas.index', compact('kelas'));
    }

    /**
     * Panel Guru: daftar kelas read-only (tanpa CRUD).
     */
    public function indexKelas(Request $request)
    {
        $search = $request->input('search');

        $kelas = Kelas::query()
            ->when($search, function ($query, $search) {
                $query->where('kelas', 'like', "%{$search}%")
                      ->orWhere('nama_walikelas', 'like', "%{$search}%");
            })
            ->orderBy('kelas', 'asc')
            ->paginate(10);

        $kelas->appends(['search' => $search]);

        return view('guru.data_kelas.index', compact('kelas'));
    }

    /**
     * Panel Admin: daftar kelas dengan pagination dan search (CRUD lengkap).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Kelas::query();

        if ($search) {
            $query->where('kelas', 'like', "%{$search}%")
                  ->orWhere('nama_walikelas', 'like', "%{$search}%");
        }

        $kelas = $query->orderBy('kelas')->paginate(10);
        $kelas->appends(['search' => $search]);

        return view('admin.data_kelas.index', compact('kelas'));
    }

    /**
     * Form tambah kelas (hanya admin).
     */
    public function create()
    {
        return view('admin.data_kelas.tambah_kelas');
    }

    /**
     * Simpan data kelas baru (hanya admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string',
            'nip' => 'required|string',
            'nama_walikelas' => 'required|string',
            'jumlah_siswa' => 'nullable|integer',
        ]);

        Kelas::create($request->all());

        return redirect()->route('admin.data_kelas.index')->with('success', 'Data Kelas berhasil ditambahkan.');
    }

    /**
     * Form edit kelas (hanya admin).
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.data_kelas.edit_kelas', compact('kelas'));
    }

    /**
     * Update data kelas (hanya admin).
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $request->validate([
            'kelas' => 'required|string',
            'nip' => 'required|string',
            'nama_walikelas' => 'required|string',
            'jumlah_siswa' => 'nullable|integer',
        ]);

        $kelas->update($request->all());

        return redirect()->route('admin.data_kelas.index')->with('success', 'Data Kelas berhasil diupdate.');
    }

    /**
     * Hapus data kelas (hanya admin).
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.data_kelas.index')->with('success', 'Data Kelas berhasil dihapus.');
    }
}
