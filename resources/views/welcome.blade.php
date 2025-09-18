<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Penjadwalan Mapel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #465C88;
            --primary-dark: #3a4c70;
            --accent-color: #FFD54F;
            --light-bg: #f8f9fa;
            --text-dark: #2D3748;
            --text-light: #718096;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            padding: 12px 0;
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            padding: 8px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar .nav-link {
            font-weight: 500;
            color: #fff;
            transition: all 0.3s;
            position: relative;
        }
        
        .navbar .nav-link:not(.btn):hover {
            color: var(--accent-color) !important;
        }
        
        .navbar .nav-link:not(.btn)::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--accent-color);
            transition: width 0.3s;
        }
        
        .navbar .nav-link:not(.btn):hover::after {
            width: 100%;
        }

        /* Hero Section */
#home {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('{{ asset('image/bgj.jpg') }}') no-repeat center center/cover;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    margin: 0;
    padding: 0;
}

#home .content {
    max-width: 800px;
    margin: 0 auto;
    animation: fadeIn 1.5s ease;
}

#home h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

#home p {
    font-size: 1.35rem;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
}

#home .btn {
    padding: 12px 32px;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    border: none;
}

#home .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}


        /* About Section */
        #about {
            padding: 100px 0;
            background-color: var(--light-bg);
            position: relative;
            margin:0 ;
        }
        
        #about::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 0;
            width: 100%;
            height: 100px;
            background: var(--light-bg); /* lurus, bukan diagonal */
        }
        
        #about h2 {
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }
        
        #about h2::after {
            content: '';
            position: absolute;
            width: 60px;
            height: 4px;
            background: var(--primary-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }
        
        #about p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-light);
        }
        
       
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            padding: 30px 0;
            color: white;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s;
        }
        
        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            #home h1 {
                font-size: 2.5rem;
            }
            
            #home p {
                font-size: 1.1rem;
            }
            
            .navbar .nav-link.btn {
                margin-top: 10px;
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <img src="{{ asset('image/logott.png') }}" alt="Logo" style="width:40px; height:auto; margin-right:10px;">
                <span>Sistem Informasi Penjadwalan Matapelajaran</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang</a></li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning text-dark px-3 ms-lg-3 fw-semibold shadow-sm rounded-pill" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    </li>
                    <!-- @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light px-3 ms-lg-2 fw-semibold shadow-sm rounded-pill" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Register
                        </a>
                    </li> -->
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home">
        <div class="container">
            <div class="content">
                <h1 class="display-4 fw-bold">Selamat Datang</h1>
                <p class="lead">Aplikasi Penjadwalan Mata Pelajaran<br>Untuk Guru, Kepala sekolah, dan Admin Sekolah</p>
                <a href="{{ route('login') }}" class="btn btn-lg fw-semibold mt-3 rounded-pill shadow-sm">
                    <i class="bi bi-calendar-event me-2"></i> Masuk ke Sistem
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5 text-center bg-light">
        <div class="container">
            <h2 class="fw-bold mb-4">Tentang Aplikasi</h2>
            <p class="lead mx-auto animate-on-scroll" style="max-width: 800px;">
                Aplikasi Penjadwalan Mapel adalah platform digital untuk memudahkan sekolah
                dalam menyusun, mengatur, dan memantau jadwal pelajaran. 
                Sistem ini mendukung multi-role (Admin, Guru, Kepsek) sehingga proses distribusi mapel 
                lebih cepat, akurat, dan efisien.
            </p>
        </div>
    </section>

   

    <!-- Footer -->
    <footer class="text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Aplikasi Penjadwalan Mapel - Universitas Nurul Huda</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            
            elements.forEach(element => {
                const position = element.getBoundingClientRect();
                
                // If element is in viewport
                if(position.top < window.innerHeight && position.bottom >= 0) {
                    element.classList.add('animated');
                }
            });
        }
        
        // Run on load and scroll
        window.addEventListener('load', animateOnScroll);
        window.addEventListener('scroll', animateOnScroll);
    </script>
</body>
</html>