<?php 
    session_start();
    require "koneksi.php";
    $sql = mysqli_query($conn, "SELECT * FROM belanja");

    $belanja = [];

    while ($row = mysqli_fetch_assoc($sql)) {
        $belanja[] = $row;
    }
    
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
    
        // Query SQL untuk mencari data berdasarkan nama atau NIM
        $sql = mysqli_query($conn, "SELECT * FROM belanja WHERE nama LIKE '%$search%' OR merk LIKE '%$search%'");
    
        // Menyiapkan array untuk menyimpan hasil pencarian
        $cari = [];
    
        // Memindahkan data dari $sql ke array $cari
        while ($row = mysqli_fetch_assoc($sql)) {
            $cari[] = $row;
        }

        $belanja = $cari;
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
                
                <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                    <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-search-18" viewBox="0 0 40 40">
                        <path d="M30.776 27.146l-1.32-1.32-3.63 3.632 1.32 1.32 3.63-3.632zm1.368 1.368l6.035 6.035c.39.39.4 1.017.008 1.408l-2.23 2.23c-.387.387-1.015.387-1.41-.008l-6.035-6.035 3.63-3.63zm-8.11 1.392c-2.356 1.363-5.092 2.143-8.01 2.143C7.174 32.05 0 24.873 0 16.023S7.174 0 16.024 0c8.85 0 16.025 7.174 16.025 16.024 0 2.918-.78 5.654-2.144 8.01l8.96 8.962c1.175 1.174 1.184 3.07.008 4.246l-1.632 1.632c-1.17 1.17-3.067 1.173-4.247-.007l-8.96-8.96zm-8.01.54c7.965 0 14.422-6.457 14.422-14.422 0-7.965-6.457-14.422-14.422-14.422-7.965 0-14.422 6.457-14.422 14.422 0 7.965 6.457 14.422 14.422 14.422zm0-2.403c6.638 0 12.018-5.38 12.018-12.02 0-6.636-5.38-12.017-12.018-12.017-6.637 0-12.018 5.38-12.018 12.018 0 6.638 5.38 12.02 12.018 12.02zm0-1.402c5.863 0 10.616-4.752 10.616-10.616 0-5.863-4.753-10.616-10.616-10.616-5.863 0-10.616 4.753-10.616 10.616 0 5.864 4.753 10.617 10.616 10.617z" fill-rule="evenodd" />
                    </symbol>
                    <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-clear-5" viewBox="0 0 20 20">
                        <path d="M10 20c5.523 0 10-4.477 10-10S15.523 0 10 0 0 4.477 0 10s4.477 10 10 10zm1.35-10.123l3.567 3.568-1.225 1.226-3.57-3.568-3.567 3.57-1.226-1.227 3.568-3.568-3.57-3.57 1.227-1.224 3.568 3.568 3.57-3.567 1.224 1.225-3.568 3.57zM10 18.272c4.568 0 8.272-3.704 8.272-8.272S14.568 1.728 10 1.728 1.728 5.432 1.728 10 5.432 18.272 10 18.272z" fill-rule="evenodd" />
                    </symbol>
                </svg>

                <form action="" method="GET" novalidate="novalidate" onsubmit="return true;" class="searchbox sbx-custom">
                    <div role="search" class="sbx-custom__wrapper">
                        <input type="text" name="search" placeholder="Cari nama pembeli atau merk disini" autocomplete="off" required="required" class="sbx-custom__input">
                        <button type="submit" title="Submit your search query." class="sbx-custom__submit">
                            <svg role="img" aria-label="Search">
                                <use xlink:href="#sbx-icon-search-18"></use>
                            </svg>
                        </button>
                        <button type="reset" title="Clear the search query." class="sbx-custom__reset">
                            <svg role="img" aria-label="Reset">
                                <use xlink:href="#sbx-icon-clear-5"></use>
                            </svg>
                        </button>
                    </div>
                </form>

                <script type="text/javascript">
                    document.querySelector('.searchbox [type="reset"]').addEventListener('click', function() {
                        this.parentNode.querySelector('input').focus();
                    });
                </script>

                <br>
                <br>
                
                <table border=1 class="darkTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Foto Pembeli</th>
                            <th>Nama Pembeli</th>
                            <th>Alamat Tujuan</th>
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
                            <?php $direktori = "imgBelanja/" . $belanja["foto"]; ?>
                            <td><?php if ($belanja["foto"] == "") {
                                echo "foto belum ada";
                            } else {
                                echo "<img src='$direktori' alt='foto' width='70px' height='50px'>";
                            } ?></td>
                            <td><?= $belanja["nama"] ?></td>
                            <td><?= $belanja["alamat"] ?></td>
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
                <a href="belanja.php" class="btn btn-outline" id="konfirmasi-belanja">Belanja</a>
            </div>
        </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>
