<?php
require "koneksi.php";

session_start();
if ($_SESSION['role'] != 'admin'){
    header('location: admin.php');
    exit();
}

if(isset($_POST["submit"])) {
    $merk = $_POST["merk"];
    $harga = $_POST["harga"];
    $desk = $_POST["desk"];
    $gambar = $_POST["gambar"];

    $tmp_name = $_FILES["gambar"]["tmp_name"];
    $file_name = $_FILES["gambar"]["name"];

    $ekstensi = explode('.', $file_name);
    $ekstensi = strtolower(end($ekstensi));
    $ekstensi = "." . $ekstensi;

    $newFileName = uniqid() . $ekstensi;

    if(move_uploaded_file($tmp_name, "imgEtalase/".  $newFileName)){


        $sql = "INSERT INTO etalase VALUES ('$merk','$desk', '$newFileName', '$harga', '')";
    
        $result = mysqli_query($conn, $sql);
    
        if($result){
            echo "
            <script>
                alert('Berhasil Menambah Data ke Etalase!');
                document.location.href = 'admin.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Gagal Menambah Data ke Etalase!');
                document.location.href = 'admin.php';
            </script>";
        }

    }  else {
        echo "
            <script>
            alert('data file tidak valid!');
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
    <title>Tambah Etalase</title>

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
                    type="number"
                    id="harga"
                    name="harga" 
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="Harga Drone"
                    required
                />
                <label for="harga" class="label-input">
                    harga Drone
                </label>
            </div>

            
            <br>

            <div class="form-control">
                <textarea
                    name="desk"
                    id="desk"
                    cols="30"
                    rows="10"
                    placeholder="Jelaskan Drone disini..."
                    class="textarea textarea-info"
                ></textarea>
                <label for="message" class="label-input">
                    Jelaskan Drone disini...
                </label>
            </div>
            
            <br>
            
            <input type="file" name="gambar" id="gambar" class="file-input file-neu">

            <br>
            
            <button type ="submit" name="submit" class="btn btn-outline">TAMBAH</button>
        </form>
    </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>