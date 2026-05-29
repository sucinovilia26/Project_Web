<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SR Outdoor</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background-color: #f4f7fb;
            font-family: Arial, Helvetica, sans-serif;
        }

        .navbar{
            background-color: #1F3A5F;
        }

        .navbar-brand{
            color: white !important;
            font-size: 28px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .hero{
            height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-box{
            background: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
            text-align: center;
            width: 700px;
        }

        .hero-box h1{
            color: #1F3A5F;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero-box p{
            color: gray;
            margin-bottom: 30px;
        }

        .btn-custom{
            background-color: #1F3A5F;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            margin: 10px;
            transition: 0.3s;
        }

        .btn-custom:hover{
            background-color: #16314d;
        }

        .footer{
            text-align: center;
            padding: 20px;
            color: gray;
        }

    </style>

</head>
<body>

<a class="navbar-brand d-flex align-items-center" href="#">

    <img src="logo.png"
         width="100"
         height="100"
         class="me-2">

    SR Outdoor

</a>

<!-- Hero -->
<section class="hero">

    <div class="hero-box">

        <h1>
            Selamat Datang di SR Outdoor
        </h1>

        <p>
            Website Penyewaan Peralatan Outdoor
            terpercaya, mudah, dan cepat.
        </p>

        <a href="login.php" class="btn-custom">
            Login
        </a>

        <a href="register.php" class="btn-custom">
            Register
        </a>

        <a href="dashboard.php" class="btn-custom">
            Dashboard
        </a>

    </div>

</section>

<!-- Footer -->
<div class="footer">
    © 2026 SR Outdoor - Penyewaan Peralatan Outdoor
</div>

</body>
</html>