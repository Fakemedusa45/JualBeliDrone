<?php
    require "koneksi.php";

    $id_produk = $_GET["id_produk"];

    $result = mysqli_query($conn, "DELETE FROM etalase WHERE id_produk = $id_produk");

    if ($result) {
        echo "
        <script>
        alert('Berhasil Menghapus Data Etalase!');
        document.location.href = 'index.php';
        </script>
        ";
    }
?>