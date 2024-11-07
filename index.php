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

    <link rel="stylesheet" href="style/style.css">

    <style>
      *{
        font-family: lato,  sans-serif;

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
        <?php $i=1; $limit = 5; foreach($etalase as $etalase) : ?>
          <div class="drone-container" id ="drone-container">
            <h3>
              <?= $etalase["merk"] ?>
            </h3>
            <p>
              <?= $etalase["desk"] ?>
            </p>
            <p>
              <td><?= "Rp" . " " . $etalase["harga"] ?></td>
            </p>
        </div>
        <?php
            $i++;
            if ($i > $limit) {
                break;
            }
        ?>
        <?php endforeach ?>
      </div>
      <a href="etalase.php">Lihat selengkapnya...</a>
    </section>
    
    <footer class="drone" id="about">
    <h2>ABOUT US</h2>
    <div class="about-display">
    
      <!-- Section 1: Image, Who We Are -->
      <div class="about-section">
        <img src="img/Rifqi.jpg" alt="Foto Profil">
        <div class="text-content">
          <h2>Rifqi Ramadhan</h2>
          <p>Ada kah divisi selain media?</p>
        </div>
      </div>
      
      <!-- Section 2: What We Offer, Image -->
      <div class="about-section reverse">
        <img src="img/cecel.jpg" alt="Foto Profil">
        <div class="text-content">
          <h2>Chaelse Dengen</h2>
          <p>Explore a diverse range of drones, from beginner models to advanced professional options. Our platform makes it easy to buy or sell drones and accessories, complete with verified listings, user reviews, and a straightforward listing process for sellers.</p>
        </div>
      </div>

      <!-- Section 3: Image, Why Choose Us -->
      <div class="about-section">
        <img src="img/akmal.jpg" alt="Foto Profil">
        <div class="text-content">
          <h2>Akmal Alvian Pratama</h2>
          <p>Kalo ga perlengkapan ya humas...</p>
        </div>
      </div>

    </div>
  </footer>

  <script src="script/script.js"></script>
</body>
</html>