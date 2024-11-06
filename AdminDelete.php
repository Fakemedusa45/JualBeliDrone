<?php
    require "koneksi.php";

    $id_etalase = $_GET["id_etalase"];

    $result = mysqli_query($conn, "DELETE FROM etalase WHERE id_etalase = $id_etalase");

    if ($result) {
        echo "
        <script>
        alert('Berhasil Menghapus Data Etalase!');
        document.location.href = 'admin.php';
        </script>
        ";
    }
?>