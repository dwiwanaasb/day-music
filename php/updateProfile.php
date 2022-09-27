<?php
session_start();
require 'functions.php';
ob_start();

$sesi = $_SESSION["username"];
$result = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $sesi");
$data = mysqli_fetch_assoc($result);

if (isset($_POST["update"])) {
    if (updateProfile($_POST) > 0) {
        echo "<script type='text/javascript'>
                    alert('Profile Berhasil Di Update!');
                    document.location.href = 'daftarProduk.php';
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
    <title>DAY MUSIC | UPDATE PROFILE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_updateProfile.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-header">
        <h2>Update Profile</h2>
        <ul>
            <li>
                <?php
                $user_terlogin = $_SESSION["username"];
                $sql_user = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $user_terlogin");
                $data_user = mysqli_fetch_assoc($sql_user);
                ?>
                <a href="">Selamat Datang, <?php error_reporting(E_ALL);
                                            echo $data_user["username"]; ?> </a>
            </li>
        </ul>
    </div>

    <div class="container">
        <div class="content-form">
            <form action="" method="post">
                <input type="hidden" name="id_user" value="<?php echo $data["id_user"]; ?>">
                <div class="form">
                    <div class="input_container">
                        <label>Nama Lengkap</label>
                        <input type="text" class="input" name="nama_lengkap" value="<?php echo $data["nama_lengkap"]; ?>" required>
                    </div>
                    <div class="input_container">
                        <label>Username</label>
                        <input type="text" class="input" name="username" value="<?php echo $data["username"]; ?>" required>
                    </div>
                    <div class="input_container">
                        <label>Password</label>
                        <input type="password" class="input" name="password" required>
                    </div>
                    <div class="input_container">
                        <label>Confirm Password</label>
                        <input type="password" class="input" name="password2" required>
                    </div>
                    <div class="input_container">
                        <label>Jenis Kelamin</label>
                        <div class="custom_select">
                            <input type="radio" name="jenis_kelamin" value="Laki-Laki" required <?php if ($data["jenis_kelamin"] == "Laki-Laki") {
                                                                                                    echo "checked";
                                                                                                } ?>>Laki-Laki
                            <input type="radio" name="jenis_kelamin" value="Perempuan" required <?php if ($data["jenis_kelamin"] == "Perempuan") {
                                                                                                    echo "checked";
                                                                                                } ?>>Perempuan
                        </div>
                    </div>
                    <div class="input_container">
                        <label>Nomor Telepon</label>
                        <input type="text" class="input" name="no_telepon" value="<?php echo $data["no_telepon"]; ?>" required>
                    </div>
                    <div class="input_container">
                        <label>Alamat</label>
                        <textarea type="textarea" class="textarea" name="alamat" required><?php echo $data["alamat"]; ?></textarea>
                    </div>
                    <button type="submit" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>