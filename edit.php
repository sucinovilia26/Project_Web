<?php 
include 'koneksi.php'; 

// 1. Cek parameter ID di URL
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    // Ambil data barang yang sesuai dengan ID
    $query = mysqli_query($conn, "SELECT * FROM items WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);
    
    // Jika ID acak/tidak ada di database, lempar balik ke admin.php
    if(!$data){
        header("Location: admin.php");
        exit;
    }
} else {
    header("Location: admin.php");
    exit;
}

// 2. Proses handling form ketika tombol Update diklik
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $image = $_FILES['image']['name'];

    if($image != ""){
        // Jika admin memilih gambar baru, upload gambar baru dan ganti data di DB
        move_uploaded_file($_FILES['image']['tmp_name'], "img/".$image);
        mysqli_query($conn, "UPDATE items SET name='$name', price='$price', status='$status', image='$image' WHERE id='$id'");
    } else {
        // Jika tidak upload gambar baru, perbarui data teks saja (gambar lama tetap aman)
        mysqli_query($conn, "UPDATE items SET name='$name', price='$price', status='$status' WHERE id='$id'");
    }

    // Alihkan kembali ke admin.php setelah data sukses diperbarui
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - SR Outdoor</title>
    
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

        /* Sidebar Kiri */
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

        /* Konten Utama */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 40px;
            min-height: 100vh;
        }

        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.03);
            border: 1px solid #E2E8F0;
            max-width: 800px;
        }

        .content-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--primary-green);
            margin-bottom: 25px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 15px;
        }

        .form-label {
            font-weight: 500;
            color: #4A5568;
        }

        .form-control, .form-select {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(44, 94, 59, 0.25);
        }

        .current-img-preview {
            width: 120px;
            height: 120px;
            object-fit: contain;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 5px;
            background-color: #f8fafc;
        }

        .btn-update {
            background-color: var(--accent-orange);
            color: white;
            padding: 10px 30px;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            transition: 0.3s;
        }

        .btn-update:hover {
            background-color: #d18a20;
            color: white;
        }

        .btn-batal {
            background-color: #ffffff;
            color: #4A5568;
            padding: 10px 30px;
            border-radius: 8px;
            font-weight: 500;
            border: 1px solid #cbd5e1;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-batal:hover {
            background-color: #f1f5f9;
            color: #2D3748;
        }
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
            <a href="tambah.php" class="nav-link">
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
        <div class="form-container">
            <h2 class="content-title">Edit Barang</h2>
            
            <form method="POST" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['name']); ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Harga / Hari (Rp)</label>
                    <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($data['price']); ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="available" <?= (isset($data['status']) && $data['status'] == 'available') ? 'selected' : ''; ?>>Tersedia (Available)</option>
                        <option value="rented" <?= (isset($data['status']) && $data['status'] == 'rented') ? 'selected' : ''; ?>>Disewa (Rented)</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label d-block">Gambar Saat Ini</label>
                    <img src="img/<?= htmlspecialchars($data['image']); ?>" class="current-img-preview" alt="Gambar Saat Ini">
                </div>

                <div class="mb-5">
                    <label class="form-label">Ganti Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted mt-1 d-block">*Biarkan kosong jika Anda tidak ingin merombak gambar.</small>
                </div>

                <div class="d-flex gap-3 justify-content-center mt-2">
                    <button type="submit" name="update" class="btn btn-update">Update</button>
                    <a href="admin.php" class="btn btn-batal">Batal</a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>