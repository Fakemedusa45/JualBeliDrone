<?php 
    session_start();
    if ($_SESSION['role'] != 'user'){
        header('location: index.php');
        exit();
    }

    require "koneksi.php"; 
  
    $email = $_SESSION['email']; 
    $query = "SELECT namaLengkap FROM user WHERE email = '$email'"; 
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        $user['namaLengkap'] = 'Nama Tidak Ditemukan';
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

    <div class="container">
        <form action="">
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
                        <input type="text" placeholder="Masukan alamat anda">
                    </div>
                    <div class="input-box">
                        <span>Kota :</span>
                        <input type="text" placeholder="masukan kota anda">
                    </div>

                    <div class="flex">
                        <div class="input-box">
                            <span>Negara :</span>
                            <input type="text" placeholder="">
                        </div>
                        <div class="input-box">
                            <span>Jumlah :</span>
                            <input type="number" placeholder="" min="1">
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
                        <input type="text" placeholder="">
                    </div>
                    <div class="input-box">
                        <span>Nomor kartu kredit :</span>
                        <input type="number" placeholder="1111 2222 3333 4444">
                    </div>
                    <div class="input-box">
                        <span>Exp. Month :</span>
                        <input type="text" placeholder="">
                    </div>
                
                    <div class="flex">
                        <div class="input-box">
                            <span>Exp. Year :</span>
                            <input type="number" placeholder="2025">
                        </div>
                        <div class="input-box">
                            <span>CVV :</span>
                            <input type="number" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn">Checkout</button>
        </form>
    </div>

</body>

</html>