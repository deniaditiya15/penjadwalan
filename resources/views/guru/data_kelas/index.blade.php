@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-secondary">Data Kelas</h1>

    <div class="card border-0 shadow-sm rounded-3">
        <!-- Header Card: Search -->
        <div class="card-header bg-white border-0 d-flex justify-content-end align-items-center">
            <form action="{{ route('guru.data_kelas') }}" method="GET" class="d-flex">
                <input type="text" name="search" 
                       class="form-control me-2 border-primary rounded-pill"
                       placeholder="Cari berdasarkan nama kelas atau wali kelas"
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary rounded-pill">Cari</button>
            </form>
        </div>

        <!-- Body Card: Tabel Data -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Nama Kelas</th>
                            <th>NIP Walikelas</th>
                            <th>Nama Walikelas</th>
                            <th>Jumlah Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kelas as $i => $k)
                            <tr>
                                <td class="fw-semibold">{{ $k->id }}</td>
                                <td class="fw-semibold">{{ $k->kelas }}</td>
                                <td>{{ $k->nip }}</td>
                                <td>{{ $k->nama_walikelas }}</td>
                                <td>{{ $k->jumlah_siswa }}</td> 
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Tidak ada data kelas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Card: Pagination -->
        @if($kelas->count())
            <div class="card-footer bg-white border-0 d-flex justify-content-center">
                <nav>
                    <ul class="pagination pagination-sm justify-content-center mb-0">
                        @if ($kelas->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $kelas->previousPageUrl() }}">&laquo;</a></li>
                        @endif

                        @foreach ($kelas->getUrlRange(1, $kelas->lastPage()) as $page => $url)
                            @if ($page == $kelas->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

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

<!-- Style Index Hover -->
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f5ff;
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection
