<?php
session_start();
require "koneksi.php";

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Query untuk mendapatkan data user berdasarkan email
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    // Cek apakah email ditemukan
    if (mysqli_num_rows($result) === 1) {
        // Ambil data pengguna
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Cek role pengguna
            $_SESSION['login'] = true; // tambahkan session jika berhasil login
            if ($user['role'] === 'Admin') {
                $_SESSION['role'] = 'admin'; // session untuk admin
                echo "
                <script>
                alert('Login berhasil! Selamat datang Admin.');
                document.location.href = 'CRUDAdmin.php';
                </script>
                ";
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $user['password'];
                $_SESSION['role'] = 'user'; // session untuk user
                echo "
                <script>
                alert('Login berhasil! Selamat datang.');
                document.location.href = 'index.php';
                </script>
                ";
            }
        } else {
            echo "
            <script>
            alert('Password salah!');
            </script>
            ";
        }
    } else {
        echo "
        <script>
        alert('email tidak ditemukan!');
        </script>
        ";
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
            <h1>LOGIN</h1>
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

              <button type ="submit" name="submit" class="btn btn-outline">Confirm</button>

              <br>

              <p>belum memiliki  akun? <a class="aksi" href="sign-up.php">Register</a></p>

        </form>
    </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>