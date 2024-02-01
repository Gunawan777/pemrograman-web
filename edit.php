<!DOCTYPE html>
<html>
<head>
   <title>Edit Data Barang - Penjualan Sepatu</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f9f9f9;
         padding-top: 50px;
      }

      .container {
         max-width: 500px;
         margin: auto;
         background-color: #ffffff;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         padding: 20px;
         margin-top: 20px;
      }

      h1 {
         text-align: center;
         margin-bottom: 30px;
         color: #333;
      }

      form {
         margin-bottom: 0;
      }

      .form-group {
         margin-bottom: 20px;
      }

      .btn-primary {
         margin-right: 10px;
      }

      .btn-success {
         width: 100%;
      }
   </style>
</head>
<body>
   <div class="container">
      <h1>Edit Data Barang</h1>
      <a href="index.php" class="btn btn-primary">Kembali</a>

      <?php
      session_start();

      require 'config.php';

      if (isset($_GET['id'])) {
         $penjualansepatu = $collection_barang->findOne(['_id' => $_GET['id']]);
      }

      if(isset($_POST['submit'])) {
         $collection_barang->updateOne(
            ['_id' => $_GET['id']],
            ['$set' => [
               'nama_barang' => $_POST['nama_barang'],
               'harga_barang' => intval($_POST['harga_barang']),
               'stock_barang' => intval($_POST['stock_barang'])
               ]
            ]
         );
         $_SESSION['success'] = "Data Berhasil Diupdate";
         header("Location: index.php");
      }
      ?>

      <form method="POST">
         <div class="form-group">
            <label for="nama_barang">Nama Sepatu</label>
            <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $penjualansepatu->nama_barang; ?>" required="" class="form-control" placeholder="Masukkan Nama Sepatu">
         </div>
         <div class="form-group">
            <label for="harga_barang">Harga Barang</label>
            <input type="number" id="harga_barang" name="harga_barang" value="<?php echo $penjualansepatu->harga_barang; ?>" required="" class="form-control" placeholder="Masukkan Harga Barang">
         </div>
         <div class="form-group">
            <label for="stock_barang">Stock Barang</label>
            <input type="number" id="stock_barang" name="stock_barang" value="<?php echo $penjualansepatu->stock_barang; ?>" required="" class="form-control" placeholder="Masukkan Stock Barang">
         </div>
         <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
         </div>
      </form>
   </div>
</body>
</html>
