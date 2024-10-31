<?php
session_start();
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
      <h2>DJI DRONE</h2>
      <div class="drone-display">
          <div class="drone-container" id ="drone-container">

              <h3><a href="https://www.dji.com/id/mini-4-pro?site=brandsite&from=homepage">
                DJI MINI 4 PRO
              </a></h3>
              <ul>
                  <li>Under 249g</li>
                  <li>4K/60fps HDR</li>
                  <li>True Vertical Shooting</li>
              </ul>
          </div>
          <div class="drone-container" id="drone-container">
              <h3><a href="https://www.dji.com/id/neo?site=brandsite&from=homepage">
                DJI NEO
              </a></h3>
              <ul>
                  <li>AI Subject Tracking</li>
                  <li>Multiple Control Options</li>
                  <li>Full-Coverage Propeller Guards</li>
              </ul>
          </div>
          <div class="drone-container" id="drone-container">
              <h3><a href="https://www.dji.com/id/mavic-3-pro">
                DJI MAVIC 3 PRO
              </a></h3>
              <ul>
                  <li>Dual Tele Camera</li>
                  <li>15 KM HD Video Transmission</li>
                  <li>43 Min Max Flight Time</li>
              </ul>
          </div>
          <div class="drone-container" id="drone-container">
              <h3><a href="https://www.dji.com/id/inspire-3">
                DJI INSPIRE 3
              </a></h3>
              <ul>
                  <li>3D Dolly</li>
                  <li>Repeatable Routes</li>
                  <li>Ultra-Wide Night-Vision FPV Camera</li>
              </ul>
          </div>
      </div>
  </section>
    
  <footer class="puter" id="about">
    <div class="tentang">
      <a href="https://www.instagram.com/rifram._/">
        Instagram
      </a>
      <a href="https://github.com/Fakemedusa45">
        Github
      </a>
    </div>
    <div class="saya">
      Halo sobat semuanya! Perkenalkan nama saya Rifqi Ramadhan selaku yang membuat website ini,saya dari kelas A'23 dengan nim 2309106007.
    </div>
  </footer>

  <script src="script/script.js"></script>
</body>
</html>