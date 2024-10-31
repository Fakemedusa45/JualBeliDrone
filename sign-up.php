<?php
require "koneksi.php";

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = "user";

    $sql = "INSERT INTO user VALUES ('', '$username', '$email','$password', '$role')";

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

            <button type ="submit" name="submit" class="btn btn-outline">Confirm</button>

            <br>

            <p>sudah memiliki akun?  <a class="aksi" href="login.php">Login</a></p>

        </form>
    </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>