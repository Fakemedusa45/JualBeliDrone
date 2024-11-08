<?php 
session_start();
if ($_SESSION['role'] != 'user') {
    header('location: index.php');
    exit();
}

require "koneksi.php";

$id_produk = $_GET['id_produk'];
$user_id = $_SESSION['id_user'];  // Pastikan id_user tersimpan di session saat login

// Query untuk mendapatkan data produk yang ingin diedit berdasarkan user_id dan id_produk
$sql = mysqli_query($conn, "SELECT belanja.*, etalase.merk, etalase.harga 
                            FROM belanja 
                            JOIN etalase ON belanja.id_produk = etalase.id_etalase
                            WHERE belanja.id_user = '$user_id' AND belanja.id_produk = '$id_produk'");

$belanja = mysqli_fetch_assoc($sql); // Ambil hasil query sebagai array

if (isset($_POST["submit"])) {
    $jumlah = $_POST["jumlah"]; // Ambil input jumlah dari form

    // Query untuk update jumlah belanja
    $update_sql = "UPDATE belanja SET jumlah='$jumlah' WHERE id_produk='$id_produk' AND id_user='$user_id'";

    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        echo "
        <script>
            alert('Berhasil Mengubah data belanjaan di keranjang!');
            document.location.href = 'keranjang.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Mengubah data belanjaan di keranjang!');
            document.location.href = 'index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>

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
<body style="background-image: url(img/background_dji_drone.jpg);">
<?php require("navbar.php") ?> 
<?php require("night.php") ?>    
<div class="utama-banget">
    <div class="utama">
        <form class="kartu-belanja" action="" method="post" enctype="multipart/form-data">
            <h2>EDIT KERANJANG</h2>

            <br>

            <div class="form-control">
                <input
                    type="text"
                    id="merk"
                    name="merk"
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="merk"
                    value="<?= $belanja["merk"] ?>"
                    required
                    readonly
                />
                <label for="merk" class="label-input">
                    Merk Drone
                </label>
            </div>
            
            <br>
            
            <div class="form-control">
                <input
                    type="number"
                    id="jumlah"
                    name="jumlah"
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="jumlah"
                    required
                    value="<?= htmlspecialchars($belanja['jumlah']); ?>"
                    min="1"
                />
                <label for="jumlah" class="label-input">
                    Jumlah
                </label>
            </div>

            <br>

            <div class="form-control">
                <input
                    type="textr"
                    id="harga"
                    name="harga"
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="Harga"
                    required
                    value="<?= "Rp " . number_format($belanja["harga"], 0, ",", ".") ?>"
                    min="1"
                    readonly
                />
                <label for="harga" class="label-input">
                    Harga
                </label>
            </div>

            <br>

            <button type="submit" name="submit" class="btn btn-outline">KONFIRMASI</button>
        </form>
    </div>
</div>
<script src="script/script.js"></script>
</body>
</html>
