@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-secondary">Data Mapel</h1>

    <div class="card border-0 shadow-sm rounded-3">
        <!-- Header Card -->
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.data_mapel.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Mapel
            </a>

            <form action="{{ route('admin.data_mapel.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2 border-primary rounded-pill" 
                       placeholder="Cari berdasarkan nama" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary rounded-pill">Cari</button>
            </form>
        </div>

        <!-- Body Card -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Kode Mapel</th>
                            <th>Nama Mapel</th>
                            <th>Keterangan</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mapels as $mapel)
                            <tr>
                                <td class="fw-semibold">{{ $mapel->kode_mapel }}</td>
                                <td class="fw-semibold">{{ $mapel->nama_mapel }}</td>
                                <td>{{ $mapel->keterangan }}</td>
                                <td>
                                    <span class="badge bg-primary px-3 py-2 rounded-pill">
                                        {{ $mapel->semester }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.data_mapel.edit', $mapel->id) }}" class="btn btn-sm btn-warning rounded-pill shadow-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.data_mapel.destroy', $mapel->id) }}" method="POST" style="display:inline;">
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
                                <td colspan="5" class="text-center text-muted py-4">Data mapel tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Card -->
        @if($mapels->count())
            <div class="card-footer bg-white border-0 d-flex justify-content-center">
                <nav>
                    <ul class="pagination pagination-sm justify-content-center mb-0">
                        {{-- Previous --}}
                        @if ($mapels->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $mapels->previousPageUrl() }}">&laquo;</a></li>
                        @endif

                        {{-- Pages --}}
                        @foreach ($mapels->getUrlRange(1, $mapels->lastPage()) as $page => $url)
                            @if ($page == $mapels->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if ($mapels->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $mapels->nextPageUrl() }}">&raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>
</div>

<!-- SweetAlert -->
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
