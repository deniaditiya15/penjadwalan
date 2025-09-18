@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h1 class="mb-4 fw-bold text-start text-secondary">Tambah Guru</h1>

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
            <i class="bi bi-person-plus-fill"></i> Form Tambah Guru
        </div>
        <div class="card-body">
            <form action="{{ route('admin.data_guru.store') }}" method="POST">
                @csrf
                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        <tr>
                            <th class="bg-light text-center fw-semibold" style="width: 220px;">NIP</th>
                            <td><input type="text" class="form-control rounded-pill bg-white" name="nip" value="{{ old('nip') }}"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Nama</th>
                            <td><input type="text" class="form-control rounded-pill bg-white" name="nama" value="{{ old('nama') }}"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Jenis Kelamin</th>
                            <td>
                                <select name="jenkel" class="form-select rounded-pill bg-white">
                                    <option value="Laki-laki" {{ old('jenkel')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenkel')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Tanggal Lahir</th>
                            <td><input type="date" class="form-control rounded-pill bg-white" name="tgl_lahir" value="{{ old('tgl_lahir') }}"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Alamat</th>
                            <td><input type="text" class="form-control rounded-pill bg-white" name="alamat" value="{{ old('alamat') }}"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Email</th>
                            <td><input type="email" class="form-control rounded-pill bg-white" name="email" value="{{ old('email') }}"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">No. Telp</th>
                            <td><input type="text" class="form-control rounded-pill bg-white" name="no_telp" value="{{ old('no_telp') }}"></td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Status</th>
                            <td>
                                <select name="status" class="form-select rounded-pill bg-white" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Aktif" {{ old('status')=='Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif" {{ old('status')=='Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tombol -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success rounded-pill shadow-sm px-4 me-2">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.data_guru.index') }}" class="btn btn-secondary rounded-pill shadow-sm px-4">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
