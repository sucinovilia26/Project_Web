<?php 
include '../koneksi.php'; 

// Proteksi: Hanya Admin yang boleh mengakses
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

// PROSES TAMBAH TRANSAKSI OLEH ADMIN
if(isset($_POST['tambah_transaksi'])){
    $nama_penyewa = mysqli_real_escape_string($conn, $_POST['nama_penyewa']);
    $item_id = $_POST['item_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Cek stok apakah masih ada
    $cek = mysqli_query($conn, "SELECT stok FROM items WHERE id='$item_id'");
    $data_barang = mysqli_fetch_assoc($cek);

    if($data_barang['stok'] > 0){
        // Masukkan data sewa
        mysqli_query($conn, "INSERT INTO rentals(nama_penyewa, item_id, start_date, end_date, status_sewa) VALUES('$nama_penyewa', '$item_id', '$start_date', '$end_date', 'dipinjam')");
        // Kurangi stok barang
        mysqli_query($conn, "UPDATE items SET stok = stok - 1 WHERE id='$item_id'");
        
        echo "<script>alert('Transaksi berhasil dicatat!'); window.location='transaksi.php';</script>";
    } else {
        echo "<script>alert('Gagal! Stok barang tersebut habis.'); window.location='transaksi.php';</script>";
    }
    exit;
}

// PROSES PENGEMBALIAN BARANG OLEH ADMIN
if(isset($_GET['kembali'])){
    $rental_id = $_GET['kembali'];
    $item_id = $_GET['item'];

    // Ubah status transaksi menjadi dikembalikan
    mysqli_query($conn, "UPDATE rentals SET status_sewa = 'dikembalikan' WHERE id='$rental_id'");
    // Tambahkan kembali stok barang
    mysqli_query($conn, "UPDATE items SET stok = stok + 1 WHERE id='$item_id'");
    
    header("Location: transaksi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Transaksi - Admin SR Outdoor</title>
    
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
        
        /* Sidebar Styling dengan Flexbox */
        .sidebar { 
            width: var(--sidebar-width); 
            height: 100vh; 
            position: fixed; 
            background: #ffffff; 
            border-right: 1px solid #E2E8F0; 
            display: flex;             /* Wajib untuk membuat layout flex */
            flex-direction: column;    /* Menyusun elemen dari atas ke bawah */
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
        
        /* Main Content */
        .main-content { 
            margin-left: var(--sidebar-width); 
            padding: 30px; 
            min-height: 100vh;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../img/logo.png" alt="Logo">
            <h4>SR Outdoor</h4>
        </div>
        
        <div class="mt-3 flex-grow-1">
            <a href="admin.php" class="nav-link">
                <i class="fa-solid fa-box-open"></i> Data Barang
            </a>
            <a href="transaksi.php" class="nav-link active">
                <i class="fa-solid fa-clipboard-list"></i> Transaksi Sewa
            </a>
        </div>
        
        <div class="mt-auto mb-4 border-top pt-2">
            <a href="logout.php" class="nav-link text-danger">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: #2C5E3B; font-weight: 600; font-size: 24px;">Manajemen Transaksi</h2>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSewa">
                + Catat Penyewaan Baru
            </button>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 px-4">No</th>
                                <th class="py-3 px-4">Nama Penyewa</th>
                                <th class="py-3 px-4">Barang</th>
                                <th class="py-3 px-4">Tanggal Pinjam</th>
                                <th class="py-3 px-4">Tanggal Kembali</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Menampilkan data transaksi dengan JOIN ke tabel items
                            $query = mysqli_query($conn, "SELECT rentals.*, items.name AS nama_barang FROM rentals JOIN items ON rentals.item_id = items.id ORDER BY rentals.id DESC");
                            $no = 1;
                            
                            if(mysqli_num_rows($query) > 0):
                                while($row = mysqli_fetch_assoc($query)):
                            ?>
                            <tr>
                                <td class="px-4"><?= $no++; ?></td>
                                <td class="px-4"><strong><?= htmlspecialchars($row['nama_penyewa']); ?></strong></td>
                                <td class="px-4"><?= htmlspecialchars($row['nama_barang']); ?></td>
                                <td class="px-4"><?= date('d M Y', strtotime($row['start_date'])); ?></td>
                                <td class="px-4"><?= date('d M Y', strtotime($row['end_date'])); ?></td>
                                <td class="px-4">
                                    <?php if($row['status_sewa'] == 'dipinjam'): ?>
                                        <span class="badge bg-warning text-dark py-2 px-3 rounded-pill">Sedang Dipinjam</span>
                                    <?php else: ?>
                                        <span class="badge bg-success py-2 px-3 rounded-pill">Dikembalikan</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4">
                                    <?php if($row['status_sewa'] == 'dipinjam'): ?>
                                        <a href="transaksi.php?kembali=<?= $row['id']; ?>&item=<?= $row['item_id']; ?>" 
                                           class="btn btn-sm btn-outline-primary fw-semibold"
                                           onclick="return confirm('Konfirmasi: Barang sudah dikembalikan oleh penyewa?');">
                                           <i class="fa-solid fa-check"></i> Tandai Selesai
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted fw-semibold"><i class="fa-solid fa-check-double text-success"></i> Selesai</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php 
                                endwhile;
                            else: 
                            ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada transaksi penyewaan.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSewa" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold">Catat Transaksi Sewa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Penyewa (KTP)</label>
                            <input type="text" name="nama_penyewa" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Barang</label>
                            <select name="item_id" class="form-select" required>
                                <option value="">-- Pilih Barang yang Tersedia --</option>
                                <?php 
                                // Hanya menampilkan barang yang stoknya di atas 0
                                $items = mysqli_query($conn, "SELECT * FROM items WHERE stok > 0");
                                while($it = mysqli_fetch_assoc($items)){
                                    echo "<option value='{$it['id']}'>{$it['name']} (Sisa Stok: {$it['stok']})</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Mulai Sewa</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Rencana Kembali</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah_transaksi" class="btn btn-success px-4 fw-semibold">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>