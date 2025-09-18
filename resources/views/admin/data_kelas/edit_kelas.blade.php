@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h1 class="mb-4 fw-bold text-start text-secondary">Edit Data Kelas</h1>

    <!-- Alert Error -->
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header text-white fw-semibold rounded-top" style="background-color: #465C88;">
            <i class="bi bi-pencil-square"></i> Form Edit Kelas
        </div>
        <div class="card-body">
            <form action="{{ route('admin.data_kelas.update', $kelas->id) }}" method="POST">
                @csrf
                @method('PUT')

                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        <tr>
                            <th class="bg-light text-center fw-semibold" style="width: 220px;">Nama Kelas</th>
                            <td>
                                <input type="text" class="form-control rounded-pill bg-white" name="kelas"
                                    value="{{ old('kelas', $kelas->kelas) }}">
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">NIP Walikelas</th>
                            <td>
                                <input type="text" class="form-control rounded-pill bg-white" name="nip"
                                    value="{{ old('nip', $kelas->nip) }}">
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Nama Walikelas</th>
                            <td>
                                <input type="text" class="form-control rounded-pill bg-white" name="nama_walikelas"
                                    value="{{ old('nama_walikelas', $kelas->nama_walikelas) }}">
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Jumlah Siswa</th>
                            <td>
                                <input type="number" class="form-control rounded-pill bg-white" name="jumlah_siswa"
                                    value="{{ old('jumlah_siswa', $kelas->jumlah_siswa) }}">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tombol -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-warning rounded-pill shadow-sm px-4 me-2">
                        <i class="bi bi-pencil-square"></i> Update
                    </button>
                    <a href="{{ route('admin.data_kelas.index') }}" class="btn btn-secondary rounded-pill shadow-sm px-4">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
