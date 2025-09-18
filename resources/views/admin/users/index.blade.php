@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-secondary">Manajemen User</h1>

    <!-- Tombol Tambah User -->
    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary rounded-pill shadow-sm px-4">
            <i class="bi bi-person-plus"></i> Tambah User
        </a>
    </div>

    <!-- Card Tabel -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr class="fw-semibold text-center">
                        <th style="width: 60px;">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width: 120px;">Role</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="btn btn-sm btn-warning rounded-pill shadow-sm px-3">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" 
                                          method="POST" class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger rounded-pill shadow-sm px-3">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Belum ada user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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

<style>
.table-hover tbody tr:hover {
    background-color: #f1f5ff;
    transition: all 0.2s ease-in-out;
}
</style>
@endsection
