<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashboardChop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    referrerpolicy="no-referrer"
    />
    

    <style>
        body {
            background: linear-gradient(135deg, #f7f9ff 0%, #eef3ff 100%);
        }

        nav.navbar {
            background: #FFFFFF;
            border-radius: 18px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 10px 20px;
        }

        /* Brand dan Icon Lingkaran */
        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #0c0c0c !important;
        }

        .navbar-brand .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f7f9ff 0%, #D3FFE7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand i {
            font-size: 24px;
            color: #1abc9c;
        }

        /* Menu */
        .navbar-nav .nav-link {
            color: #0c0c0c !important;
            font-weight: 500;
            border-radius: 12px;
            padding: 8px 16px !important;
            transition: all 0.3s ease;
            margin-left: 6px;
            margin-right: 6px;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(26, 188, 156, 0.15);
            color: #1abc9c !important;
        }

        .navbar-nav .nav-link.active {
            background: #1abc9c !important;
            color: #ffffff !important;
            text-decoration: none !important;
            box-shadow: 0 2px 5px rgba(26, 188, 156, 0.3);
        }

        .navbar-toggler {
            border: none;
            background-color: #1abc9c;
            border-radius: 10px;
        }

        .navbar-toggler-icon {
            filter: invert(1);
        }

        footer {
            margin-top: 40px;
            text-align: center;
            color: #777;
            font-size: 14px;
        }
        .small-card {
        background-color: #ffffff;
        border-radius: 18px;
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        padding: 16px 20px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .small-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .icon-circle {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f7f9ff 0%, #D3FFE7 100%);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            flex-shrink: 0;
        }

        .icon-primary { color: #007bff; }
        .icon-success { color: #28a745; }
        .icon-warning { color: #ffc107; }

        .card-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: left;
            gap: 16px;
        }

        .card-text {
            flex-grow: 1;
        }

        .card-text h6 {
            margin-bottom: 4px;
            font-weight: 600;
        }

        .card-text h4, .card-text h5 {
            margin: 0;
            font-weight: 700;
        }

        .pagination {
            justify-content: center;
            flex-wrap: wrap;
        }

        .pagination .page-item {
            margin: 3px;
        }

        .pagination .page-link {
            border-radius: 12px;
            border: none;
            padding: 8px 14px;
            font-weight: 500;
            color: #0c0c0c;
            background-color: #f7f9ff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background-color: #1abc9c;
            color: #fff;
        }

        .pagination .page-item.active .page-link {
            background-color: #1abc9c;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 2px 6px rgba(26, 188, 156, 0.4);
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            background-color: #f2f2f2;
            box-shadow: none;
        }

        @media (max-width: 768px) {
            .icon-circle {
                width: 55px;
                height: 55px;
            }

            .card-content {
                flex-direction: row;
                gap: 12px;
            }

            .card-text h4, .card-text h5 {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .pagination .page-link {
                padding: 6px 10px;
                font-size: 14px;
            }
        }
        
    </style>
    
</head>
<body>

    <div class="container py-3">
        <nav class="navbar navbar-expand-lg mb-4">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <div class="icon-circle">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    DashboardChop
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" 
                            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pelanggan.index') }}" 
                            class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                                <i class="fas fa-users me-1"></i> Pelanggan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p>© {{ date('Y') }} Dashboard by <b>Cophill</b></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
