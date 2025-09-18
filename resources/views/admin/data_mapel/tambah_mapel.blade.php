@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h1 class="mb-4 fw-bold text-start text-secondary">Tambah Data Mapel</h1>

    <!-- Card Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header text-white fw-semibold rounded-top" style="background-color: #465C88;">
            <i class="bi bi-journal-plus"></i> Form Tambah Mapel
        </div>
        <div class="card-body">
            <form action="{{ route('admin.data_mapel.store') }}" method="POST">
                @csrf
                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        <tr>
                            <th class="bg-light text-center fw-semibold" style="width: 220px;">Kode Mapel</th>
                            <td>
                                <input type="text" class="form-control rounded-pill bg-white" id="kode_mapel" name="kode_mapel" value="{{ old('kode_mapel') }}" required>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Nama Mapel</th>
                            <td>
                                <input type="text" class="form-control rounded-pill bg-white" id="nama_mapel" name="nama_mapel" value="{{ old('nama_mapel') }}" required>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Keterangan</th>
                            <td>
                                <input type="text" class="form-control rounded-pill bg-white" id="keterangan" name="keterangan" value="{{ old('keterangan') }}">
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Semester</th>
                            <td>
                                <select class="form-select rounded-pill bg-white" id="semester" name="semester" required>
                                    <option value="">-- Pilih Semester --</option>
                                    <option value="Ganjil" {{ old('semester')=='Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                    <option value="Genap" {{ old('semester')=='Genap' ? 'selected' : '' }}>Genap</option>
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
                    <a href="{{ route('admin.data_mapel.index') }}" class="btn btn-secondary rounded-pill shadow-sm px-4">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
