<?php
include 'koneksi.php';
session_start();


//  login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
//  logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database perpustakaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        nav {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 20px auto;
        }

        a {
            display: block;
            text-decoration: none;
            color: #333;
            padding: 10px 0;
            transition: background-color 0.3s ease;
            border-bottom: 1px solid #eee;
        }

        a:hover {
            background-color: #f0f0f0;
        }

        a:last-child {
            margin-top: 20px;
            text-align: center;
            color: #f44336;
            font-weight: bold;
            border: none;
        }

        a:last-child:hover {
            background-color: transparent;
        }
    </style>
</head>
<body>
    <h1>Database perpustakaan</h1>
    <nav>
        <a href="buku.php">Data Buku</a><br>
        <a href="anggota.php">Data Anggota</a><br>
        <a href="kategori.php">Data Kategori Buku</a><br>
        <a href="peminjaman.php">Data peminjaman</a><br>
        <a href="pengembalian.php">Data pengembalian</a><br>
        <a href="?logout=true">Logout</a>
    </nav>
</body>
</html>
