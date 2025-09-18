@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Data Guru</h1>

    <div class="card shadow-sm">
        <!-- Header Card: Search -->
        <div class="card-header d-flex justify-content-end align-items-center">
            <form action="{{ route('kepsek.data_guru') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" 
                       placeholder="Cari berdasarkan nama" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Cari</button>
            </form>
        </div>

        <!-- Body Card: Tabel Guru -->
        <div class="card-body p-0">
            <table class="table table-striped table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No. Telp</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gurus as $guru)
                        <tr>
                            <td>{{ $guru->nip }}</td>
                            <td>{{ $guru->nama }}</td>
                            <td>{{ $guru->jenkel }}</td>
                            <td class="text-center">
                                {{ $guru->tgl_lahir instanceof \Carbon\Carbon 
                                    ? $guru->tgl_lahir->format('d-m-Y') 
                                    : date('d-m-Y', strtotime($guru->tgl_lahir)) }}
                            </td>
                            <td>{{ $guru->alamat }}</td>
                            <td>{{ $guru->email }}</td>
                            <td>{{ $guru->no_telp }}</td>
                            <td class="text-center">
                                <span class="badge {{ $guru->status == 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $guru->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data guru tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Card: Pagination -->
        @if($gurus->count())
            <div class="card-footer d-flex justify-content-center">
                {{ $gurus->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
