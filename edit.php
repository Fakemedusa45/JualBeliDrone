<?php
require "koneksi.php";

$id_produk = $_GET['id_produk'];

$result = mysqli_query($conn, "SELECT * FROM belanja WHERE id_produk = $id_produk");

while ($row = mysqli_fetch_assoc($result)){
    $belanja[]= $row;
}

$belanja = $belanja[0];

if(isset($_POST["submit"])) {
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $merk = $_POST["merk"];
    $jumlah = $_POST["jumlah"];
    $paket = $_POST["paket"];

    $oldImg = $_POST['oldimg'];

    if ($_FILES['foto']['error'] === 4) { // cek apakah ada file yg diupload
      $file_name = $oldImg; // kalo tidak, akan mengambil gambar lama
    } else {
      $tmp_name = $_FILES['foto']['tmp_name']; // mengambil path temporary file
      $file_name = $_FILES['foto']['name']; // mengambil nama file

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
        move_uploaded_file($tmp_name, 'imgBelanja/' . $file_name);
        unlink('imgBelanja/'.$oldImg); // menghapus gambar lama dari folder images
      }
    }

    $sql = "UPDATE belanja SET nama='$nama', alamat='$alamat', merk='$merk', jumlah='$jumlah',  paket='$paket', foto='$file_name' WHERE id_produk='$id_produk'";

    $result = mysqli_query($conn, $sql);

    if($result){
        echo "
        <script>
            alert('Berhasil Mengubah data belanjaan di keranjang!');
            document.location.href = 'keranjang.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Gagal Mengubah data belanjaan di keranjang!');
            document.location.href = 'belanja.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
            <h2>PEMBELIAN</h2>

            <input type="hidden" name="oldimg" value="<?= $belanja['foto'] ?>">

            <br>

            <div class="form-control">
                <input
                    type="text"
                    id="nama"
                    name="nama" 
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="nama"
                    value="<?= $belanja["nama"] ?>"
                    required
                />
                <label for="nama" class="label-input">
                    Nama Pembeli
                </label>
            </div>

            <br>

            <div class="form-control">
                <input
                    type="text"
                    id="alamat"
                    name="alamat"
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="alamat"
                    value="<?= $belanja["alamat"] ?>"
                    required
                />
                <label for="alamat" class="label-input">
                    Alamat
                </label>
            </div>

            <br>

            <div class="form-control">
                <input
                    type="text"
                    id="merk"
                    name="merk"
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="merk"
                    value="<?= $belanja["merk"] ?>"
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
                    id="jumlah"
                    name="jumlah"
                    class="text-input input-info"
                    autocomplete="off"
                    placeholder="jumlah"
                    required
                    value="<?= $belanja["jumlah"] ?>"
                    min ="1"

                />
                <label for="jumlah" class="label-input">
                    Jumlah
                </label>
            </div>

            <br>

            <select required class="select select-neu"  id="paket" name="paket" >
                <option name="paket" value="Basic" <?php if($belanja["paket"] == "Basic") echo "selected" ?> selected>Basic</option>
                <option name="paket" value="Combo" <?php if($belanja["paket"] == "Combo") echo "selected" ?>>Combo</option>
                <option name="paket" value="Air Craft Only" <?php if($belanja["paket"] == "Air Craft Only") echo "selected" ?>>Air Craft Only</option>
            </select>
        
            <br>

            <div class="input-field" style="border: 1px solid rgba(0, 0, 0, 0.6); border-radius: 9px; padding: 7px 10px; font-size:16px">
            <label for="foto" class="label-field">Foto</label>
            <input type="file" name="foto" id="foto">
            <br>
            <img src="imgBelanja/<?= $belanja['foto'] ?>" alt="<?= $belanja['foto'] ?>" width="80px" height="100px">
            </div>

            <br>

            <button type ="submit" name="submit" class="btn btn-outline">KONFIRMASI</button>
        </form>
    </div>
    </div>
    <script src="script/script.js"></script>
</body>
</html>