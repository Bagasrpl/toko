<?php
require_once('koneksi.php');

// Inisialisasi variabel $hasil
$hasil = null;

// Periksa apakah data POST telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id_customer'])) {
    // Menangkap data post
    $id_customer = $_POST['id_customer'];
    $nama_customer = $_POST['nama_customer'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    // Simpan data barang
    $sql = 'UPDATE customer SET nama_customer=?, alamat=?, no_hp=? WHERE id_customer=?';
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$nama_customer, $alamat, $no_hp, $id_customer]);

    // Redirect
    if ($stmt->rowCount() > 0) {
        echo '<script>alert("Berhasil Edit Data");window.location="customer.php"</script>';
    } else {
        echo '<script>alert("Gagal Edit Data");window.location="customer.php"</script>';
    }
}

// Untuk menampilkan data barang berdasarkan id_customer
if (isset($_GET['id'])) {
    $id_customer = $_GET['id'];
    $sql = "SELECT * FROM customer WHERE id_customer = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$id_customer]);
    $hasil = $stmt->fetch();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit customer - <?php echo isset($hasil['nama_customer']) ? $hasil['nama_customer'] : ''; ?></title>
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
    <h3>Edit customer - <?php echo isset($hasil['nama_customer']) ? $hasil['nama_customer'] : ''; ?></h3>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="nama_customer">Nama Customer:</label>
                    <input type="text" value="<?php echo isset($hasil['nama_customer']) ? $hasil['nama_customer'] : ''; ?>"
                           class="form-control" name="nama_customer">
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
                <input type="hidden" value="<?php echo isset($hasil['id_customer']) ? $hasil['id_customer'] : ''; ?>" name="id_customer">
                <button class="btn btn-primary btn-md" name="update"><i class="fa fa-edit"></i> Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
