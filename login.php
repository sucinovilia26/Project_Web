<?php 
include 'koneksi.php'; 

$error = '';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $data = mysqli_fetch_assoc($query);

    if($data && $password == $data['password']){        // Simpan sesi user
        $_SESSION['user'] = $data;

        // Langsung arahkan ke halaman tujuan tanpa cek role
        header("Location: admin.php"); 
        exit;
    } else {
        $error = "Email atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SR Outdoor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #2C5E3B; /* Hijau alam */
            --accent-orange: #E89B27; /* Oranye */
            --bg-light: #F4F7F5;
            --text-dark: #2D3748;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 400px;
            border: 1px solid #E2E8F0;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            border: 2px solid var(--primary-green);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: white;
            padding: 5px;
        }

        .logo-circle img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .login-title {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 22px;
            margin-bottom: 25px;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(44, 94, 59, 0.25);
        }

        .btn-custom {
            background-color: var(--primary-green);
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }

        .btn-custom:hover {
            background-color: #1e4028;
            color: white;
        }

        .back-link {
            color: #718096;
            font-size: 13px;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
            margin-top: 15px;
        }

        .back-link:hover {
            color: var(--primary-green);
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card text-center">
        <div class="logo-circle">
            <img src="img/logo.png" alt="Logo SR Outdoor">
        </div>

        <h2 class="login-title">Login Admin</h2>

        <?php if($error != ''): ?>
            <div class="alert alert-danger py-2" style="font-size: 14px;">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-4">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            
            <button type="submit" name="login" class="btn btn-custom w-100">
                Login
            </button>
        </form>

        <a href="index.php" class="back-link">Kembali Ke Beranda</a>
    </div>

</body>
</html>