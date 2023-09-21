<?php
require_once('koneksi.php');

if (isset($_POST['create'])) {
    if (!empty($_POST['nama_barang']) && !empty($_POST['harga']) && !empty($_POST['stok'])) {
        // menangkap data post
        $nama_barang = $_POST['nama_barang'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // simpan data barang
        $sql = 'INSERT INTO barang (nama_barang, harga, stok) VALUES (?, ?, ?)';
        $row = $koneksi->prepare($sql);

        if ($row) {
            $result = $row->execute([$nama_barang, $harga, $stok]);

            if ($result) {
                echo '<script>alert("Berhasil Tambah Data");window.location="tables.php"</script>';
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
			 <h3>Tambah Barang</h3>
			 <br/>
			<div class="row">
				 <div class="col-lg-6">
					 <form action="" method="POST">
						 <div class="form-group">
							 <label>Nama Barang</label>
							 <input type="text" value="" class="form-control" name="nama_barang">
						 </div>
						 <div class="form-group">
							 <label>Harga</label>
							 <input type="text" value="" class="form-control" name="harga">
						 </div>
						 <div class="form-group">
							 <label>Stok</label>
							 <input type="text" value="" class="form-control" name="stok">
						 </div>
						
						 <button class="btn btn-primary btn-md" name="create"><i class="fa fa-plus"> </i> Create</button>
					 </form>
				  </div>
			</div>
		</div>
	</body>
</html>