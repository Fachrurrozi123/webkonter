<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        .transaction-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .transaction-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .transaction-btn {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
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
                        <a class="nav-link text-white" href="catatan_belanja.php">Catatan Belanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="transaksi.php">Transaksi</a>
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
        <h1 class="text-center fw-bold mb-4" style="color: #0d6efd;">Pilih Transaksi</h1>
        <div class="row g-4">
            <!-- Card for each transaction -->
            <?php
            $transactions = [
                ['name' => 'Dana', 'link' => 'dana.php', 'icon' => '💳'],
                ['name' => 'OVO', 'link' => 'ovo.php', 'icon' => '📱'],
                ['name' => 'Transfer Bank (TF)', 'link' => 'tf.php', 'icon' => '🏦'],
                ['name' => 'GoPay', 'link' => 'gopay.php', 'icon' => '💵'],
                ['name' => 'Lapan Lapan', 'link' => 'lapanlapan.php', 'icon' => '🛍️'],
                ['name' => 'Mitra', 'link' => 'mitra.php', 'icon' => '🤝']
            ];

            foreach ($transactions as $transaction) {
                echo "
                <div class='col-md-4'>
                    <div class='card shadow-sm border-0 rounded transaction-card'>
                        <div class='card-body text-center'>
                            <div class='display-3 mb-3'>{$transaction['icon']}</div>
                            <h5 class='card-title fw-bold'>{$transaction['name']}</h5>
                            <a href='{$transaction['link']}' class='btn btn-primary transaction-btn mt-3'>Pilih</a>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
