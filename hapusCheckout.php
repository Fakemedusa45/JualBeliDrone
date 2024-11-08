<?php
session_start();

require "koneksi.php";

if ($_SESSION['role'] != 'user'){
    header('location: index.php');
    exit();
}

$user_id = $_SESSION['id_user'];
mysqli_query($conn, "DELETE FROM belanja WHERE id_user = '$user_id'");
echo "<script>alert('Checkout berhasil! Terimakasih telah berbelanja di rumahdrone');</script>";
echo "<script>document.location.href = 'index.php';</script>";
?>