<?php
require "koneksi.php";

session_start();
if ($_SESSION['role'] != 'admin'){
    header('location: admin.php');
    exit();
}

$id_etalase = $_GET['id_etalase'];

$result = mysqli_query($conn, "SELECT * FROM etalase WHERE id_etalase = $id_etalase");

while ($row = mysqli_fetch_assoc($result)){
    $etalase[]= $row;
}

$etalase = $etalase[0];

if(isset($_POST["submit"])) {
    $merk = $_POST["merk"];
    $harga = $_POST["harga"];
    $desk = $_POST["desk"];
    $gambar = $_POST["gambar"];

    $oldImage = $_POST['oldimg'];

    if ($_FILES['gambar']['error'] === 4) { // cek apakah ada file yg diupload
      $file_name = $oldimg; // kalo tidak, akan mengambil gambar lama
    } else {
      $tmp_name = $_FILES['gambar']['tmp_name']; // mengambil path temporary file
      $file_name = $_FILES['gambar']['name']; // mengambil nama file

      // cek apakah yang diupload adalah file gambar
      $validExtensions = ['png', 'jpg', 'jpeg'];
      $fileExtension = explode('.', $file_name);
      $fileExtension = strtolower(end($fileExtension));
      if (!in_array($fileExtension, $validExtensions)) {
        echo "
                <script>
                    alert('Tolong upload file gambar!');
                </script>";
      } else {
        move_uploaded_file($tmp_name, 'imgEtalase/' . $file_name);
        unlink('imgEtalase/'.$oldImg); // menghapus gambar lama dari folder images
      }
    }

    $sql = "UPDATE etalase SET merk='$merk', harga='$harga', desk='$desk', gambar='$file_name' WHERE id_etalase='$id_etalase'";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "
        <script>
            alert('Berhasil Mengubah data Etalase!');
            document.location.href = 'admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Mengubah data Etalase!');
            document.location.href = 'etalase.php';
        </script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Etalase</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="icon" href="img/logo_dji.png">
    
    <link rel="stylesheet" href="style/style-belanja.css">
    <link rel="stylesheet" href="style/style.css">

    <style>
      *{
        font-family: lato,  sans-serif;

      }
    </style>
</head>
<body  style="background-image: url(img/background_dji_drone.jpg);">
<?php require("night.php") ?>  
  
<div class="utama-banget">

    <div class="utama">
        <form class="kartu-belanja" action="" method="post" enctype="multipart/form-data">
            <h2>EDIT ETALASE</h2>

            <br>

            <div class="form-control">
                <input
                    type="text"
                    id="merk"
                    name="merk" 
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="Merk Drone"
                    value="<?= $etalase["merk"] ?>"
                    required
                />
                <label for="merk" class="label-input">
                    Merk Drone
                </label>
            </div>

            <br>

            <div class="form-control">
                <input
                    type="number"
                    id="harga"
                    name="harga" 
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="Harga Drone"
                    value="<?= $etalase["harga"] ?>"
                    required
                />
                <label for="harga" class="label-input">
                    harga Drone
                </label>
            </div>

            
            <br>

            <div class="form-control">
                <textarea
                    name="desk"
                    id="desk"
                    cols="30"
                    rows="10"
                    placeholder="Jelaskan Drone disini..."
                    class="textarea textarea-info"
                ><?= $etalase["desk"] ?></textarea>
                <label for="message" class="label-input">
                    Jelaskan Drone disini...
                </label>
            </div>
            
            <br>
            
            <div class="input-field" style="border: 1px solid rgba(0, 0, 0, 0.6); border-radius: 9px; padding: 7px 10px; font-size:16px">
            <label for="gambar" class="label-field">Gambar</label>
            <input type="file" name="gambar" id="gambar">
            <br>
            <img src="imgEtalase/<?= $etalase['gambar'] ?>" alt="<?= $etalase['gambar'] ?>" width="80px" height="100px">
            </div>

            <br>
            
            <button type ="submit" name="submit" class="btn btn-outline">TAMBAH</button>
        </form>
    </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>