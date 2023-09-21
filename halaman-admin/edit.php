<?php
require_once('koneksi.php');

// Inisialisasi variabel $hasil
$hasil = null;

// Periksa apakah data POST telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id_barang'])) {
    // Menangkap data post
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Simpan data barang
    $sql = 'UPDATE barang SET nama_barang=?, harga=?, stok=? WHERE id_barang=?';
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$nama_barang, $harga, $stok, $id_barang]);

    // Redirect
    if ($stmt->rowCount() > 0) {
        echo '<script>alert("Berhasil Edit Data");window.location="tables.php"</script>';
    } else {
        echo '<script>alert("Gagal Edit Data");window.location="tables.php"</script>';
    }
}

// Untuk menampilkan data barang berdasarkan id_barang
if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];
    $sql = "SELECT * FROM barang WHERE id_barang = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$id_barang]);
    $hasil = $stmt->fetch();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Barang - <?php echo isset($hasil['nama_barang']) ? $hasil['nama_barang'] : ''; ?></title>
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
    <h3>Edit Barang - <?php echo isset($hasil['nama_barang']) ? $hasil['nama_barang'] : ''; ?></h3>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama_barang">Nama Barang:</label>
                    <input type="text" value="<?php echo isset($hasil['nama_barang']) ? $hasil['nama_barang'] : ''; ?>"
                           class="form-control" name="nama_barang">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" value="<?php echo isset($hasil['harga']) ? $hasil['harga'] : ''; ?>"
                           class="form-control" name="harga">
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="text" value="<?php echo isset($hasil['stok']) ? $hasil['stok'] : ''; ?>"
                           class="form-control" name="stok">
                </div>
                <input type="hidden" value="<?php echo isset($hasil['id_barang']) ? $hasil['id_barang'] : ''; ?>" name="id_barang">
                <button class="btn btn-primary btn-md" name="update"><i class="fa fa-edit"></i> Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
