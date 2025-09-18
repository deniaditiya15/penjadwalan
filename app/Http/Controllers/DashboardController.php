<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Total per kategori
        $jumlahGuru = Guru::count();
        $jumlahKelas = Guru::select('kelas')->distinct()->count(); // kalau data kelas ambil dari tabel guru
        $jumlahMapel = Mapel::count();

        // Data chart: jumlah per kategori
        $chartLabels = ['Guru', 'Kelas', 'Mapel'];
        $chartData   = [$jumlahGuru, $jumlahKelas, $jumlahMapel];

        // Tentukan view berdasarkan role
        if (Auth::user()->role === 'guru') {
            return view('guru.dashboard', compact(
                'jumlahGuru',
                'jumlahKelas',
                'jumlahMapel',
                'chartLabels',
                'chartData'
            ));
        }

        if (Auth::user()->role === 'kepsek') {
            return view('kepsek.dashboard', compact(
                'jumlahGuru',
                'jumlahKelas',
                'jumlahMapel',
                'chartLabels',
                'chartData'
            ));
        }

        // Default admin dashboard
        return view('admin.dashboard', compact(
            'jumlahGuru',
            'jumlahKelas',
            'jumlahMapel',
            'chartLabels',
            'chartData'
        ));
    }
}
