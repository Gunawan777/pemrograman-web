<?php
   session_start();

   require 'config.php';

   if (isset($_GET['id'])) {
      $transaksi = $collection_transaksi->findOne(['_id' => $_GET['id']]);
   }

   if(isset($_POST['submit'])) {
      $collection_transaksi->updateOne(
         ['_id' => $_GET['id']],
         ['$set' => [
            'customer_id' => $_POST['customer_id'],
            'barang_id' => $_POST['barang_id'],
            'quantity' => intval($_POST['quantity']),
            'tgl_transaksi' => $_POST['tgl_transaksi']
            ]
         ]
      );
      $_SESSION['success'] = "Data Berhasil Diupdate";
      header("Location: index.php");
   }
?>


<!DOCTYPE html>
<html>
<head>
   <title>PHP & MongoDB - CRUD</title>
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
      <h1>Edit Data Transaksi</h1>
      <a href="index.php" class="btn btn-primary" >Kembali</a>

      <form method="POST">
         <div class="form-group">
            <strong>Customer id</strong>
            <input type="text" name="customer_id" value="<?php echo $transaksi->customer_id; ?>" required="" class="form-control" placeholder="Masukkan Customer id">
         </div>
         <div class="form-group">
            <strong>Sepatu id</strong>
            <input type="text" name="barang_id" value="<?php echo $transaksi->barang_id; ?>" required="" class="form-control" placeholder="Masukkan Sepatu id">
         </div>
         <div class="form-group">
            <strong>Quantity</strong>
            <input type="text" name="quantity" value="<?php echo $transaksi->quantity; ?>" required="" class="form-control" placeholder="Masukkan Quantity">
         </div>
         <div class="form-group">
            <strong>Tanggal transaksi</strong>
            <input type="text" name="tgl_transaksi" value="<?php echo $transaksi->tgl_transaksi; ?>" required="" class="form-control" placeholder="Masukkan Tanggal Transkasi">
         </div>
         <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
         </div>
      </form>
   </div>
</body>
</html>