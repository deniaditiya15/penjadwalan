@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-secondary">Data Kelas</h1>

    <div class="card border-0 shadow-sm rounded-3">
        <!-- Header Card: Tambah + Search -->
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <a href="{{ route('admin.data_kelas.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Kelas
            </a>

            <form action="{{ route('admin.data_kelas.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2 border-primary rounded-pill" 
                       placeholder="Cari berdasarkan nama kelas atau walikelas" 
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary rounded-pill">Cari</button>
            </form>
        </div>

        <!-- Body Card: Tabel Kelas -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>ID</th>
                            <th>Nama Kelas</th>
                            <th>NIP Walikelas</th>
                            <th>Nama Walikelas</th>
                            <th>Jumlah Siswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($kelas as $k)
                            <tr>
                                <td class="fw-semibold">{{ $k->id }}</td>
                                <td class="fw-semibold">{{ $k->kelas }}</td>
                                <td>{{ $k->nip }}</td>
                                <td>{{ $k->nama_walikelas }}</td>
                                <td>
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                        {{ $k->jumlah_siswa ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.data_kelas.edit', $k->id) }}" class="btn btn-sm btn-warning rounded-pill shadow-sm me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.data_kelas.destroy', $k->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill shadow-sm" onclick="return confirm('Yakin hapus data ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Data kelas tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Card: Pagination rapi -->
        @if($kelas->count())
            <div class="card-footer bg-white border-0 d-flex justify-content-center">
                <nav>
                    <ul class="pagination pagination-sm justify-content-center mb-0">
                        {{-- Previous --}}
                        @if ($kelas->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $kelas->previousPageUrl() }}">&laquo;</a></li>
                        @endif

                        {{-- Pages --}}
                        @foreach ($kelas->getUrlRange(1, $kelas->lastPage()) as $page => $url)
                            @if ($page == $kelas->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

                        {{-- Next --}}
                        @if ($kelas->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $kelas->nextPageUrl() }}">&raquo;</a></li>
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
@endsection
