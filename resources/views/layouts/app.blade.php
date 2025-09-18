<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Penjadwalan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f6f8fb; }
        .sidebar {
            width: 220px;
            min-height: 100vh;
            background-color: #465C88;
            color: #fff;
            padding: 1.5rem 1rem;
            transition: all 0.3s ease;
        }
        .sidebar h4 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 600;
            font-size: 1.3rem;
            color: #fff;
        }
        .sidebar .nav-link {
            color: #fff;
            margin-bottom: 0.5rem;
            border-radius: 0.4rem;
            padding: 0.6rem 1rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link i { margin-right: 0.8rem; font-size: 1.1rem; }
        .sidebar .nav-link:hover {
            background-color: #E9E3DF;
            color: #333;
            transform: translateX(5px);
        }
        .sidebar .nav-link.active {
            background-color: #E9E3DF;
            color: #333;
            font-weight: 600;
        }
        .main-content { flex-grow: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .navbar-custom { background-color: #465C88; color: #fff; padding: 0.7rem 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        .navbar-custom .navbar-brand, .navbar-custom .dropdown-toggle { color: #fff; }
        .navbar-custom .dropdown-menu { right: 0; left: auto; }
        main { padding: 2rem; background-color: #f6f8fb; }
    </style>
</head>
<body>
<div class="d-flex">
       @auth
    <nav class="sidebar">
        <div class="sidebar-logo text-center mb-3">
        <img src="{{ asset('image/logott.png') }}" alt="Logo SMPN 1 Belitang III" style="width:100px; height:auto;">
    </div>

    <h4 class="text-center">SMP Negeri 1 <br>Belitang III</h4>
    <ul class="nav flex-column">
                       
                @if(auth()->user()->role === 'admin')
                  <li class="nav-item mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.data_guru.index') }}" class="nav-link {{ request()->is('admin/data_guru*') ? 'active' : '' }}">
                            <i class="bi bi-person-badge"></i> Data Guru
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.data_kelas.index')}}" class="nav-link {{ request()->is('admin/data_kelas*') ? 'active' : ''}}"><i class="bi bi-building"></i> Data Kelas</a></li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.data_mapel.index') }}" class="nav-link {{ request()->is('admin/data_mapel*') ? 'active' : '' }}"><i class="bi bi-journal-bookmark"></i> Data Mapel</a></li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.kelola_jadwal.index') }}" class="nav-link {{ request()->is('admin/kelola_jadwal*') ? 'active' : '' }}"><i class="bi bi-calendar-event"></i> Penjadwalan</a></li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.users.index') }}" class= "nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                            <i class="bi bi-person-plus"></i> Tambah User
                        </a>
                    </li>

                @elseif(auth()->user()->role === 'guru')
                    <li class="nav-item mb-2">
                        <a href="{{ route('guru.dashboard') }}" class="nav-link {{ request()->is('guru/dashboard*') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                   <li class="nav-item mb-2">
                     <a href="{{ route('guru.data_guru') }}" class="nav-link {{ request()->is('guru/data_guru*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i> Data Guru
                     </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <a href="{{ route('guru.data_kelas') }}" class="nav-link {{ request()->is('guru/data_kelas*') ? 'active' : '' }}">
                            <i class="bi bi-building"></i> Data Kelas</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('guru.data_mapel') }}"  class="nav-link {{ request()->is('guru/data_mapel*') ? 'active' : '' }}"><i class="bi bi-journal-bookmark"></i> Data Mapel</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('guru.kelola_jadwal.index') }}"  class="nav-link {{ request()->is('guru/kelola_jadwal*') ? 'active' : '' }}"><i class="bi bi-calendar-event"></i> Lihat Jadwal</a></li>
                @elseif(auth()->user()->role === 'kepsek')
                    <li class="nav-item mb-2">
                        <a href="{{ route('kepsek.dashboard') }}" class="nav-link {{ request()->is('kepsek/dashboard*') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    
                     <li class="nav-item mb-2">
                     <a href="{{ route('kepsek.data_guru') }}" class="nav-link {{ request()->is('kepsek/data_guru*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge"></i> Data Guru
                     </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('kepsek.data_kelas') }}" class="nav-link {{ request()->is('kepsek/data_kelas*') ? 'active' : '' }}">
                            <i class="bi bi-building"></i> Data Kelas</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('kepsek.data_mapel') }}"  class="nav-link {{ request()->is('kepsek/data_mapel*') ? 'active' : '' }}"><i class="bi bi-journal-bookmark"></i> Data Mapel</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('kepsek.kelola_jadwal.index') }}" class="nav-link {{ request()->is('kepsek/kelola_jadwal*') ? 'active' : '' }}"><i class="bi bi-calendar-event"></i> Lihat Jadwal</a></li>
                    

                @endif
            @endauth
        </ul>
    </nav>
    <div class="main-content">
        <nav class="navbar navbar-expand navbar-custom">
            <div class="container-fluid">
                <span class="navbar-brand">Sistem Informasi Penjadwalan Matapelajaran</span>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ auth()->user()->name }} ({{ auth()->user()->role }})
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                            </div>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
