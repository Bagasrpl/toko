<?php
require_once('koneksi.php');

// Inisialisasi variabel $hasil
$hasil = null;

// Periksa apakah data POST telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id_supplier'])) {
    // Menangkap data post
    $id_supplier = $_POST['id_supplier'];
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    // Simpan data barang
    $sql = 'UPDATE supplier SET nama_supplier=?, alamat=?, no_hp=? WHERE id_supplier=?';
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$nama_supplier, $alamat, $no_hp, $id_supplier]);

    // Redirect
    if ($stmt->rowCount() > 0) {
        echo '<script>alert("Berhasil Edit Data");window.location="supplier.php"</script>';
    } else {
        echo '<script>alert("Gagal Edit Data");window.location="supplier.php"</script>';
    }
}

// Untuk menampilkan data barang berdasarkan id_supplier
if (isset($_GET['id'])) {
    $id_supplier = $_GET['id'];
    $sql = "SELECT * FROM supplier WHERE id_supplier = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$id_supplier]);
    $hasil = $stmt->fetch();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Supplier - <?php echo isset($hasil['nama_supplier']) ? $hasil['nama_supplier'] : ''; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <br/>
    <h3>Edit Supplier - <?php echo isset($hasil['nama_supplier']) ? $hasil['nama_supplier'] : ''; ?></h3>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama_supplier">Nama Supplier:</label>
                    <input type="text" value="<?php echo isset($hasil['nama_supplier']) ? $hasil['nama_supplier'] : ''; ?>"
                           class="form-control" name="nama_supplier">
                </div>
                <div class="form-group">
                    <label for="alamat">alamat:</label>
                    <input type="text" value="<?php echo isset($hasil['alamat']) ? $hasil['alamat'] : ''; ?>"
                           class="form-control" name="alamat">
                </div>
                <div class="form-group">
                    <label for="no_hp">no_hp:</label>
                    <input type="number" value="<?php echo isset($hasil['no_hp']) ? $hasil['no_hp'] : ''; ?>"
                           class="form-control" name="no_hp">
                </div>
                <input type="hidden" value="<?php echo isset($hasil['id_supplier']) ? $hasil['id_supplier'] : ''; ?>" name="id_supplier">
                <button class="btn btn-primary btn-md" name="update"><i class="fa fa-edit"></i> Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
