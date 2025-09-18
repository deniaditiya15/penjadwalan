<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    /**
     * Panel Admin: daftar guru dengan CRUD.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $gurus = Guru::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->orderBy('nama', 'asc')
            ->paginate(10);

        $gurus->appends(['search' => $search]);

        return view('admin.data_guru.index', compact('gurus'));
    }

    /**
     * Panel Guru: daftar guru read-only.
     */
    public function indexGuru(Request $request)
    {
        $search = $request->input('search');

        $gurus = Guru::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->orderBy('nama', 'asc')
            ->paginate(10);

        $gurus->appends(['search' => $search]);

        return view('guru.data_guru.index', compact('gurus')); // blade khusus guru
    }


     /**
     * Panel kepsek: daftar guru read-only.
     */
    public function indexkepsek(Request $request)
    {
        $search = $request->input('search');

        $gurus = Guru::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->orderBy('nama', 'asc')
            ->paginate(10);

        $gurus->appends(['search' => $search]);

        return view('kepsek.data_guru.index', compact('gurus')); // blade khusus guru
    }

    /**
     * Tampilkan form tambah guru (admin only).
     */
    public function create()
    {
        return view('admin.data_guru.tambah_guru');
    }

    /**
     * Simpan data guru baru (admin only).
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:gurus,nip',
            'nama' => 'required',
            'jenkel' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'email' => 'required|email|unique:gurus,email',
            'no_telp' => 'required',
            'status' => 'required',
        ]);

        Guru::create($request->all());

        return redirect()->route('admin.data_guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit guru (admin only).
     */
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.data_guru.edit_guru', compact('guru'));
    }

    /**
     * Update data guru (admin only).
     */
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nip' => 'required|unique:gurus,nip,'.$guru->id,
            'nama' => 'required',
            'jenkel' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'email' => 'required|email|unique:gurus,email,'.$guru->id,
            'no_telp' => 'required',
            'status' => 'required',
        ]);

        $guru->update($request->all());

        return redirect()->route('admin.data_guru.index')
                         ->with('success', 'Guru berhasil diupdate.');
    }

    /**
     * Hapus data guru (admin only).
     */
    public function destroy(Guru $data_guru)
    {
        $data_guru->delete();
        return redirect()->route('admin.data_guru.index')->with('success', 'Guru berhasil dihapus.');
    }
}
