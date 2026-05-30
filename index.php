<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SR Outdoor - Siap Temani Setiap Pendakianmu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-green: #2C5E3B; /* Hijau alam */
            --accent-orange: #E89B27; /* Oranye senada dengan logo */
            --bg-light: #F4F7F5; /* Putih keabu-abuan / natural */
            --text-dark: #2D3748;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
        }

        /* Navbar Styling */
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            padding: 15px 0;
            border-bottom: 3px solid var(--primary-green);
        }

        .brand-text h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-green);
            margin: 0;
            line-height: 1.2;
        }

        .brand-text p {
            font-size: 13px;
            color: #718096;
            margin: 0;
            font-weight: 400;
        }

        .btn-login-admin {
            color: var(--text-dark);
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s ease;
        }

        .btn-login-admin:hover {
            color: var(--accent-orange);
        }

        .btn-login-admin i {
            font-size: 20px;
        }

        /* Hero Section */
        .hero-section {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            margin-top: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border: 1px solid #E2E8F0;
        }

        .hero-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .hero-title {
            font-weight: 700;
            color: var(--primary-green);
            font-size: 32px;
            margin-bottom: 20px;
        }

        .hero-desc {
            color: #4A5568;
            font-size: 16px;
            line-height: 1.6;
        }

        /* Peralatan Section */
        .section-title {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 25px;
            font-size: 22px;
            border-left: 4px solid var(--accent-orange);
            padding-left: 10px;
        }

        .card-alat {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #ffffff;
            height: 100%;
        }

        .card-alat:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .card-img-wrapper {
            height: 200px;
            overflow: hidden;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .card-img-wrapper img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .alat-name {
            font-weight: 600;
            font-size: 16px;
            color: var(--primary-green);
            margin-bottom: 5px;
        }

        .alat-price {
            color: #718096;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .badge-tersedia {
            background-color: white;
            color: var(--primary-green);
            border: 1px solid var(--primary-green);
            padding: 6px 15px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            display: inline-block;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 30px 0;
            margin-top: 50px;
            color: #718096;
            font-size: 14px;
            border-top: 1px solid #E2E8F0;
        }
    </style>
</head>
<body>

    <nav class="navbar-custom">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <img src="img/logo.png" alt="Logo SR Outdoor" width="60">
                <div class="brand-text">
                    <h1>SR OUTDOOR</h1>
                    <p>Siap Temani Setiap Pendakianmu</p>
                </div>
            </div>
            <div>
                <a href="login.php" class="btn-login-admin">
                    <i class="fa-regular fa-circle-user"></i> Login
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="hero-section">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1503220317375-aaad61436b1b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Gambar Pemandangan" class="hero-img">
                </div>
                <div class="col-lg-5 px-lg-4">
                    <h2 class="hero-title">Peralatan Outdoor Terbaik Untuk Petualangan Anda</h2>
                    <p class="hero-desc">
                        Temukan berbagai peralatan adventure berkualitas yang masih tersedia di SR Outdoor. Persiapkan perjalanan Anda dengan aman dan nyaman bersama kami.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h3 class="section-title">Peralatan Tersedia</h3>
        <div class="row g-4">
            
            <?php
            // Mengambil data barang yang statusnya tersedia (atau semua barang jika Anda belum memfilter status di DB)
            // Asumsi tabel items memiliki kolom: id, name, price, image, (status)
            $query = mysqli_query($conn, "SELECT * FROM items ORDER BY id DESC LIMIT 8"); 
            
            // Cek apakah ada data
            if(mysqli_num_rows($query) > 0) {
                while($row = mysqli_fetch_assoc($query)):
            ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card-alat">
                    <div class="card-img-wrapper">
                        <img src="img/<?= $row['image']; ?>" alt="<?= $row['name']; ?>">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="alat-name"><?= $row['name']; ?></h5>
                        <p class="alat-price">Rp<?= number_format($row['price'], 0, ',', '.'); ?> / hari</p>
                        
                        <?php 
                        // Jika Anda memiliki kolom 'status' di tabel items, Anda bisa memodifikasi logika ini
                        $status_label = isset($row['status']) && $row['status'] == 'rented' ? 'Sedang Disewa' : 'Tersedia';
                        $status_color = isset($row['status']) && $row['status'] == 'rented' ? 'border-danger text-danger' : '';
                        ?>
                        <div class="badge-tersedia <?= $status_color ?>">
                            <?= $status_label ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                endwhile; 
            } else {
                echo '<div class="col-12 text-center text-muted py-5">Belum ada data peralatan.</div>';
            }
            ?>

        </div>
    </div>

    <div class="footer">
        <div class="container">
            &copy; 2026 SR Outdoor. All rights reserved
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.css"></script>
</body>
</html>