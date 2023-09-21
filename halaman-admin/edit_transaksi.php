<?php
require_once('koneksi.php');

// Inisialisasi variabel $hasil
$hasil = null;

// Periksa apakah data POST telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id_transaksi'])) {
    // Menangkap data post
    $id_transaksi  = $_POST['id_transaksi'];
    $id_customer = $_POST['id_customer'];
    $id_barang = $_POST['id_barang'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $tgl_transaksi = $_POST['tgl_transaksi'];
    $tgl_pengiriman = $_POST['tgl_pengiriman'];

    // Simpan data barang
    $sql = 'UPDATE transaksi SET id_customer=?, id_barang=?, harga=?,  jumlah=?,  tgl_transaksi=?,  tgl_pengiriman=? WHERE id_transaksi=?';
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([ $id_customer, $id_barang, $harga, $jumlah, $tgl_transaksi, $tgl_pengiriman, $id_transaksi]);

    // Redirect
    if ($stmt->rowCount() > 0) {
        echo '<script>alert("Berhasil Edit Data");window.location="transaksi.php"</script>';
    } else {
        echo '<script>alert("Gagal Edit Data");window.location="transaksi.php"</script>';
    }
}

// Untuk menampilkan data barang berdasarkan id_supplier
if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    $sql = "SELECT * FROM transaksi WHERE id_transaksi = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$id_transaksi ]);
    $hasil = $stmt->fetch();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Edit Supplier - <?php echo isset($hasil['id_customer']) ? $hasil['id_customer'] : ''; ?></title>
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
    <h3>Edit Supplier - <?php echo isset($hasil['id_customer']) ? $hasil['id_customer'] : ''; ?></h3>
    <br/>
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="id_customer">ID Customer:</label>
                    <input type="text" value="<?php echo isset($hasil['id_customer']) ? $hasil['id_customer'] : ''; ?>"
                           class="form-control" name="id_customer">
                </div>
                <div class="form-group">
                    <label for="id_barang">ID Barang</label>
                    <input type="text" value="<?php echo isset($hasil['id_barang']) ? $hasil['id_barang'] : ''; ?>"
                           class="form-control" name="id_barang">
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="text" value="<?php echo isset($hasil['harga']) ? $hasil['harga'] : ''; ?>"
                           class="form-control" name="harga">
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah:</label>
                    <input type="text" value="<?php echo isset($hasil['jumlah']) ? $hasil['jumlah'] : ''; ?>"
                           class="form-control" name="jumlah">
                </div>
                <div class="form-group">
                    <label for="tgl_transaksi">Tgl Transaksi:</label>
                    <input type="date" value="<?php echo isset($hasil['tgl_transaksi']) ? $hasil['tgl_transaksi'] : ''; ?>"
                           class="form-control" name="tgl_transaksi">
                </div>
                <div class="form-group">
                    <label for="tgl_pengiriman">Tgl Pengiriman:</label>
                    <input type="date" value="<?php echo isset($hasil['tgl_pengiriman']) ? $hasil['tgl_pengiriman'] : ''; ?>"
                           class="form-control" name="tgl_pengiriman">
                </div>
                <input type="hidden" value="<?php echo isset($hasil['id_transaksi']) ? $hasil['id_transaksi'] : ''; ?>" name="id_transaksi">
                <button class="btn btn-primary btn-md" name="update"><i class="fa fa-edit"></i> Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
