<?php
$conn = mysqli_connect("localhost", "root", "", "day-music");

function registrasi($data)
{
    global $conn;

    $fullname = $data["fullname"];
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $jenis_kelamin = $data["jenis_kelamin"];
    $number = $data["number"];
    $address = $data["address"];

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                        alert('Username Sudah Terdaftar !');
                    </script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>
                        alert('Konfirmasi Password tidak Sesuai !');
                    </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users VALUES(
                '',
                '$fullname',
                '$username',
                '$password',
                '$jenis_kelamin',
                '$number',
                '$address')");
    return mysqli_affected_rows($conn);
}

function format_rupiah($nilai)
{
    return number_format($nilai, 0, ',', '.');
}

function upload()
{
    $fileName = $_FILES['gambar']['name'];
    $fileSize = $_FILES['gambar']['size'];
    $fileError = $_FILES['gambar']['error'];
    $fileTmp = $_FILES['gambar']['tmp_name'];

    if ($fileError === 4) {
        echo "</script> 
                alert('Silahkan Masukkan Gambar'); 
            </script>";
        return false;
    }

    $fileExtension = ['jpg', 'jpeg', 'png'];
    $extension = explode('.', $fileName);
    $extension = strtolower(end($extension));

    if (!in_array($extension, $fileExtension)) {
        echo "</script> 
                alert('File Terdeteksi Bukan Gambar'); 
            </script>";
        return false;
    }

    if ($fileSize > 5000000) {
        echo "</script> 
                alert('Ukuran Gambar Terlalu Besar'); 
            </script>";
        return false;
    }

    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $extension;

    move_uploaded_file($fileTmp, '../img/' . $newFileName);
    return $newFileName;
}

function order($data)
{
    global $conn;
    $user_terlogin = $_SESSION["username"];
    $sql_user = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $user_terlogin");
    $data_user = mysqli_fetch_assoc($sql_user);

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $nama_user = $data_user["username"];
    $nama_produk = $data["nama_produk"];
    $jumlah_beli = $data["jumlah_beli"];
    $tanggal = date("Y-m-d  h:i:s a");
    $harga = $data["harga"];

    mysqli_query($conn, "INSERT INTO keranjang VALUES(
                '',
                '$nama_produk',
                '$jumlah_beli',
                '$harga')");

    mysqli_query($conn, "INSERT INTO riwayatKeranjang VALUES(
                '',
                '$nama_user',
                '$nama_produk',
                '$jumlah_beli',
                '$tanggal',
                '$harga')");
    return mysqli_affected_rows($conn);
}

function pembayaran($data)
{
    global $conn;
    $user_terlogin = $_SESSION["username"];
    $sql_user = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $user_terlogin");
    $data_user = mysqli_fetch_assoc($sql_user);

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $nama_user = $data_user["username"];
    $metode_pembayaran = $data["metode_pembayaran"];
    $tanggal = date("Y-m-d  h:i:s a");
    $total_harga = $data["total_harga"];
    $nominal_pembayaran = $data["nominal_pembayaran"];
    $jumlah_kembalian = $data["jumlah_kembalian"];

    mysqli_query($conn, "INSERT INTO pembayaran VALUES(
                '',
                '$nama_user',
                '$metode_pembayaran',
                '$tanggal',
                '$total_harga',
                '$nominal_pembayaran',
                '$jumlah_kembalian')");
    return mysqli_affected_rows($conn);
}

function tambahProduk($data)
{
    global $conn;
    $nama_produk = $data["nama_produk"];
    $stok = $data["stok"];
    $harga = $data["harga"];

    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    mysqli_query($conn, "INSERT INTO produk VALUES(
                        '', 
                        '$nama_produk',
                        '$stok',
                        '$harga',
                        '$gambar')");
    return mysqli_affected_rows($conn);
}

function hapusUser($id_user)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id_user");

    return mysqli_affected_rows($conn);
}

function hapusOrder($id_cart)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM keranjang WHERE id_cart = $id_cart");

    return mysqli_affected_rows($conn);
}

function hapusPerItem($id_cart)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM keranjang WHERE id_cart = $id_cart");

    return mysqli_affected_rows($conn);
}

function adminHapusProduk($id_produk)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM produk WHERE id_produk = $id_produk");

    return mysqli_affected_rows($conn);
}

function adminHapusPerItem($id_cart)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM riwayatKeranjang WHERE id_cart = $id_cart");

    return mysqli_affected_rows($conn);
}

function adminHapusBayar($id_bayar)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pembayaran WHERE id_bayar = $id_bayar");

    return mysqli_affected_rows($conn);
}

function adminHapusUser($id_user)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id_user");

    return mysqli_affected_rows($conn);
}

function hapusPembayaran($order_id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pembayaran WHERE order_id = $order_id");

    return mysqli_affected_rows($conn);
}

function updateProduk($data)
{
    global $conn;

    $id_produk = $data["id_produk"];
    $nama_produk = $data["nama_produk"];
    $stok = $data["stok"];
    $harga = $data["harga"];
    $gambarLama = $data["gambarLama"];

    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    if (!$gambar) {
        return false;
    }

    mysqli_query($conn, "UPDATE produk SET 
                        nama_produk = '$nama_produk',
                        stok = '$stok',
                        harga = '$harga',
                        gambar = '$gambar'
                        WHERE id_produk = $id_produk");
    return mysqli_affected_rows($conn);
}

function updatePembayaran($data)
{
    global $conn;

    $order_id = $data["order_id"];
    $metode_pembayaran = $data["metode_pembayaran"];
    $total_harga = $data["total_harga"];
    $nominal_pembayaran = $data["nominal_pembayaran"];
    $jumlah_kembalian = $data["jumlah_kembalian"];

    mysqli_query($conn, "UPDATE pembayaran SET 
                        metode_pembayaran = '$metode_pembayaran', 
                        total_harga = '$total_harga',
                        nominal_pembayaran = '$nominal_pembayaran',
                        jumlah_kembalian = '$jumlah_kembalian' 
                        WHERE order_id = $order_id");
    return mysqli_affected_rows($conn);
}

function updateProfile($data)
{
    global $conn;

    $sesi = $_SESSION["username"];
    $nama_lengkap = $data["nama_lengkap"];
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $jenis_kelamin = $data["jenis_kelamin"];
    $no_telepon = $data["no_telepon"];
    $alamat = $data["alamat"];

    if ($password !== $password2) {
        echo "<>
                        alert('Konfirmasi Password tidak Sesuai !');
                    </>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "UPDATE users SET 
                        nama_lengkap = '$nama_lengkap', 
                        username = '$username',
                        password = '$password',
                        jenis_kelamin = '$jenis_kelamin',
                        no_telepon = '$no_telepon',
                        alamat = '$alamat'
                        WHERE id_user = $sesi");
    return mysqli_affected_rows($conn);
}
