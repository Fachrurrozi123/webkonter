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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Keuangan Dana</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container py-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color: #0d6efd;">🔍 Detail Keuangan Dana</h1>
            <p class="text-muted">Informasi detail mengenai dana yang dikelola.</p>
        </div>
        
        <!-- Details Section -->
        <div class="row g-4">
            <?php
            $details = [
                'tf' => $tampil['total_tf'] ?? 0,
                'dana' => $tampil['total_dana'] ?? 0,
                'gopay' => $tampil['total_gopay'] ?? 0,
                'ovo' => $tampil['total_ovo'] ?? 0,
                'mitra' => $tampil['total_mitra'] ?? 0,
            ];
            foreach ($details as $key => $value) {
                echo "
                <div class='col-md-4'>
                    <div class='card shadow-sm border-0 rounded'>
                        <div class='card-body text-center'>
                            <h5 class='card-title fw-semibold text-uppercase'>" . ucfirst($key) . "</h5>
                            <h2 class='text-success fw-bold'>Rp " . number_format($value, 0, ',', '.') . "</h2>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class=' btn-primary mt-4'>Kembali</a>
        </div>
    </div>

    <footer class="text-center py-3 mt-5 bg-light">
        <p class="mb-0 text-muted">© 2024 Dashboard Keuangan. All Rights Reserved.</p>
    </footer>

    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
