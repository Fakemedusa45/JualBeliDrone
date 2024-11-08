<?php 
    session_start();
    if ($_SESSION['role'] != 'user'){
        header('location: index.php');
        exit();
    }

    require "koneksi.php"; 

    $user_id = $_SESSION['id_user'];
  
    $email = $_SESSION['email']; 
    $query = "SELECT namaLengkap FROM user WHERE email = '$email'"; 
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        $user['namaLengkap'] = 'Nama Tidak Ditemukan';
    }

    // Ambil total harga dari sesi
    $total_harga = isset($_SESSION['total_harga']) ? $_SESSION['total_harga'] : 0; // Mengambil total harga dari sesi

    // Proses penghapusan data jika form di-submit
    if (isset($_POST['delete'])) {
        $user_id = $_POST['user_id']; // Ambil user_id dari form
        mysqli_query($conn, "DELETE FROM belanja WHERE id_user = '$user_id'");
        echo "<script>alert('Checkout berhasil! Terimakasih telah berbelanja di rumahdrone');</script>";
        echo "<script>document.location.href = 'index.php';</script>";
    }

    if (isset($_POST['submit'])) {
        // Tampilkan konfirmasi dan redirect menggunakan JavaScript
        echo "
        <script>
            const userConfirmation = confirm('Apakah anda yakin ingin checkout?');
            if (userConfirmation) {
                document.getElementById('deleteForm').submit();
                alert('Checkout berhasil! Terimakasih telah berbelanja di rumah drone');
                document.location.href = 'index.php';
            } else {
                alert('Checkout dibatalkan.');
                document.location.href = 'keranjang.php'; 
            }
        </script>";
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>

    <link rel="icon" href="img/logo_dji.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/checkout.css">

    <style>
      *{
        font-family: lato,  sans-serif;

      }
    </style>
</head>

<body>
<?php require("navbar.php") ?>

    <div class="container">

        <!-- Form untuk menghapus data -->
        <form id="deleteForm" action="" method="post" style="display: none;">
            <input type="hidden" name="delete" value="1">
            <input type="hidden" name="user_id" value="<?= $user['id_user']; ?>"> <!-- Pastikan $user['id_user'] didefinisikan -->
        </form>

        <form action="" method="post">
            <div class="row">
                <div class="column">
                    <h3 class="title">Data Diri</h3>
                    <div class="input-box">
                        <span>Nama Lengkap :</span>
                        <input type="text" value="<?php echo htmlspecialchars($user['namaLengkap']); ?>" readonly>
                    </div>
                    <div class="input-box">
                        <span>Email :</span>
                        <input type="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                    </div>
                    <div class="input-box">
                        <span>Alamat :</span>
                        <input type="text" placeholder="Masukan alamat anda" required>
                    </div>
                    <div class="input-box">
                        <span>Kota :</span>
                        <input type="text" placeholder="masukan kota anda" required>
                    </div>

                    <div class="flex">
                        <div class="input-box">
                            <span>Negara :</span>
                            <input type="text" placeholder="" required>
                        </div>
                        <div class="input-box">
                            <span>Total Harga :</span>
                            <input type="text" value="<?= "Rp " . number_format($total_harga, 0, ",", ".") ?>" readonly>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <h3 class="title">Pembayaran</h3>
                    <div class="input-box">
                        <span>Kartu yang diterima :</span>
                        <img src="img/imgcards.png" alt="">
                    </div>
                    <div class="input-box">
                        <span>Nama pada kartu :</span>
                        <input type="text" placeholder="" required>
                    </div>
                    <div class="input-box">
                        <span>Nomor kartu kredit :</span>
                        <input type="number" placeholder="1111 2222 3333 4444" required>
                    </div>
                    <div class="input-box">
                        <span>Exp. Month :</span>
                        <input type="text" placeholder="" required>
                    </div>
                
                    <div class="flex">
                        <div class="input-box">
                            <span>Exp. Year :</span>
                            <input type="number" placeholder="2027" required>
                        </div>
                        <div class="input-box">
                            <span>CVV :</span>
                            <input type="number" placeholder="123" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" class="btn">Checkout</button>
        </form>
    </div>

</body>

</html>
