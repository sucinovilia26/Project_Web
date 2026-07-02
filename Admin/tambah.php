<?php 
include '../koneksi.php'; 

if(isset($_POST['simpan'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stok = $_POST['stok']; 
    $image = $_FILES['image']['name'];

    // Pindahkan file gambar ke folder img/
    if($image != ""){
        move_uploaded_file($_FILES['image']['tmp_name'], "img/".$image);
    }

    // Insert ke database
    mysqli_query($conn, "INSERT INTO items(name, price, stok, image) VALUES('$name', '$price', '$stok', '$image')");

    // Kembali ke halaman admin setelah berhasil
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - SR Outdoor</title>
    
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

        /* Style untuk area preview gambar */
        .img-preview {
            max-width: 150px;
            max-height: 150px;
            object-fit: contain;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 5px;
            background-color: #f8fafc;
            display: none; /* Sembunyikan gambar secara default */
            margin-top: 15px;
        }

        .btn-simpan {
            background-color: var(--primary-green);
            color: white;
            padding: 10px 30px;
            border-radius: 8px;
            font-weight: 500;
            border: none;
            transition: 0.3s;
        }

        .btn-simpan:hover {
            background-color: #1e4028;
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
            <a href="admin.php" class="nav-link">
                <i class="fa-solid fa-box-open"></i> Data Barang
            </a>
            <a href="tambah.php" class="nav-link active">
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
            <h2 class="content-title">Tambah Barang</h2>
            
            <form method="POST" enctype="multipart/form-data">
                
                <div class="mb-4">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Barang" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Harga / Hari (Rp)</label>
                    <input type="number" name="price" class="form-control" placeholder="Masukkan Harga" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga Sewa (Rp)</label>
                    <input type="number" name="price" class="form-control" placeholder="Contoh: 50000" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok Barang</label>
                    <input type="number" name="stok" class="form-control" placeholder="Contoh: 10" min="0" required>
                </div>

                <div class="mb-5">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*" onchange="previewImage()" required>
                    
                    <img id="imagePreview" src="#" alt="Preview Gambar" class="img-preview">
                </div>

                <div class="d-flex gap-3 justify-content-center mt-2">
                    <button type="submit" name="simpan" class="btn btn-simpan">Simpan</button>
                    <a href="admin.php" class="btn btn-batal">Batal</a>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function previewImage() {
            // Ambil elemen input file dan tempat gambar (img)
            const imageInput = document.getElementById('imageInput');
            const imagePreview = document.getElementById('imagePreview');
            
            // Ambil file yang dipilih pengguna
            const file = imageInput.files[0];
            
            if (file) {
                // Membaca file menggunakan FileReader
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Setel 'src' gambar dengan hasil bacaan (base64)
                    imagePreview.src = e.target.result;
                    // Munculkan tag img yang tadinya di-hidden
                    imagePreview.style.display = 'block'; 
                }
                
                reader.readAsDataURL(file);
            } else {
                // Sembunyikan preview jika user membatalkan pilihan file
                imagePreview.src = "#";
                imagePreview.style.display = 'none'; 
            }
        }
    </script>
</body>
</html>