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
        .form-control-inline {
            display: inline-block;
            width: auto;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="index.php">💸TIGOJITEHApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white " href="index.php">Dashboard</a>
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
    <!-- Header -->
    <div class="container py-5">
        <h1 class="text-center fw-bold">Transaksi Lapan-lapan</h1>
    </div>
      <!-- Add Transaction Form -->
      <div class="container mt-4">
        <form id="transactionForm" class="row g-3">
            <div class="col-md-6">
                <label for="keterangan" class="form-label">Keterangan Transaksi</label>
                <input type="text" id="keterangan" class="form-control" placeholder="Masukkan keterangan transaksi" required>
            </div>
            <div class="col-md-6">
                <label for="nominal" class="form-label">Nominal</label>
                <input type="number" id="nominal" class="form-control" placeholder="Masukkan nominal transaksi" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success">Tambah Transaksi</button>
            </div>
        </form>
    </div>

    <!-- Realtime Clock -->
    <div class="container">
        <p class="realtime-clock" id="clock"></p>
    </div>

    <!-- Table -->
    <div class="container table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan Transaksi</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="transactionTable">
                <!-- Placeholder for transaction data -->
            </tbody>
        </table>
    </div>


    <!-- Script -->
    <script>
        const transactionTable = document.getElementById('transactionTable');
        const transactionForm = document.getElementById('transactionForm');

        function updateClock() {
            const now = new Date();
            const formattedTime = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('clock').innerText = "Waktu Saat Ini: " + formattedTime;
        }

        function addTransaction(event) {
            event.preventDefault();

            const keterangan = document.getElementById('keterangan').value;
            const nominal = document.getElementById('nominal').value;
            const now = new Date();
            const tanggal = now.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }) + " " + now.toLocaleTimeString('id-ID');

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${tanggal}</td>
                <td>${keterangan}</td>
                <td>Rp ${parseInt(nominal).toLocaleString('id-ID')}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editTransaction(this)">Ubah</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteTransaction(this)">Hapus</button>
                </td>
            `;
            transactionTable.appendChild(row);

            transactionForm.reset();
        }

        function editTransaction(button) {
            const row = button.closest('tr');
            const keterangan = row.children[1].innerText;
            const nominal = row.children[2].innerText.replace("Rp ", "").replace(/\./g, "");

            document.getElementById('keterangan').value = keterangan;
            document.getElementById('nominal').value = nominal;

            transactionTable.removeChild(row);
        }

        function deleteTransaction(button) {
            const row = button.closest('tr');
            transactionTable.removeChild(row);
        }

        transactionForm.addEventListener('submit', addTransaction);
        setInterval(updateClock, 1000);
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
