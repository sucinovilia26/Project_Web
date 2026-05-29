<?php 
include 'koneksi.php'; 

// Proses Tambah Barang
if(isset($_POST['tambah'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    // Pindahkan file gambar ke folder img/
    if($image != ""){
        move_uploaded_file($_FILES['image']['tmp_name'], "img/".$image);
    }

    // Insert ke database (Sesuai dengan kode admin.php Anda sebelumnya)
    mysqli_query($conn, "INSERT INTO items(name,price,image) VALUES('$name','$price','$image')");

    // Refresh halaman agar data baru langsung muncul
    header("Location: admin.php");
    exit;
}

// Proses Hapus Barang (Fitur tambahan untuk melengkapi tombol "Hapus" di wireframe)
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM items WHERE id='$id'");
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SR Outdoor</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-green: #2C5E3B;
            --accent-orange: #E89B27;
            --bg-light: #F4F7F5;
            --sidebar-width: 250px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: #2D3748;
            overflow-x: hidden;
        }

        /* Styling Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: #ffffff;
            border-right: 1px solid #E2E8F0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #E2E8F0;
        }

        .sidebar-header img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--primary-green);
            padding: 2px;
            object-fit: contain;
        }

        .sidebar-header h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary-green);
        }

        .nav-link {
            color: #4A5568;
            padding: 15px 25px;
            font-weight: 500;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-left: 4px solid transparent;
            transition: 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(44, 94, 59, 0.05);
            color: var(--primary-green);
            border-left-color: var(--primary-green);
        }

        .nav-link i {
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        /* Styling Konten Utama */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            min-height: 100vh;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .content-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--primary-green);
            margin: 0;
        }

        .btn-custom {
            background-color: var(--primary-green);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #1e4028;
            color: white;
        }

        /* Styling Tabel */
        .table-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            border: 1px solid #E2E8F0;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: #f8fafc;
        }

        .table th {
            font-weight: 600;
            color: #4A5568;
            font-size: 14px;
            padding: 15px 20px;
            border-bottom: 2px solid #E2E8F0;
        }

        .table td {
            vertical-align: middle;
            font-size: 14px;
            padding: 15px 20px;
            border-bottom: 1px solid #E2E8F0;
        }

        .img-item {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border-radius: 6px;
            border: 1px solid #E2E8F0;
            padding: 2px;
        }

        .action-link {
            text-decoration: none;
            font-weight: 500;
            margin-right: 15px;
            font-size: 13px;
        }

        .link-edit { color: var(--accent-orange); }
        .link-delete { color: #d93025; }
        
        .action-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <img src="Gambar/logo.png" alt="Logo">
            <h4>SR Outdoor</h4>
        </div>
        <div class="mt-3 flex-grow-1">
            <a href="#" class="nav-link">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
            <a href="admin.php" class="nav-link active">
                <i class="fa-solid fa-box-open"></i> Data Barang
            </a>
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fa-solid fa-plus-circle"></i> Tambah Barang
            </a>
        </div>
        <div class="mb-4">
            <a href="logout.php" class="nav-link text-danger">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="content-header">
            <h2 class="content-title">Data Barang</h2>
            <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fa-solid fa-plus"></i> Tambah Barang
            </button>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Harga/Hari</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mengambil data dari tabel items
                        $query = mysqli_query($conn, "SELECT * FROM items ORDER BY id DESC");
                        $no = 1;
                        
                        if(mysqli_num_rows($query) > 0):
                            while($row = mysqli_fetch_assoc($query)):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <img src="img/<?= $row['image']; ?>" class="img-item" alt="Gambar Alat">
                            </td>
                            <td><strong style="color: var(--primary-green);"><?= $row['name']; ?></strong></td>
                            <td>Rp<?= number_format($row['price'], 0, ',', '.'); ?></td>
                            <td>
                                <?php 
                                    // Logika status sederhana (Tersedia / Sedang Dipinjam)
                                    if(isset($row['status']) && $row['status'] == 'rented') {
                                        echo '<span class="text-danger fw-semibold">Disewa</span>';
                                    } else {
                                        echo '<span class="text-success fw-semibold">Tersedia</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>" class="action-link link-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                                <a href="admin.php?hapus=<?= $row['id']; ?>" class="action-link link-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php 
                            endwhile; 
                        else: 
                        ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data barang yang ditambahkan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success fw-bold">Tambah Barang Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Alat</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Tenda Dome 4 Orang" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Sewa (Rp)</label>
                            <input type="number" name="price" class="form-control" placeholder="Contoh: 50000" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Gambar Barang</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-custom px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>