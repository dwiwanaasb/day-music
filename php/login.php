<?php
require 'functions.php';
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $cek = mysqli_num_rows($result);
        if (password_verify($password, $row["password"])) {
            if ($row['username'] == "admin") {
                session_start();
                $_SESSION["admin"] = $row["id_user"];
                header("location: adminOrder.php");
            } else {
                session_start();
                $_SESSION["username"] = $row["id_user"];
                header("location: daftarProduk.php");
            }

            exit;
        }
    } else {
        echo "<script> 
				alert('Username Atau Password Anda Salah!')
				</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DAY MUSIC | LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style_login.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="login-container">
        <div class="login-content">
            <div class="login-header">
                <div class="logo">
                    <img src="../img/avatar.png" class="avatar">
                </div>
                <h2>LOGIN</h2>
            </div>
            <form action="" method="post" class="login-form">
                <div class="input-container">
                    <i class="fa fa-user"></i>
                    <input type="text" class="input" name="username" placeholder="username" required>
                </div>
                <div class="input-container">
                    <i class="fa fa-lock"></i>
                    <input type="password" class="input" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" value="Login">Login</button>
            </form>
            <div class="registration">
                <a href="registration.php">klik disini untuk daftar</a>
            </div>
        </div>
    </div>
</body>

</html>