@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-secondary">Data Jadwal</h1>

    <div class="card border-0 shadow-sm rounded-3">
        <!-- Header -->
        <div class="card-header bg-white border-0">
            <div class="row g-2 align-items-center">
                <!-- Kolom kiri: tombol Cetak PDF -->
                <div class="col-12 col-md-4 d-flex gap-2">
                    <a href="{{ route('kepsek.kelola_jadwal.cetakPdf', request()->all()) }}" 
                       class="btn btn-danger shadow-sm" target="_blank">
                        <i class="bi bi-printer"></i> Cetak PDF
                    </a>
                </div>

                <!-- Kolom kanan: filter -->
                <div class="col-12 col-md-8">
                    <form action="{{ route('kepsek.kelola_jadwal.index') }}" method="GET">
                        <div class="row g-2">
                            <div class="col-md">
                                <select name="kelas_id" class="form-select rounded-pill border-primary">
                                    <option value="">Semua Kelas</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->kelas }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md">
                                <select name="guru_id" class="form-select rounded-pill border-primary">
                                    <option value="">Semua Guru</option>
                                    @foreach($gurus as $g)
                                        <option value="{{ $g->id }}" {{ request('guru_id') == $g->id ? 'selected' : '' }}>
                                            {{ $g->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md">
                                <select name="hari" class="form-select rounded-pill border-primary">
                                    <option value="">Semua Hari</option>
                                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                                        <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>
                                            {{ $hari }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-auto d-flex gap-2">
                                <button type="submit" class="btn btn-outline-primary rounded-pill">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                                <a href="{{ route('kepsek.kelola_jadwal.index') }}" class="btn btn-outline-secondary rounded-pill">
                                    <i class="bi bi-arrow-clockwise"></i> Refresh
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Kelas</th>
                            <th>Mapel</th>
                            <th>Guru</th>
                            <th>Hari</th>
                            <th>Waktu Mulai</th>
                            <th>Waktu Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $jadwal)
                            <tr>
                                <td class="fw-semibold">{{ $jadwal->kelas->kelas ?? '-' }}</td>
                                <td class="fw-semibold">{{ $jadwal->mapel->nama_mapel ?? '-' }}</td>
                                <td>{{ $jadwal->guru->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                        {{ $jadwal->hari }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-success px-3 py-2 rounded-pill">
                                        {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">
                                        {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Data jadwal tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($jadwals->count())
            <div class="card-footer bg-white border-0 d-flex justify-content-center">
                <nav>
                    {{ $jadwals->appends(request()->all())->links() }}
                </nav>
            </div>
        @endif
    </div>
</div>

<!-- Hover effect -->
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f5ff;
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection
