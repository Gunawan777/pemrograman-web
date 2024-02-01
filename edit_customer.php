<?php
   session_start();

   require 'config.php';

   if (isset($_GET['id'])) {
      $customer = $collection_customer->findOne(['_id' => $_GET['id']]);
   }

   if(isset($_POST['submit'])) {
      $collection_customer->updateOne(
         ['_id' => $_GET['id']],
         ['$set' => [
            'nama_customer' => $_POST['nama_customer'],
            'telepon' => $_POST['telepon'],
            'alamat' => $_POST['alamat']
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
      <h1>Edit Data Barang</h1>
      <a href="index.php" class="btn btn-primary" >Kembali</a>

      <form method="POST">
         <div class="form-group">
            <strong>Nama Customer</strong>
            <input type="text" name="nama_customer" value="<?php echo $customer->nama_customer; ?>" required="" class="form-control" placeholder="Masukkan Nama Customer">
         </div>
         <div class="form-group">
            <strong>Telepon</strong>
            <input type="text" name="telepon" value="<?php echo $customer->telepon; ?>" required="" class="form-control" placeholder="Masukkan Telepon">
         </div>
         <div class="form-group">
            <strong>Alamat</strong>
            <input type="text" name="alamat" value="<?php echo $customer->alamat; ?>" required="" class="form-control" placeholder="Masukkan Alamat">
         </div>
         <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
         </div>
      </form>
   </div>
</body>
</html>