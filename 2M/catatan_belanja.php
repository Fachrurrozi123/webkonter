<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Belanja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="#">💸TIGOJITEHApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="rekapan_vocer.php">Rekapan Vocer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="catatan_belanja.php">Catatan Belanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="transaksi.php">Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="total_belanja.php">Total Belanja</a>
                    </li>
                    <button class="btn btn-light text-primary fw-bold ms-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasToggle" aria-controls="offcanvasToggle">
                        Tambah Catatan
                    </button>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasToggle" aria-labelledby="offcanvasToggleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasToggleLabel">Tambah Catatan Belanja</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form action="tambah_catatan.php" method="POST">
                <div class="mb-3">
                    <label for="tanggalBelanja" class="form-label">Tanggal Belanja</label>
                    <input type="date" class="form-control" id="tanggalBelanja" name="tanggal_belanja" required>
                </div>
                <div class="mb-3">
                    <label for="totalBelanja" class="form-label">Total Belanja</label>
                    <input type="number" class="form-control" id="totalBelanja" name="total_belanja" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Tambah Catatan</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="text-center fw-bold mb-4" style="color: #0d6efd;">Daftar Catatan Belanja</h1>
        <table class="table table-striped table-bordered text-center">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Tanggal Belanja</th>
                    <th>Total Belanja</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP: Loop Data -->
                <?php
                // Contoh data (replace with actual database query)
                $catatan = [
                    ['id' => 1, 'tanggal' => '2024-12-08', 'total' => 150000],
                    ['id' => 2, 'tanggal' => '2024-12-07', 'total' => 200000],
                ];

                foreach ($catatan as $key => $item) {
                    echo "
                    <tr>
                        <td>" . ($key + 1) . "</td>
                        <td>{$item['tanggal']}</td>
                        <td>Rp " . number_format($item['total'], 0, ',', '.') . "</td>
                        <td>
                            <form action='edit_catatan.php' method='POST' class='d-inline'>
                                <input type='hidden' name='id' value='{$item['id']}'>
                                <button type='submit' class='btn btn-warning btn-sm'>Edit</button>
                            </form>
                            <form action='hapus_catatan.php' method='POST' class='d-inline'>
                                <input type='hidden' name='id' value='{$item['id']}'>
                                <button type='submit' class='btn btn-danger btn-sm'>Hapus</button>
                            </form>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    

    <footer class="text-center py-3 bg-light">
        <p class="mb-0 text-muted">© 2024 Catatan Belanja. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal_belanja'];
    $total = $_POST['total_belanja'];

    // Simpan data ke database
    // Example: INSERT INTO catatan (tanggal, total) VALUES ('$tanggal', '$total');
    header('Location: catatan_belanja.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Redirect ke halaman form edit dengan data terkait
    header("Location: edit_form.php?id=$id");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Hapus data dari database
    // Example: DELETE FROM catatan WHERE id = $id;
    header('Location: catatan_belanja.php');
}



?>
