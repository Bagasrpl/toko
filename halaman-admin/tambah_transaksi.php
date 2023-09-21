<?php
require_once('koneksi.php');

if (isset($_POST['create'])) {
    if ( !empty($_POST['id_customer']) && !empty($_POST['id_barang']) && !empty($_POST['harga']) && !empty($_POST['jumlah']) && !empty($_POST['tgl_transaksi']) && !empty($_POST['tgl_pengiriman'])) {
        // menangkap data post
		$id_customer = $_POST['id_customer'];
        $id_barang = $_POST['id_barang'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];
        $tgl_transaksi = $_POST['tgl_transaksi'];
        $tgl_pengiriman = $_POST['tgl_pengiriman'];
        

        // simpan data barang
        $sql = 'INSERT INTO transaksi (id_customer, id_barang, harga, jumlah,tgl_transaksi,tgl_pengiriman) VALUES (?, ?, ?, ?, ?, ?)';
        $row = $koneksi->prepare($sql);

        if ($row) {
            $result = $row->execute([$id_customer,$id_barang, $harga, $jumlah, $tgl_transaksi,$tgl_pengiriman]);

            if ($result) {
                echo '<script>alert("Berhasil Tambah Data");window.location="transaksi.php"</script>';
            } else {
                echo '<script>alert("Gagal Menambah Data");</script>';
            }
        } else {
            echo '<script>alert("Gagal Menambah Data");</script>';
        }
    } else {
        echo '<script>alert("Isi semua kolom!");</script>';
    }
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Tambah Barang</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="container">
			 <br/>
			 <h3>Tambah Transaksi</h3>
			 <br/>
			<div class="row">
				 <div class="col-lg-6">
					 <form action="" method="POST">
                     <div class="form-group">
							 <label>ID Customer</label>
							 <input type="text" value="" class="form-control" name="id_customer">
						 </div>
						 <div class="form-group">
							 <label>ID Barang</label>
							 <input type="text" value="" class="form-control" name="id_barang">
						 </div>
						 <div class="form-group">
							 <label>Harga</label>
							 <input type="text" value="" class="form-control" name="harga">
						 </div>
						 <div class="form-group">
							 <label>Jumlah</label>
							 <input type="text" value="" class="form-control" name="jumlah">
						 </div>
                         <div class="form-group">
							 <label>Tgl Transaksi</label>
							 <input type="date" value="" class="form-control" name="tgl_transaksi">
						 </div>
                         <div class="form-group">
							 <label>Tgl Pengiriman</label>
							 <input type="date" value="" class="form-control" name="tgl_pengiriman">
						 </div>
						
						 <button class="btn btn-primary btn-md" name="create"><i class="fa fa-plus"> </i> Create</button>
					 </form>
				  </div>
			</div>
		</div>
	</body>
</html>