
<?php
   session_start();
?>

<!DOCTYPE html>
<html>
<head>
   <title>Basis Data Lanjut</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<style>

      .btn-primary {
      background-color: #28a745;
      border-color: #28a745;
}

.btn-primary:hover {
      background-color: #218838;
      border-color: #1e7e34;
}


      body {
      font-family: Arial, sans-serif;
      background-color: gray;
      padding-top: 50px;
   }

      .container {
         background-color: #ffffff;
         border-radius: 20px;
         box-shadow: red;
         padding: 20px;
      }

      .nav-link {
         border-radius: 0;
         margin-bottom: 5px;
      }

      .tab-content {
         max-width: 80%;
      }

      .table {
         margin-top: 20px;
      }

      .edit {
         padding: 8px 16px;
         margin-right: 5px;
      }

      /* Gaya khusus untuk h1 */
      .main-title {
         text-align: center;
         margin-top: 0;
         padding-top: 20px;
         border-top: 1px solid #ccc;
         color: #333;
      }

      /* Responsiveness */
      @media (max-width: 768px) {
         .container {
            padding: 10px;
         }
      }
   </style>
</head>
<body>
   <div class="container">
      <h1 class='text-center mt-3 border-bottom'>Penjualan Sepatu</h1>

      <?php
         if(isset($_SESSION['success'])){
            echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
         }
         require 'config.php';
         $penjualansepatu = $collection_barang->find([]);
         $customers = $collection_customer->find([]);
         $pipeline = [
            [
               '$lookup'=> [
               'from' => 'customer',
               'localField'=> 'customer_id',
               'foreignField'=> '_id',
               'as' => 'customer'
               ]
            ],
            [
               '$unwind'=> '$customer'
            ],
            [
            '$lookup'=> [
               'from' => 'barang',
               'localField'=> 'barang_id',
               'foreignField'=> '_id',
               'as'=> 'barang'
               ]
            ],
            [
               '$unwind'=> '$barang'
            ],
            [
            '$project'=> [
               '_id' => 1,
               'tgl_transaksi' => 1,
               'customer' => '$customer.nama_customer',
               'harga' => '$barang.harga_barang',
               'nama_barang' => '$barang.nama_barang',
               'quantity' => 1,
                  'total_transaksi' => ['$multiply' => ['$quantity', '$barang.harga_barang']]
            ]
            ]
         ];
         try {
            $transaksi = $collection_transaksi->aggregate($pipeline);
         } catch (\Exception $e) {
            echo "Error executing aggregation: " . $e->getMessage();
         }

      ?>
      <div class="d-flex align-items-start">
         <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <!-- <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button> -->
            <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true">Barang</button>
            <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Customer</button>
            <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Transaksi</button>
         </div>

      <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
         <a href="create.php" class="btn btn-primary">Tambah Data Barang</a>
         <table class="table table-bordered">
            <tr>
               <th class="text-center">No</th>
               <th class="text-center">id</th>
               <th class="text-center">Nama Barang</th>
               <th class="text-center">Harga</th>
               <th class="text-center">Stock</th>
               <th class="text-center">Action</th>
            </tr>
            <?php
                     $i = 1;
                     foreach($penjualansepatu as $penjualan) {   
                        echo "<tr>";
                        echo "<td class='text-center'>".$i."</td>";
                        echo "<td class='text-center'>".$penjualan->_id."</td>";
                        echo "<td class='text-center'>".$penjualan->nama_barang."</td>";
                        echo "<td class='text-center'>Rp ".number_format($penjualan->harga_barang,0,',','.')."</td>";
                        echo "<td class='text-center'>".$penjualan->stock_barang."</td>";
                        echo "<td>";
                        echo "<a href='edit.php?id=".$penjualan->_id."' class='edit btn btn-primary'>Edit</a>";
                        echo "<a href='delete.php?id=".$penjualan->_id."' class='btn btn-danger'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                        $i++;
                     };
                  
                  ?>
                  
               </table>
            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
         <a href="create_customer.php" class="btn btn-primary">Tambah Data Customer</a>
         <table class="table table-bordered">
            <tr>
               <th class="text-center">No</th>
               <th class="text-center">id</th>
               <th class="text-center">Nama Customer</th>
               <th class="text-center">Telepon</th>
               <th class="text-center">Alamat</th>
               <th class="text-center">Action</th>
            </tr>
            <?php
                        $i = 1;
                        foreach($customers as $customer) {                     
                           echo "<tr>";
                           echo "<td class='text-center'>".$i."</td>";
                           echo "<td class='text-center'>".$customer->_id."</td>";
                           echo "<td class='text-center'>".$customer->nama_customer."</td>";
                           echo "<td class='text-center'>".$customer->telepon."</td>";
                           echo "<td class='text-center'>".$customer->alamat."</td>";
                           echo "<td>";
                           echo "<a href='edit_customer.php?id=".$customer->_id."' class='edit btn btn-primary'>Edit</a>";
                           echo "<a href='delete_customer.php?id=".$customer->_id."' class='btn btn-danger'>Delete</a>";
                           echo "</td>";
                           echo "</tr>";
                           $i++;
                        };
                     
                     ?>
                     
                  </table>
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
         <a href="create_transaksi.php" class="btn btn-primary">Tambah Data Transaksi</a>
         <table class="table table-bordered">
            <tr>
               <th class="text-center">No</th>
               <th class="text-center">id transaksi</th>
               <th class="text-center">Nama Customer</th>
               <th class="text-center">Nama Barang</th>
               <th class="text-center">Harga</th>
               <th class="text-center">Quantity</th>
               <th class="text-center">Tanggal Transaksi</th>
               <th class="text-center">Total Bayar</th>
               <th class="text-center">Action</th>
            </tr>
            <?php
                           $i = 1;
                           foreach ($transaksi as $tr) {
                              echo "<tr>";
                              echo "<td class='text-center'>" . $i . "</td>";
                              echo "<td class='text-center'>" . $tr->_id . "</td>";
                              echo "<td class='text-center'>" . $tr->customer . "</td>";
                              echo "<td class='text-center'>" . $tr->nama_barang . "</td>";
                              echo "<td class='text-center'>" . $tr->harga . "</td>";
                              echo "<td class='text-center'>" . $tr->quantity . "</td>";
                              echo "<td class='text-center'>" . $tr->tgl_transaksi . "</td>";
                              echo "<td class='text-center'>" . $tr->total_transaksi . "</td>";
                              echo "<td>";
                              echo "<a href='edit_transaksi.php?id=" . $tr->_id . "' class='edit btn btn-primary'>Edit</a>";
                              echo "<a href='delete_transaksi.php?id=" . $tr->_id . "' class='btn btn-danger'>Delete</a>";
                              echo "</td>";
                              echo "</tr>";
                              $i++;
                           }
                        ?>
               </table>
            </div>
         </div>
      </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<?php
session_destroy();
?>