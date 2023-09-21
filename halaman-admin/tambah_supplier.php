<?php
require_once('koneksi.php');

if (isset($_POST['create'])) {
    if (!empty($_POST['nama_supplier']) && !empty($_POST['alamat']) && !empty($_POST['no_hp'])) {
        // menangkap data post
        $nama_supplier = $_POST['nama_supplier'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];

        // simpan data barang
        $sql = 'INSERT INTO supplier (nama_supplier, alamat, no_hp) VALUES (?, ?, ?)';
        $row = $koneksi->prepare($sql);

        if ($row) {
            $result = $row->execute([$nama_supplier, $alamat, $no_hp]);

            if ($result) {
                echo '<script>alert("Berhasil Tambah Data");window.location="supplier.php"</script>';
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
			 <h3>Tambah Supplier</h3>
			 <br/>
			<div class="row">
				 <div class="col-lg-6">
					 <form action="" method="POST">
						 <div class="form-group">
							 <label>Nama Supplier</label>
							 <input type="text" value="" class="form-control" name="nama_supplier">
						 </div>
						 <div class="form-group">
							 <label>Alamat</label>
							 <input type="text" value="" class="form-control" name="alamat">
						 </div>
						 <div class="form-group">
							 <label>No_Hp</label>
							 <input type="text" value="" class="form-control" name="no_hp">
						 </div>
						
						 <button class="btn btn-primary btn-md" name="create"><i class="fa fa-plus"> </i> Create</button>
					 </form>
				  </div>
			</div>
		</div>
	</body>
</html>