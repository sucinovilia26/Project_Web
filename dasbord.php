<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Daftar Peralatan Outdoor</h2>

<?php

$data = mysqli_query($conn,
"SELECT * FROM items");

while($row = mysqli_fetch_assoc($data)):

?>

<div style="border:1px solid black;
padding:10px;
margin:10px;
width:250px;">

<img src="img/<?= $row['image']; ?>"
     width="200">

<br><br>

<b><?= $row['name']; ?></b>

<br>

Harga:
Rp<?= $row['price']; ?>

<br>

Status:
<?= $row['status']; ?>

<br><br>

<?php if($row['status']=="available"): ?>

<form method="POST"
      action="sewa.php">

<input type="hidden"
       name="item_id"
       value="<?= $row['id']; ?>">

Tanggal Mulai:
<input type="date"
       name="start"
       required>

<br><br>

Tanggal Selesai:
<input type="date"
       name="end"
       required>

<br><br>

<button>Sewa</button>

</form>

<?php else: ?>

<b style="color:red;">
Sedang Dipinjam
</b>

<?php endif; ?>

</div>

<?php endwhile; ?>

<a href="riwayat.php">
Riwayat
</a>

|

<a href="logout.php">
Logout
</a>

</body>
</html>