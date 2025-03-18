<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapan Vocer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
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
                    <a class="nav-link text-white " href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white active" href="rekapan_vocer.php">Rekapan Vocer</a>
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

    <div class="container py-5">
        <h1 class="mb-4">Rekapan Vocer</h1>

        <!-- Form Tambah Data -->
        <form id="addForm" class="mb-4">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Kode Barang" id="kodeBarang" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Nama Barang" id="namaBarang" required>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" placeholder="Harga Modal" id="hargaModal" required>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" placeholder="Harga Jual" id="hargaJual" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-success w-100" onclick="addData()">Tambah</button>
                </div>
            </div>
        </form>

        <!-- Tabel Rekapan -->
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Modal</th>
                    <th>Harga Jual</th>
                    <th>Total Modal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="dataTable">
                <!-- Data akan di-generate melalui JavaScript -->
            </tbody>
        </table>
    </div>

    <script>
        let data = [
            { kode: "BRG001", nama: "Vocer Pulsa 50K", modal: 45000, jual: 50000 },
            { kode: "BRG002", nama: "Vocer Data 1GB", modal: 30000, jual: 35000 }
        ];

        function renderTable() {
            const table = document.getElementById("dataTable");
            table.innerHTML = "";
            data.forEach((item, index) => {
                table.innerHTML += `
                    <tr>
                        <td>${item.kode}</td>
                        <td>${item.nama}</td>
                        <td>Rp ${item.modal.toLocaleString()}</td>
                        <td>Rp ${item.jual.toLocaleString()}</td>
                        <td>Rp ${(item.modal * 1).toLocaleString()}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editData(${index})">Ubah</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteData(${index})">Hapus</button>
                        </td>
                    </tr>
                `;
            });
        }

        function addData() {
            const kode = document.getElementById("kodeBarang").value;
            const nama = document.getElementById("namaBarang").value;
            const modal = parseInt(document.getElementById("hargaModal").value);
            const jual = parseInt(document.getElementById("hargaJual").value);

            data.push({ kode, nama, modal, jual });
            renderTable();

            // Reset form
            document.getElementById("addForm").reset();
        }

        function deleteData(index) {
            data.splice(index, 1);
            renderTable();
        }

        function editData(index) {
            const item = data[index];
            document.getElementById("kodeBarang").value = item.kode;
            document.getElementById("namaBarang").value = item.nama;
            document.getElementById("hargaModal").value = item.modal;
            document.getElementById("hargaJual").value = item.jual;

            deleteData(index);
        }

        // Render tabel saat halaman pertama kali dimuat
        renderTable();
    </script>
</body>
</html>
