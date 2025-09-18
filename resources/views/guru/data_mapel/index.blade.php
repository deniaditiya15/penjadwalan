@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-secondary">Data Mapel</h1>

    <div class="card border-0 shadow-sm rounded-3">
        <!-- Header Card: Search -->
        <div class="card-header bg-white border-0 d-flex justify-content-end align-items-center">
            <form action="{{ route('guru.data_mapel') }}" method="GET" class="d-flex">
                <input type="text" name="search" 
                       class="form-control me-2 border-primary rounded-pill"
                       placeholder="Cari berdasarkan nama mapel"
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
                            <th>Kode Mapel</th>
                            <th>Nama Mapel</th>
                            <th>Keterangan</th>
                            <th>Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mapels as $mapel)
                            <tr class="bg-white">
                                <td class="fw-semibold">{{ $mapel->kode_mapel }}</td>
                                <td class="fw-semibold">{{ $mapel->nama_mapel }}</td>
                                <td>{{ $mapel->keterangan }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $mapel->semester }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Tidak ada data mapel
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Card: Pagination -->
        @if($mapels->count())
            <div class="card-footer bg-white border-0 d-flex justify-content-center">
                <nav>
                    <ul class="pagination pagination-sm justify-content-center mb-0">
                        @if ($mapels->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $mapels->previousPageUrl() }}">&laquo;</a></li>
                        @endif

                        @foreach ($mapels->getUrlRange(1, $mapels->lastPage()) as $page => $url)
                            @if ($page == $mapels->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach

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

<!-- Style Index Hover -->
<style>
    .table-hover tbody tr:hover {
        background-color: #f1f5ff;
        transition: all 0.2s ease-in-out;
    }
</style>
@endsection
