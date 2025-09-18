@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Judul -->
    <h1 class="mb-4 fw-bold text-start text-secondary">Tambah User</h1>

    <!-- Error Validation -->
    @if($errors->any())
        <div class="alert alert-danger rounded-3 shadow-sm">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header text-white fw-semibold rounded-top" style="background-color: #465C88;">
            <i class="bi bi-person-plus"></i> Form Tambah User
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        <tr>
                            <th class="bg-light text-center fw-semibold" style="width: 220px;">Nama</th>
                            <td>
                                <input type="text" name="name" id="name"
                                       class="form-control rounded-pill bg-white shadow-sm"
                                       value="{{ old('name') }}" required>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Email</th>
                            <td>
                                <input type="email" name="email" id="email"
                                       class="form-control rounded-pill bg-white shadow-sm"
                                       value="{{ old('email') }}" required>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Role</th>
                            <td>
                                <select name="role" id="role"
                                        class="form-select rounded-pill bg-white shadow-sm" required>
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="kepsek" {{ old('role') == 'kepsek' ? 'selected' : '' }}>Kepsek</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Password</th>
                            <td class="position-relative">
                                <input type="password" name="password" id="password"
                                       class="form-control rounded-pill bg-white shadow-sm pe-5" required>
                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-3"
                                        onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light text-center fw-semibold">Konfirmasi Password</th>
                            <td class="position-relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control rounded-pill bg-white shadow-sm pe-5" required>
                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-3"
                                        onclick="togglePassword('password_confirmation', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Tombol -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success rounded-pill shadow-sm px-4 me-2">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.users.index') }}"
                       class="btn btn-secondary rounded-pill shadow-sm px-4">
                        <i class="bi bi-arrow-left-circle"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Inline script agar pasti dieksekusi (safe & sederhana) -->
<script>
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    if (!input) return;

    // toggle type
    if (input.type === 'password') {
        input.type = 'text';
    } else {
        input.type = 'password';
    }

    // ganti icon jika ada
    try {
        const icon = btn.querySelector('i');
        if (icon) {
            if (icon.classList.contains('bi-eye')) {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    } catch (e) {
        // ignore
    }

    // kembalikan fokus dan taruh caret di akhir (UX lebih baik)
    try {
        input.focus();
        const len = input.value.length;
        input.setSelectionRange(len, len);
    } catch (e) {
        // ignore on browsers that don't support setSelectionRange on password->text toggle
    }
}
</script>
@endsection
