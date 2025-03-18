<!-- koneksi beserta query ke penyimpanan -->
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$conn = mysqli_connect('localhost', 'root', '', 'audit_harian');

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$tabel = mysqli_query($conn, 'SELECT * FROM transaksi_dana ORDER BY tanggal DESC');
if (!$tabel) {
    die("Query gagal: " . mysqli_error($conn));
}

// mengambil di tabel total_seluruh untuk mengurangi dengan data tambah pada tabel transaksi_dana
$tabel_total_seluruh = mysqli_query($conn, "SELECT * FROM total_seluruh");
$ambil_tabel_dana = mysqli_fetch_assoc($tabel_total_seluruh);
//akhir
?>
<!-- akhir koneksi dan query -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Dana</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .realtime-clock {
            font-size: 0.9rem;
            color: #6c757d;
            text-align: right;
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="index.php">💸TIGOJITEHApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="rekapan_vocer.php">Rekapan Vocer</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="catatan_belanja.php">Catatan Belanja</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="transaksi.php">Transaksi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="total_belanja.php">Total Belanja</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h1 class="text-center fw-bold">Transaksi Dana</h1>
</div>

<div class="container mt-4">
    <form method="POST">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="keterangan" class="form-label">Keterangan Transaksi</label>
                <input name="keterangan_transaksi" type="text" id="keterangan" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="nominal" class="form-label">Nominal</label>
                <input name="nominal" type="number" id="nominal" class="form-control" required>
            </div>
            <div class="col-12 text-center">
                <button name="submit" type="submit" class="btn btn-success">Tambah Transaksi</button>
            </div>
        </div>
    </form>
</div>

<!-- insert data -->
<?php
if (isset($_POST['submit'])) {
    $keterangan = $_POST['keterangan_transaksi'];
    $nominal = $_POST['nominal'];

    // Tambahkan data ke tabel transaksi_dana
    $tambah = mysqli_query($conn, "INSERT INTO transaksi_dana (tanggal, keterangan_transaksi, nominal) VALUES (NOW(), '$keterangan', '$nominal')");

    // Kurangi total_dana jika keterangan adalah 'transfer'
    if ($keterangan == 'transfer') {
        $total_dana = $ambil_tabel_dana['total_dana'] - $nominal;

        // Update nilai total_dana di database
        $update = mysqli_query($conn, "UPDATE total_seluruh SET total_dana = $total_dana");

        if (!$update) {
            echo "Error saat memperbarui total_dana: " . mysqli_error($conn);
        }
    }else if($keterangan == 'tarik'){
        $total_dana = $ambil_tabel_dana['total_dana'] + $nominal;

        // Update nilai total_dana di database
        $update = mysqli_query($conn, "UPDATE total_seluruh SET total_dana = $total_dana");

        if (!$update) {
            echo "Error saat memperbarui total_dana: " . mysqli_error($conn);
        }
    }

    if ($tambah) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!-- akhir insert data -->


<div class="container table-responsive">
    <table class="table table-bordered text-center">
        <thead class="table-primary">
            <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Nominal</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($tampil = mysqli_fetch_assoc($tabel)) { ?>
            <tr>
                <td><?= $tampil['tanggal'] ?></td>
                <td><?= $tampil['keterangan_transaksi'] ?></td>
                <td><?= $tampil['nominal'] ?></td>
                <td>
                    <a href="update.php?id=<?= $tampil['id'] ?>" class="btn btn-primary">Update</a>
                    <a href="dana_hapus.php?id=<?= $tampil['id'] ?>&nominal=<?= $tampil['nominal'] ?>&keterangan_transaksi=<?= $tampil['keterangan_transaksi'] ?>" class="btn btn-danger">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
