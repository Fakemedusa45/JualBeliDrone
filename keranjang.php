<?php 
    session_start();
    if ($_SESSION['role'] != 'user') {
        header('location: index.php');
        exit();
    }

    require "koneksi.php";
    $user_id = $_SESSION['id_user'];

    // Proses penambahan item ke keranjang
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_produk']) && isset($_POST['jumlah'])) {
        $id_produk = $_POST['id_produk'];
        $jumlah = $_POST['jumlah'];

        // Cek apakah produk sudah ada di keranjang
        $check_sql = mysqli_query($conn, "SELECT * FROM belanja WHERE id_user = '$user_id' AND id_produk = '$id_produk'");
        if (mysqli_num_rows($check_sql) > 0) {
            // Jika sudah ada, update jumlah
            mysqli_query($conn, "UPDATE belanja SET jumlah = jumlah + $jumlah WHERE id_user = '$user_id' AND id_produk = '$id_produk'");
        } else {
            // Jika belum ada, insert ke tabel belanja
            mysqli_query($conn, "INSERT INTO belanja (id_user, id_produk, jumlah) VALUES ('$user_id', '$id_produk', '$jumlah')");
        }
        // Redirect untuk menghindari pengulangan permintaan POST
        header('Location: keranjang.php');
        exit();
    }

    // Hanya mengambil item yang dimiliki oleh pengguna yang sedang login
    $sql = mysqli_query($conn, "SELECT belanja.*, etalase.merk, etalase.harga 
                            FROM belanja 
                            JOIN etalase ON belanja.id_produk = etalase.id_etalase
                            WHERE belanja.id_user = '$user_id'");

    $belanja = [];
    $total_harga = 0; // Inisialisasi total harga

    while ($row = mysqli_fetch_assoc($sql)) {
        $belanja[] = $row;
        $total_harga += $row['harga'] * $row['jumlah']; // Hitung total harga
    }

    // Simpan total harga ke sesi
    $_SESSION['total_harga'] = $total_harga; // Menyimpan total harga ke sesi
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
                            <th>Harga/item</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($belanja as $item) : ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $item["merk"] ?></td>
                            <td><?= $item["jumlah"] ?></td>
                            <td><?= "Rp " . number_format($item["harga"], 0, ",", ".") ?></td>
                            <td>
                                <a class="aksi" href="edit.php?id_produk=<?= $item['id_produk'] ?>">Ubah</a> | 
                                <a class="aksi" href="delete.php?id_produk=<?= $item['id_produk'] ?>" onclick="return confirm('Yakin ingin menghapus data?');">Hapus</a>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
                <br>
                <h2>Total Harga: <?= "Rp " . number_format($total_harga, 0, ",", ".") ?></h2>
                <br>
                <br>
                <?php
                if ($total_harga > 0) {
                    echo "
                    <a href='checkout.php' class='btn btn-outline' id='konfirmasi-belanja'>Checkout</a>
                    ";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>