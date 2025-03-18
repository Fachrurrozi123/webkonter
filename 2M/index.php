<?php
$conn = mysqli_connect('localhost', 'root', '', 'audit_harian');

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$tabel = mysqli_query($conn, 'SELECT * FROM total_seluruh');

if (!$tabel) {
    die("Query gagal: " . mysqli_error($conn));
}

$tampil = mysqli_fetch_assoc($tabel);

if (!$tampil) {
    die("Data tidak ditemukan.");
}

$totals = [
    'modal' => $tampil['total_vocer'] + $tampil['total_aksesories'] + $tampil['total_tf'] + $tampil['total_dana'] + $tampil['total_gopay'] + $tampil['total_ovo'] + $tampil['total_mitra'] + $tampil['total_lapan_lapan'] + $tampil['total_cash'] ?? 0,
    'vocer' => $tampil['total_vocer'] ?? 0,
    'aksesoris' => $tampil['total_aksesories'] ?? 0,
    'dana' => $tampil['total_tf'] + $tampil['total_dana'] + $tampil['total_gopay'] + $tampil['total_ovo'] + $tampil['total_mitra'] + $tampil['total_lapan_lapan'] ?? 0,
    'uang_receh' => $tampil['total_cash'] ?? 0,
    'stok barang' => 120000,
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Keuangan</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="index.php">💸TIGOJITEHApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white active " href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="rekapan_vocer.php">Rekapan Vocer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="catatan_belanja.php">Catatan Belanja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="transaksi.php">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="total_belanja.php">Total Belanja</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color: #0d6efd;">💰 Dashboard Keuangan Konter</h1>
        <p class="text-muted">Kelola data keuangan Anda dengan mudah dan transparan.</p>
    </div>
    <div class="row g-4">
        <?php
        if (!empty($totals)) {
            foreach ($totals as $key => $value) {
                echo "
                <div class='col-md-4'>
                    <div class='card shadow-sm border-0 rounded'>
                        <div class='card-body text-center'>
                            <h5 class='card-title fw-semibold text-uppercase'>" . ucfirst($key) . "</h5>
                            <h2 class='text-primary fw-bold'>Rp " . number_format($value, 0, ',', '.') . "</h2>
                            " . ($key == 'dana' ? "
                            <button class='btn btn-primary mt-3' onclick=\"window.location.href='details.php?type=dana'\">Detail</button>
                            " : "") . "
                            " . ($key == 'stok barang' ? "
                            <button class='btn btn-primary mt-3' onclick=\"window.location.href='stok_barang.php'\">Lihat Stok</button>
                            " : "") . "
                        </div>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<p class='text-center text-danger'>Data tidak tersedia.</p>";
        }
        ?>
    </div>
</div>

<footer class="text-center py-3 mt-5 bg-light">
    <p class="mb-0 text-muted">© 2024 Dashboard Keuangan. All Rights Reserved.</p>
</footer>
</body>
</html>
