@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h1 class="mb-4 fw-bold text-start text-secondary">Tambah Jadwal</h1>

    <!-- Card Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header text-white fw-semibold rounded-top" style="background-color: #465C88;">
            <i class="bi bi-calendar-plus"></i> Form Tambah Jadwal
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kelola_jadwal.store') }}" method="POST">
                @csrf
                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        <tr>
                            <th class="bg-light text-center fw-semibold" style="width: 220px;">Kelas</th>
                            <td>
                                <select name="kelas_id" id="kelas_id" class="form-select rounded-pill bg-white" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->kelas }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Mata Pelajaran</th>
                            <td>
                                <select name="mapel_id" id="mapel_id" class="form-select rounded-pill bg-white" required>
                                    <option value="">-- Pilih Mapel --</option>
                                    @foreach($mapel as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Guru</th>
                            <td>
                                <select name="guru_id" id="guru_id" class="form-select rounded-pill bg-white" required>
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach($guru as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Hari</th>
                            <td>
                                <select name="hari" id="hari" class="form-select rounded-pill bg-white" required>
                                    <option value="">-- Pilih Hari --</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Waktu Mulai</th>
                            <td>
                                <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control rounded-pill bg-white" required>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Waktu Selesai</th>
                            <td>
                                <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control rounded-pill bg-white" required>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tombol -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success rounded-pill shadow-sm px-4 me-2">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.kelola_jadwal.index') }}" class="btn btn-secondary rounded-pill shadow-sm px-4">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Jadwal Bentrok!',
        text: "{{ session('error') }}",
        confirmButtonText: 'OK'
    });
</script>
@endif

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK'
    });
</script>
@endif
@endsection
