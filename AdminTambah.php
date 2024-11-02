<?php
require "koneksi.php";

if(isset($_POST["submit"])) {
    $merk = $_POST["merk"];
    $desk = $_POST["desk"];

        $sql = "INSERT INTO belanja VALUES ('','$nama','$alamat', '$merk', '$jumlah', '$paket', '$newFileName')";
    
        $result = mysqli_query($conn, $sql);
    
        if($result){
            echo "
            <script>
                alert('Berhasil Menambah Data ke Etalase!');
                document.location.href = 'keranjang.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Gagal Menambah Data ke Etalase!');
                document.location.href = 'belanja.php';
            </script>";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="icon" href="img/logo_dji.png">
    
    <link rel="stylesheet" href="style/style-belanja.css">
    <link rel="stylesheet" href="style/style.css">

    <style>
      *{
        font-family: lato,  sans-serif;

      }
    </style>
</head>
<body  style="background-image: url(img/background_dji_drone.jpg);">
<?php require("night.php") ?>  
  
<div class="utama-banget">

    <div class="utama">
        <form class="kartu-belanja" action="" method="post" enctype="multipart/form-data">
            <h2>TAMBAH ETALASE</h2>

            <br>

            <div class="form-control">
                <input
                    type="text"
                    id="merk"
                    name="merk" 
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="Merk Drone"
                    required
                />
                <label for="merk" class="label-input">
                    Merk Drone
                </label>
            </div>

            <br>

            <div class="form-control">
                <input
                    type="text"
                    id="desk"
                    name="desk"
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="deskripsi"
                    required
                />
                <label for="desk" class="label-input">
                    Deskripsi
                </label>
            </div>

            <br>

            <button type ="submit" name="submit" class="btn btn-outline">BUY</button>
        </form>
    </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>