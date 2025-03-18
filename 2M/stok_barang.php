<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background: linear-gradient(90deg, #004aad, #007bff);
        }

        .table thead {
            background: linear-gradient(90deg, #004aad, #007bff);
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f9ff;
        }

        h1 {
            color: #004aad;
            font-weight: bold;
            text-align: center;
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
                    <a class="nav-link text-white active" href="index.php">Dashboard</a>
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

    <div class="container py-5">
        <h1 class="mb-4">Stok Barang</h1>

        <!-- Tombol Tambah -->
        <div class="mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEditModal" onclick="openAddModal()">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>

        <!-- Tabel Stok Barang -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Modal Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Data akan dimuat di sini melalui JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    <div class="modal fade" id="addEditModal" tabindex="-1" aria-labelledby="addEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addEditModalLabel">Tambah/Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEditForm">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" id="kode" placeholder="Masukkan kode barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="modal" class="form-label">Modal Barang</label>
                            <input type="number" class="form-control" id="modal" placeholder="Masukkan modal barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah" placeholder="Masukkan jumlah barang" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        let dataStok = [
            { kode: "BRG001", nama: "Vocer Pulsa 50K", modal: 45000, jumlah: 10 },
            { kode: "BRG002", nama: "Vocer Data 1GB", modal: 30000, jumlah: 20 },
            { kode: "BRG003", nama: "Aksesoris Charger", modal: 25000, jumlah: 15 }
        ];
        let editingIndex = -1; // Variabel untuk menentukan apakah dalam mode edit

        function renderTable() {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';
            dataStok.forEach((item, index) => {
                tableBody.innerHTML += `
                    <tr>
                        <td>${item.kode}</td>
                        <td>${item.nama}</td>
                        <td>Rp ${item.modal.toLocaleString()}</td>
                        <td>${item.jumlah} pcs</td>
                        <td>
                            <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#addEditModal'
                                onclick='openEditModal(${index})'>
                                <i class='fas fa-edit'></i> Edit
                            </button>
                            <button class='btn btn-danger btn-sm' onclick='deleteItem(${index})'>
                                <i class='fas fa-trash'></i> Hapus
                            </button>
                        </td>
                    </tr>
                `;
            });
        }

        function openAddModal() {
            editingIndex = -1; // Reset index untuk Tambah Mode
            document.getElementById('addEditForm').reset();
            document.getElementById('kode').disabled = false;
            document.getElementById('addEditModalLabel').innerText = 'Tambah Data';
            $('#addEditModal').modal('show');
        }

        function openEditModal(index) {
            editingIndex = index; // Set index untuk Edit Mode
            const item = dataStok[index];
            document.getElementById('kode').value = item.kode;
            document.getElementById('nama').value = item.nama;
            document.getElementById('modal').value = item.modal;
            document.getElementById('jumlah').value = item.jumlah;
            document.getElementById('kode').disabled = true;
            document.getElementById('addEditModalLabel').innerText = 'Edit Data';
            $('#addEditModal').modal('show');
        }

        document.getElementById('addEditForm').onsubmit = function (e) {
            e.preventDefault();
            const newItem = {
                kode: document.getElementById('kode').value,
                nama: document.getElementById('nama').value,
                modal: parseInt(document.getElementById('modal').value),
                jumlah: parseInt(document.getElementById('jumlah').value)
            };

            if (editingIndex > -1) {
                // Edit Mode
                dataStok[editingIndex] = newItem;
            } else {
                // Add Mode
                dataStok.push(newItem);
            }

            renderTable();
            $('#addEditModal').modal('hide');
            editingIndex = -1; // Reset index setelah operasi
        };

        function deleteItem(index) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                dataStok.splice(index, 1);
                renderTable();
            }
        }

        renderTable();
    </script>
</body>
</html>
