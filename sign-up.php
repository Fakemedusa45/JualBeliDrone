<?php
require "koneksi.php";

session_start();

if (isset($_SESSION['role'])) {
    header('location: index.php');
}

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = trim($_POST["password"]);
    $password_confirm = trim($_POST["password_confirm"]);
    $role = "user";
    $namaLengkap = $_POST["nama_lengkap"];

    // Cek apakah username sudah digunakan
    $checkQuery = "SELECT * FROM user WHERE email = '$email' or username = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        // Jika username sudah digunakan
        echo "
        <script>
            alert('Username sudah digunakan! Silakan gunakan username lain.');
            document.location.href = 'index.php';
        </script>
        ";
    }
    
    if ($password !== $password_confirm) {
        echo "
        <script>
            alert('Password tidak cocok');
            document.location.href = 'sign-up.php';
        </script>";
        exit;
    }
    
    if (strlen($password) < 8) {
        echo "
        <script>
            alert('Password harus minimal 8 karakter');
            document.location.href = 'sign-up.php';
        </script>";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (username, email, password, role, namaLengkap) VALUES ('$username', '$email','$hashed_password', '$role', '$namaLengkap')";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "
        <script>
            alert('Berhasil Melakukan Sign-up');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Melakukan Sign-up');
            document.location.href = 'sign-up.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style/style-login.css">
    <link rel="stylesheet" href="style/style.css">
    
    <style>
        *{
          font-family: lato,  sans-serif;
  
        }

        .login{
            display: none;
        }
      </style>
</head>
<body>

    <?php require("navbar.php") ?>
    <?php require("night.php") ?>

    <div class="main">
        
        <div class="card">
        <form class="input-card" method="post">
            <h1>REGISTER</h1>
            <br>
            
            <div class="form-control">
            <input
                name="nama_lengkap"
                type="text"
                id="nama_lengkap"
                class="text-input input-neu"
                autocomplete="off"
                placeholder="Nama Lengkap"
                required
            />
            <label for="nama_lengkap" class="label-input">
                Nama Lengkap
            </label>
            </div>

            <br>

            <div class="form-control">
            <input
                name="username"
                type="text"
                id="username"
                class="text-input input-neu"
                autocomplete="off"
                placeholder="Username"
                required
            />
            <label for="username" class="label-input">
                Username
            </label>
            </div>

            <br>

            <div class="form-control">
            <input
                name="email"
                type="email"
                id="email"
                class="text-input input-neu"
                autocomplete="off"
                placeholder="E-mail"
                required
            />
            <label for="email" class="label-input">
                E-mail
            </label>
            </div>

            <br>

            <div class="form-control">
            <input
                name="password"
                type="password"
                id="password"
                class="text-input input-neu"
                autocomplete="off"
                placeholder="Password"
                required
            />
            <label for="password" class="label-input">
                Password
            </label>
            </div>

            <br>

            <div class="form-control">
                <input
                    name="password_confirm"
                    type="password"
                    id="password_confirm"
                    class="text-input input-neu"
                    autocomplete="off"
                    placeholder="Konfirmasi Password"
                    required
                />
                <label for="password_confirm" class="label-input">
                    Konfirmasi Password
                </label>
            </div>
        
            <br>

            <button type ="submit" name="submit" class="btn btn-outline">Confirm</button>

            <br>

            <p>sudah memiliki akun?  <a class="aksi" href="login.php">Login</a></p>

        </form>
    </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>