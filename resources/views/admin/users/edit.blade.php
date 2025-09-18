@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h1 class="mb-4 fw-bold text-start text-secondary">Edit User</h1>

    <!-- Card Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header text-white fw-semibold rounded-top" style="background-color: #465C88;">
            <i class="bi bi-person-lines-fill"></i> Form Edit User
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        <tr>
                            <th class="bg-light text-center fw-semibold" style="width: 220px;">Nama</th>
                            <td>
                                <input type="text" name="name" id="name" 
                                       class="form-control rounded-pill bg-white" 
                                       value="{{ old('name', $user->name) }}" required>
                            </td>
                        </tr>

                        <tr>
                            <th class="bg-light text-center fw-semibold">Email</th>
                            <td>
                                <input type="email" name="email" id="email" 
                                       class="form-control rounded-pill bg-white" 
                                       value="{{ old('email', $user->email) }}" required>
                            </td>
                        </tr>

                        <tr>
                            <th class="bg-light text-center fw-semibold">Role</th>
                            <td>
                                <select name="role" id="role" class="form-select rounded-pill bg-white" required>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="kepsek" {{ old('role', $user->role) == 'kepsek' ? 'selected' : '' }}>Kepsek</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <th class="bg-light text-center fw-semibold">Password</th>
                            <td>
                                <input type="password" name="password" id="password" 
                                       class="form-control rounded-pill bg-white" 
                                       placeholder="Biarkan kosong jika tidak diubah">
                            </td>
                        </tr>

                        <tr>
                            <th class="bg-light text-center fw-semibold">Konfirmasi Password</th>
                            <td>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                       class="form-control rounded-pill bg-white">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tombol -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-warning rounded-pill shadow-sm px-4 me-2">
                        <i class="bi bi-pencil-square"></i> Update
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary rounded-pill shadow-sm px-4">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Error Validation --}}
@if ($errors->any())
<div class="container mt-3">
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan!',
        text: "{{ session('error') }}",
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('success'))
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
