<?php
session_start();

require "koneksi.php";

$sql = mysqli_query($conn, "SELECT * FROM etalase");

$etalase = [];

while ($row = mysqli_fetch_assoc($sql)) {
  $etalase[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DJI | Buy your Drone's here!</title>

  <link rel="icon" href="img/logo_dji.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link rel="stylesheet" href="style/style-belanja.css">
  <link rel="stylesheet" href="style/style.css">

  <style>
    * {
      font-family: lato, sans-serif;

    }
  </style>
</head>

<body>

  <?php require("navbar.php") ?>
  <?php require("night.php") ?>

  <main class="hero-section" id="hero" style="background-image: url(img/background_dji.jpg);">
    <h1 class="hero-title">
      DJI DRONE <br>
      STORE
    </h1>

    <p class="hero-description">
      Welcome to DJI STORE <br> Salam satu langit and keep fly safe
    </p>
  </main>
  <section class="drone" id="listdrone">
    <h2>REKOMENDASI DRONE</h2>
    <div class="drone-display">
      <?php $i = 1;
      $limit = 5;
      foreach ($etalase as $etalase) : ?>
        <div class="drone-container" id="drone-container">
          <h3>
            <?= $etalase["merk"] ?>
          </h3>
          <img src="imgEtalase/<?= $etalase['gambar'] ?>" alt="<?= $etalase['merk'] ?>" class="drone-image">
          <p>
            <?= "Rp " . number_format($etalase["harga"], 0, ',', '.') ?>
          </p>
          <p>
            <?= $etalase["desk"] ?>
          </p>
          <?php 
          if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
              echo '
              <form action="keranjang.php" method="post">
                  <input type="hidden" name="id_produk" value="' . $etalase['id_etalase'] . '">
                  <input type="hidden" name="jumlah" value="1">
                  <button type="submit" class="btn btn-outline">Tambahkan ke Keranjang</button>
              </form>';
          }
          ?>
        </div>
        <?php
        $i++;
        if ($i > $limit) {
          break;
        }
        ?>
      <?php endforeach ?>
    </div>
  </section>

  <div class="etalase">
    <a href="etalase.php">Lihat selengkapnya...</a>
  </div>

  <footer class="drone" id="about">
    <h2>ABOUT US</h2>
    <div class="about-display">

      <div class="about-section">
        <img src="img/Rifqi.jpg" alt="Foto Profil">
        <div class="text-content">
          <h2>Rifqi Ramadhan</h2>
          <p>Ada kah divisi selain media? <br><br> follow ig ku pale <a href="https://www.instagram.com/rifram._?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">@rifram._</a></p>
        </div>
      </div>

      <div class="about-section reverse">
        <img src="img/cecel.jpg" alt="Foto Profil">
        <div class="text-content">
          <h2>Chaelse Dengen</h2>
          <p>Tell the truth, even though it's bitter</p>
        </div>
      </div>

      <div class="about-section">
        <img src="img/akmal.jpg" alt="Foto Profil">
        <div class="text-content">
          <h2>Akmal Alvian Pratama</h2>
          <p><i>JANGAN BIKIN MALU DIVISI PERDEK</i><br>--BANG HUDA</p>
        </div>
      </div>

    </div>
  </footer>

  <script src="script/script.js"></script>
</body>

</html>