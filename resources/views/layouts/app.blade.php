<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Pengumpulan Tugas Kuliah 17 Pertemuan')</title>
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: #eef2ff;
            --primary-glow: rgba(79, 70, 229, 0.15);
            --success: #10b981;
            --success-light: #ecfdf5;
            --warning: #f59e0b;
            --warning-light: #fffbeb;
            --danger: #ef4444;
            --danger-light: #fef2f2;
            --dark: #0f172a;
            --slate-800: #1e293b;
            --slate-700: #334155;
            --slate-600: #475569;
            --slate-500: #64748b;
            --slate-400: #94a3b8;
            --slate-200: #e2e8f0;
            --slate-100: #f1f5f9;
            --slate-50: #f8fafc;
            --radius-sm: 8px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-xl: 28px;
            --shadow-sm: 0 2px 8px rgba(15, 23, 42, 0.04);
            --shadow-md: 0 8px 24px rgba(15, 23, 42, 0.06);
            --shadow-lg: 0 16px 40px rgba(15, 23, 42, 0.08);
            --shadow-glow: 0 12px 32px rgba(79, 70, 229, 0.25);
            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f8fafc;
            color: var(--slate-800);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--slate-200);
            position: sticky;
            top: 0;
            z-index: 50;
            padding: 1rem 1.5rem;
            transition: var(--transition);
        }

        .navbar-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--dark);
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: var(--radius-md);
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.25rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35);
        }

        .brand-text h1 {
            font-size: 1.15rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--dark);
        }

        .brand-text p {
            font-size: 0.75rem;
            color: var(--slate-500);
            font-weight: 500;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .badge-student {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.9rem;
            background: var(--slate-100);
            border: 1px solid var(--slate-200);
            border-radius: 9999px;
            font-size: 0.825rem;
            font-weight: 600;
            color: var(--slate-700);
        }

        .badge-student i {
            color: var(--primary);
        }

        .badge-lecturer {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.45rem 1rem;
            background: #f5f3ff;
            border: 1px solid #ddd6fe;
            border-radius: 9999px;
            font-size: 0.825rem;
            color: #5b21b6;
        }

        .badge-lecturer i {
            color: #7c3aed;
        }

        .badge-lecturer strong {
            font-weight: 700;
            color: #4c1d95;
        }

        /* Main Container */
        .main-wrapper {
            flex: 1;
            max-width: 1280px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem 1.5rem;
        }

        /* Flash Alerts */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            margin-bottom: 1.75rem;
            display: flex;
            align-items: flex-start;
            gap: 0.85rem;
            font-size: 0.925rem;
            font-weight: 500;
            animation: slideDown 0.3s ease-out;
            box-shadow: var(--shadow-sm);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background-color: var(--success-light);
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .alert-error {
            background-color: var(--danger-light);
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert-icon {
            font-size: 1.25rem;
            line-height: 1;
        }

        .alert-close {
            margin-left: auto;
            background: transparent;
            border: none;
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
            font-size: 1rem;
            transition: var(--transition);
        }
        .alert-close:hover { opacity: 1; }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.65rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: var(--radius-md);
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition);
            border: 1px solid transparent;
            font-family: inherit;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
            transform: translateY(-1px);
        }

        .btn-outline {
            background: white;
            border-color: var(--slate-200);
            color: var(--slate-700);
        }
        .btn-outline:hover {
            background: var(--slate-50);
            border-color: var(--slate-300);
            color: var(--dark);
        }

        .btn-success {
            background: var(--success);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }
        .btn-success:hover {
            background: #059669;
            transform: translateY(-1px);
        }

        .btn-danger-outline {
            background: white;
            border-color: #fecaca;
            color: var(--danger);
        }
        .btn-danger-outline:hover {
            background: var(--danger-light);
            border-color: var(--danger);
        }

        .btn-sm {
            padding: 0.4rem 0.75rem;
            font-size: 0.775rem;
            border-radius: var(--radius-sm);
        }

        /* Footer */
        .footer {
            border-top: 1px solid var(--slate-200);
            background: white;
            padding: 2rem 1.5rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--slate-500);
            margin-top: auto;
        }

        .footer p {
            margin-bottom: 0.35rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 0.75rem;
        }

        .footer-links a {
            color: var(--slate-600);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--primary);
        }

        /* Modal Styles */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1.25rem;
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .modal-backdrop.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background: white;
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 580px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transform: scale(0.95);
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-backdrop.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--slate-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--slate-50);
        }

        .modal-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .modal-close {
            background: transparent;
            border: none;
            font-size: 1.25rem;
            color: var(--slate-400);
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        .modal-close:hover {
            background: var(--slate-200);
            color: var(--dark);
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--slate-200);
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            background: var(--slate-50);
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--slate-700);
            margin-bottom: 0.4rem;
        }

        .form-input, .form-textarea {
            width: 100%;
            padding: 0.7rem 0.95rem;
            font-size: 0.9rem;
            font-family: inherit;
            border: 1px solid var(--slate-200);
            border-radius: var(--radius-sm);
            background: white;
            color: var(--dark);
            transition: var(--transition);
        }

        .form-input:focus, .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        .dropzone-area {
            border: 2px dashed #cbd5e1;
            border-radius: var(--radius-md);
            padding: 2rem 1.5rem;
            text-align: center;
            background: #f8fafc;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .dropzone-area:hover, .dropzone-area.dragover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .dropzone-icon {
            font-size: 2.25rem;
            color: var(--primary);
            margin-bottom: 0.75rem;
        }

        .file-selected-box {
            display: none;
            margin-top: 1rem;
            padding: 0.75rem 1rem;
            background: var(--primary-light);
            border: 1px solid #c7d2fe;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            color: #3730a3;
            align-items: center;
            justify-content: space-between;
        }

        @media (max-width: 640px) {
            .navbar-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            .nav-actions {
                width: 100%;
                justify-content: space-between;
            }
            .main-wrapper {
                padding: 1.25rem 1rem 3rem 1rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Header Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('assignments.index') }}" class="brand">
                <div class="brand-icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="brand-text">
                    <h1>Pengembangan Aplikasi Web</h1>
                    <p>Portal Pengumpulan Tugas 17 Pertemuan</p>
                </div>
            </a>
            <div class="nav-actions">
                <div class="badge-lecturer">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Dosen: <strong>Muhammad Deden Firdaus, S.T, M.Kom</strong></span>
                </div>
                <a href="#daftar-pertemuan" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-folder-open"></i> Lihat Tugas
                </a>
            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <main class="main-wrapper">
        <!-- Flash Alerts -->
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <i class="fa-solid fa-circle-check alert-icon"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" role="alert">
                <i class="fa-solid fa-circle-exclamation alert-icon"></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <i class="fa-solid fa-triangle-exclamation alert-icon"></i>
                <div>
                    <strong>Ada kesalahan pengisian data:</strong>
                    <ul style="margin-top: 0.25rem; padding-left: 1.25rem;">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p><strong>Pengembangan Aplikasi Web</strong> &bull; Dosen Pengampu: <strong>Muhammad Deden Firdaus, S.T, M.Kom</strong></p>
        <p>Sistem Pengumpulan &amp; Arsip Tugas 17 Pertemuan (Penyimpanan Server Mandiri).</p>
        <div class="footer-links">
            <a href="{{ route('assignments.index') }}"><i class="fa-solid fa-house"></i> Beranda</a>
            <a href="{{ route('assignments.index') }}?filter=submitted"><i class="fa-solid fa-check-circle"></i> Tugas Terkumpul</a>
            <a href="{{ route('assignments.index') }}?filter=pending"><i class="fa-solid fa-clock"></i> Belum Kumpul</a>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
