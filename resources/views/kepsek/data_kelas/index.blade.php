@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Data Kelas</h1>

    <div class="card shadow-sm">
        <!-- Header Card: Search -->
        <div class="card-header d-flex justify-content-end align-items-center">
            <form action="{{ route('kepsek.data_kelas') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2"
                       placeholder="Cari berdasarkan nama kelas atau wali kelas"
                       value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Cari</button>
            </form>
        </div>

        <!-- Body Card: Tabel Data -->
        <div class="card-body">
            <table class="table table-striped table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>NIP Walikelas</th>
                        <th>Nama Walikelas</th>
                        <th>Jumlah Siswa</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelas as $k)
                        <tr>
                            <td class="text-center">{{ $k->id }}</td>
                            <td>{{ $k->kelas }}</td>
                            <td>{{ $k->nip }}</td>
                            <td>{{ $k->nama_walikelas }}</td>
                            <td class="text-center">{{ $k->jumlah_siswa }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data kelas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Card: Pagination Rapi -->
        @if($kelas->count())
            <div class="card-footer d-flex justify-content-center">
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
@endsection
