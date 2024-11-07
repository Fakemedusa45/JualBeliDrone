<?php 
    session_start();
    if ($_SESSION['role'] != 'user'){
        header('location: index.php');
        exit();
    }

    require "koneksi.php";
    $sql = mysqli_query($conn, "SELECT * FROM belanja");

    $belanja = [];

    while ($row = mysqli_fetch_assoc($sql)) {
        $belanja[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanjaan</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="icon" href="img/logo_dji.png">
    
    <!-- <link rel="stylesheet" href="style/style-belanja.css"> -->
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-keranjang.css">

    <style>
        * {
            font-family: lato, sans-serif;
        }
    </style>
</head>

<body style="background-image: url(img/background_dji_drone.jpg);">
    <?php require("navbar.php") ?>  
    <?php require("night.php") ?>
    
    <div class="utama-banget">
        <div class="utama">
            <div class="kartu-belanja">
                <h1>KERANJANG</h1>
                <br>
                <table border=1 class="darkTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Merk</th>
                            <th>Jumlah</th>
                            <th>Paket</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i =1; foreach($belanja as $belanja) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $belanja["merk"] ?></td>
                            <td><?= $belanja["jumlah"] ?></td>
                            <td><?= $belanja["paket"] ?></td>
                            <td><a class="aksi" href="edit.php?id_produk=<?= $belanja['id_produk'] ?>">Ubah</a> | <a class="aksi" href="delete.php?id_produk=<?= $belanja['id_produk'] ?>" onclick="return confirm('Yakin ingin menghapus data?');">Hapus</a></td>
                        </tr>
                        <?php $i++; endforeach ?>
                    </tbody>
                </table>
                <br>
                <br>
                <a href="checkout.php" class="btn btn-outline" id="konfirmasi-belanja">Checkout</a>
            </div>
        </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>