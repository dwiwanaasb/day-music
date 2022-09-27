<?php
require 'functions.php';

$result = mysqli_query($conn, "DELETE FROM keranjang");
header("location: pembayaran.php");
