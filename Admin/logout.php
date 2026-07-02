<?php
// Memulai atau menghubungkan ke session yang sedang aktif
session_start();

// Menghapus semua variabel session yang tersimpan
session_unset();

// Menghancurkan/menghapus session secara keseluruhan dari sistem
session_destroy();

// Mengarahkan pengguna kembali ke halaman beranda (index.php)
header("Location: ../index.php");
exit;
?>