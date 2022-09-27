<?php
require 'functions.php';
if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                    alert('User Baru Berhasil Ditambahkan !');
                document.location.href = 'login.php';
                </script>";
    } else {
        echo "<script>
                    alert('User Baru Gagal Ditambahkan!');
                document.location.href = 'login.php';
                </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DAY MUSIC | LOGIN</title>
    <link rel="stylesheet" type="text/css" href="../css/style_registration.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="header">
                <h2>REGISTRATION FORM</h2>
            </div>
            <form action="" method="post">
                <div class="form">
                    <div class="input_container">
                        <label>Nama Lengkap</label>
                        <input type="text" class="input" name="fullname" required>
                    </div>
                    <div class="input_container">
                        <label>Username</label>
                        <input type="text" class="input" name="username" required>
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
                            <input type="radio" name="jenis_kelamin" value="Laki-Laki" required>Laki-Laki
                            <input type="radio" name="jenis_kelamin" value="Perempuan" required>Perempuan
                        </div>
                    </div>
                    <div class="input_container">
                        <label>Nomor Telepon</label>
                        <input type="text" class="input" name="number" required>
                    </div>
                    <div class="input_container">
                        <label>Alamat</label>
                        <textarea type="textarea" class="textarea" name="address" required></textarea>
                    </div>
                    <div class="input_container">
                        <button type="submit" name="register" value="Register">Register</button>
                    </div>
                </div>
            </form>
            <div class="login">
                <a href="login.php">klik disini untuk kembali ke login</a>
            </div>
        </div>
    </div>
</body>

</html>