<?php
session_start();
require "koneksi.php";

if (isset($_SESSION['role'])) {
  header('location: index.php');
}

if (isset($_POST["submit"])) {
    $identifier = $_POST["identifier"];
    $password = $_POST["password"];
    
    // Query untuk mendapatkan data user berdasarkan email atau username
    $query = "SELECT * FROM user WHERE email = '$identifier' OR username = '$identifier'";
    $result = mysqli_query($conn, $query);
    
    // Cek apakah email atau username ditemukan
    if (mysqli_num_rows($result) === 1) {
        // Ambil data pengguna
        $user = mysqli_fetch_assoc($result);
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Cek role pengguna
            $_SESSION['login'] = true; // tambahkan session jika berhasil login
            if ($user['role'] === 'admin') {
                $_SESSION['role'] = 'admin'; // session untuk admin
                echo "
                <script>
                alert('Login berhasil! Selamat datang Admin.');
                document.location.href = 'index.php';
                </script>
                ";
            } else {
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['role'] = 'user'; // session untuk user
                $_SESSION["id_user"] = $user["id_user"]; // Pastikan $user["id_user"] adalah ID pengguna yang benar
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
        alert('email atau username tidak ditemukan!');
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
                  name="identifier"
                  type="text"
                  id="identifier"
                  class="text-input input-neu"
                  autocomplete="off"
                  placeholder="Email atau Username"
                  required
                />
                <label for="identifier" class="label-input">
                  Email atau Username
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