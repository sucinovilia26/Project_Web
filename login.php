<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST">

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

    <button name="login">
        Login
    </button>

</form>

<?php

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    $data = mysqli_fetch_assoc($query);

    if($data &&
       password_verify($password,$data['password'])){

        $_SESSION['user'] = $data;

        if($data['role']=="admin"){

            header("Location: admin.php");

        } else {

            header("Location: dashboard.php");

        }

    } else {

        echo "Email atau Password salah";

    }

}

?>

</body>
</html>