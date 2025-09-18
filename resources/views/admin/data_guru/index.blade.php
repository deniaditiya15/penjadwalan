@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-secondary">Data Guru</h1>

    <div class="card border-0 shadow-sm rounded-3">
        <!-- Header Card: Tambah + Search -->
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.data_guru.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Guru
            </a>

            <form action="{{ route('admin.data_guru.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2 border-primary rounded-pill" 
                       placeholder="Cari berdasarkan nama" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary rounded-pill">Cari</button>
            </form>
        </div>

        <!-- Body Card: Tabel Guru -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>No. Telp</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($gurus as $guru)
                            <tr>
                                <td class="fw-semibold">{{ $guru->nip }}</td>
                                <td class="fw-semibold">{{ $guru->nama }}</td>
                                <td>{{ $guru->jenkel }}</td>
                                <td>
                                    {{ $guru->tgl_lahir instanceof \Carbon\Carbon 
                                        ? $guru->tgl_lahir->format('d-m-Y') 
                                        : date('d-m-Y', strtotime($guru->tgl_lahir)) }}
                                </td>
                                <td>{{ $guru->alamat }}</td>
                                <td>{{ $guru->email }}</td>
                                <td>{{ $guru->no_telp }}</td>
                                <td>
                                    <span class="badge {{ $guru->status == 'Aktif' ? 'bg-success' : 'bg-secondary' }} px-3 py-2 rounded-pill">
                                        {{ $guru->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.data_guru.edit', $guru->id) }}" class="btn btn-sm btn-warning rounded-pill shadow-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.data_guru.destroy', $guru->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill shadow-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">Data guru tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Card: Pagination -->
        @if($gurus->count())
            <div class="card-footer bg-white border-0 d-flex justify-content-center">
                <nav>
                    <ul class="pagination pagination-sm justify-content-center mb-0">
                        {{-- Previous --}}
                        @if ($gurus->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $gurus->previousPageUrl() }}">&laquo;</a></li>
                        @endif

                        {{-- Pages --}}
                        @foreach ($gurus->getUrlRange(1, $gurus->lastPage()) as $page => $url)
                            @if ($page == $gurus->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if ($gurus->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $gurus->nextPageUrl() }}">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>

<!-- SweetAlert2 -->
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<style>
    .table-hover tbody tr:hover {
        background-color: #f1f5ff;
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection
