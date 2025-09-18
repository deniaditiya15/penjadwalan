@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-start">Data Jadwal</h1>

    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-white border-0">
            <div class="row g-2 align-items-center">
                <!-- Kolom kiri: tombol -->
                <div class="col-12 col-md-4 d-flex gap-2">
                    {{-- Tambah Jadwal hanya untuk Admin --}}
                    @if(Request::is('admin/*'))
                        <a href="{{ route('admin.kelola_jadwal.create') }}" class="btn btn-primary shadow-sm">
                            <i class="bi bi-plus-circle"></i> Tambah Jadwal
                        </a>
                    @endif

                    {{-- Cetak PDF sesuai role --}}
                    @if(Request::is('admin/*'))
                        <a href="{{ route('admin.kelola_jadwal.cetakPdf', request()->all()) }}" 
                           class="btn btn-danger shadow-sm" target="_blank">
                            <i class="bi bi-printer"></i> Cetak PDF
                        </a>
                    @elseif(Request::is('guru/*'))
                        <a href="{{ route('guru.kelola_jadwal.cetakPdf', request()->all()) }}" 
                           class="btn btn-danger shadow-sm" target="_blank">
                            <i class="bi bi-printer"></i> Cetak PDF
                        </a>
                    @elseif(Request::is('kepsek/*'))
                        <a href="{{ route('kepsek.kelola_jadwal.cetakPdf', request()->all()) }}" 
                           class="btn btn-danger shadow-sm" target="_blank">
                            <i class="bi bi-printer"></i> Cetak PDF
                        </a>
                    @endif
                </div>

                <!-- Kolom kanan: filter -->
                <div class="col-12 col-md-8">
                    <form action="{{ url()->current() }}" method="GET">
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
                                <a href="{{ url()->current() }}" class="btn btn-outline-secondary rounded-pill">
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
                            @if(Request::is('admin/*'))
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwals as $jadwal)
                            <tr>
                                <td class="fw-semibold">{{ $jadwal->kelas->kelas ?? '-' }}</td>
                                <td class="fw-semibold">{{ $jadwal->mapel->nama_mapel ?? '-' }}</td>
                                <td>{{ $jadwal->guru->nama ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-primary px-3 py-2 rounded-pill">{{ $jadwal->hari }}</span>
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
                                @if(Request::is('admin/*'))
                                    <td>
                                        <a href="{{ route('admin.kelola_jadwal.edit', $jadwal->id) }}" 
                                           class="btn btn-sm btn-warning rounded-pill shadow-sm me-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.kelola_jadwal.destroy', $jadwal->id) }}" 
                                              method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill shadow-sm" 
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Request::is('admin/*') ? 7 : 6 }}" class="text-center text-muted py-4">
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
            <div class="card-footer d-flex justify-content-center">
                <nav>
                    {{ $jadwals->appends(request()->all())->links() }}
                </nav>
            </div>
        @endif
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses!',
            text: "{{ session('success') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if(session('update'))
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Diperbarui!',
            text: "{{ session('update') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if(session('delete'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Dihapus!',
            text: "{{ session('delete') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif
@endsection
