<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST">

    <input type="text"
           name="name"
           placeholder="Nama"
           required>

    <br><br>

    <input type="email"
           name="email"
           placeholder="Email"
           required>

    <br><br>

    <input type="password"
           name="password"
           placeholder="Password"
           required>

    <br><br>

    <button name="register">
        Daftar
    </button>

</form>

<?php

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];

    $password = password_hash($_POST['password'],
                              PASSWORD_DEFAULT);

    mysqli_query($conn,
    "INSERT INTO users(name,email,password)
     VALUES('$name','$email','$password')");

    header("Location: login.php");
}

?>

</body>
</html>