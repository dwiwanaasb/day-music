<?php
session_start();
require 'functions.php';

$_SESSION["admin"] = "admin";
$id_produk = $_GET["id_produk"];
$result = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id_produk");
$data = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
    if (updateProduk($_POST) > 0) {
        echo "<script type='text/javascript'>
                    alert('Data Produk Berhasil Di Update!');
                    document.location.href = 'adminProduk.php';
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DAY MUSIC | UPDATE ORDER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_updateProduk.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-header">
        <h2>Update Produk</h2>
        <ul>
            <li>
                <?php
                $user_terlogin = $_SESSION["username"];
                $sql_user = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $user_terlogin");
                $data_user = mysqli_fetch_assoc($sql_user);
                ?>
                <a href="">Selamat Datang, <?php error_reporting(error_reporting() & ~E_NOTICE);
                                            echo $data_user["username"]; ?> </a>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="content-form">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_produk" value="<?php echo $data["id_produk"]; ?>">
                <input type="hidden" name="gambarLama" value="<?php echo $data["gambar"]; ?>">
                <div class="form">
                    <div class="input_container">
                        <label>Nama Produk</label>
                        <input type="text" class="input" name="nama_produk" value="<?php echo $data["nama_produk"]; ?>" required>
                    </div>
                    <div class="input_container">
                        <label>Stok</label>
                        <input type="number" class="input" name="stok" value="<?php echo $data["stok"]; ?>" required>
                    </div>
                    <div class="input_container">
                        <label>Harga</label>
                        <div class="harga"><label>Rp</label></div>
                        <input type="number" class="input" name="harga" value="<?php echo $data["harga"]; ?>" required>
                    </div>
                    <div class="input_container">
                        <label>Gambar</label>
                        <img src="../img/<?php echo $data["gambar"]; ?>">
                    </div>
                    <div class="input_container">
                        <label></label>
                        <input type="file" class="input-gambar" name="gambar">
                    </div>
                    <button type="submit" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>