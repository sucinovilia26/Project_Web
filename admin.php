<?php include 'koneksi.php'; ?>

<h2>Dashboard Admin</h2>

<form method="POST"
      enctype="multipart/form-data">

<input type="text"
       name="name"
       placeholder="Nama Alat"
       required>

<br><br>

<input type="number"
       name="price"
       placeholder="Harga"
       required>

<br><br>

<input type="file"
       name="image"
       required>

<br><br>

<button name="tambah">
Tambah
</button>

</form>

<?php

if(isset($_POST['tambah'])){

    $name = $_POST['name'];

    $price = $_POST['price'];

    $image = $_FILES['image']['name'];

    move_uploaded_file(
    $_FILES['image']['tmp_name'],
    "img/".$image
    );

    mysqli_query($conn,
    "INSERT INTO items(name,price,image)
     VALUES('$name','$price','$image')");
}

?>

<hr>

<h3>Data Penyewaan</h3>

<?php

$data = mysqli_query($conn,
"SELECT rentals.*, users.name,
 items.name AS item
 FROM rentals
 JOIN users ON rentals.user_id = users.id
 JOIN items ON rentals.item_id = items.id");

while($row = mysqli_fetch_assoc($data)):

?>

<div style="border:1px solid black;
padding:10px;
margin:10px;">

<b><?= $row['name']; ?></b>

<br>

Menyewa:
<?= $row['item']; ?>

<br>

Status:
<?= $row['status']; ?>

<br><br>

<a href="approve.php?id=<?= $row['id']; ?>">
Approve
</a>

</div>

<?php endwhile; ?>