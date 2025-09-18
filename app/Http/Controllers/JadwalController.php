<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Guru;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class JadwalController extends Controller
{
    // CETAK PDF (semua / dengan filter)
    public function cetakPdf(Request $request)
    {
        $query = Jadwal::with(['kelas','mapel','guru']);

        // filter
        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }
        if ($request->guru_id) {
            $query->where('guru_id', $request->guru_id);
        }
        if ($request->hari) {
            $query->where('hari', $request->hari);
        }

        $jadwals = $query->orderBy('hari')->orderBy('waktu_mulai')->get();

        $pdf = Pdf::loadView('admin.kelola_jadwal.cetakpdf', compact('jadwals'));
        return $pdf->stream('jadwal.pdf');
    }

    // INDEX (dinamis sesuai role)
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $gurus = Guru::all();

        $query = Jadwal::with(['kelas','mapel','guru']);

        // search global
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('kelas', function ($q2) use ($search) {
                    $q2->where('kelas', 'like', "%{$search}%");
                })->orWhereHas('mapel', function ($q2) use ($search) {
                    $q2->where('nama_mapel', 'like', "%{$search}%");
                })->orWhereHas('guru', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%");
                });
            });
        }

        // filter tambahan
        if ($request->kelas_id) {
            $query->where('kelas_id', $request->kelas_id);
        }
        if ($request->guru_id) {
            $query->where('guru_id', $request->guru_id);
        }
        if ($request->hari) {
            $query->where('hari', $request->hari);
        }

        $jadwals = $query->orderBy('hari')->orderBy('waktu_mulai')->paginate(10);

        // Tentukan view berdasarkan prefix URL (role)
        if ($request->is('admin/*')) {
            return view('admin.kelola_jadwal.index', compact('jadwals','kelas','gurus'));
        } elseif ($request->is('guru/*')) {
            return view('guru.kelola_jadwal.index', compact('jadwals','kelas','gurus'));
        } elseif ($request->is('kepsek/*')) {
            return view('kepsek.kelola_jadwal.index', compact('jadwals','kelas','gurus'));
        }
    }

    // ================== HANYA ADMIN YANG BISA CRUD ==================
    public function create()
    {
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $guru  = Guru::all();

        return view('admin.kelola_jadwal.tambah_jadwal', compact('kelas','mapel','guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id'       => 'required',
            'mapel_id'       => 'required',
            'guru_id'        => 'required',
            'hari'           => 'required',
            'waktu_mulai'    => 'required|date_format:H:i',
            'waktu_selesai'  => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        // Cek bentrok jadwal
        $bentrok = Jadwal::where('hari', $request->hari)
            ->where('guru_id', $request->guru_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                      ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai]);
            })
            ->exists();

        if ($bentrok) {
            return redirect()->back()->with('error', 'Jadwal bentrok dengan guru lain pada jam yang sama.');
        }

        Jadwal::create($request->all());

        return redirect()->route('admin.kelola_jadwal.index')
                         ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Jadwal $kelola_jadwal)
    {
        $kelas = Kelas::all();
        $mapel = Mapel::all();
        $guru  = Guru::all();

        return view('admin.kelola_jadwal.edit_jadwal', compact('kelola_jadwal','kelas','mapel','guru'));
    }

    public function update(Request $request, Jadwal $kelola_jadwal)
    {
        $request->validate([
            'kelas_id'       => 'required',
            'mapel_id'       => 'required',
            'guru_id'        => 'required',
            'hari'           => 'required',
            'waktu_mulai'    => 'required|date_format:H:i',
            'waktu_selesai'  => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        // Cek bentrok jadwal (kecuali dirinya sendiri)
        $bentrok = Jadwal::where('hari', $request->hari)
            ->where('guru_id', $request->guru_id)
            ->where('id','!=',$kelola_jadwal->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                      ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai]);
            })
            ->exists();

        if ($bentrok) {
            return redirect()->back()->with('error', 'Jadwal bentrok dengan guru lain pada jam yang sama.');
        }

        $kelola_jadwal->update($request->all());

        return redirect()->route('admin.kelola_jadwal.index')
                         ->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $kelola_jadwal)
    {
        $kelola_jadwal->delete();

        return redirect()->route('admin.kelola_jadwal.index')
                         ->with('success', 'Jadwal berhasil dihapus.');
    }
}
