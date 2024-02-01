<?php
	require_once __DIR__ . "/vendor/autoload.php";

	$collection_barang = (new MongoDB\Client)->gunawan->barang;
	$collection_customer = (new MongoDB\Client)->gunawan->customer;
	$collection_transaksi = (new MongoDB\Client)->gunawan->transaksi;
?>