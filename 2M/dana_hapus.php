<!-- Delete dan Update -->
<?php
        $conn = mysqli_connect('localhost', 'root', '', 'audit_harian');
        $tabel_total_seluruh = mysqli_query($conn, "SELECT * FROM total_seluruh");
        $row = mysqli_fetch_assoc($tabel_total_seluruh);
   
        $id = $_GET['id'];
        $nominal = $_GET['nominal'];
        $keterangan = $_GET['keterangan_transaksi'];
        
        if ($keterangan == 'transfer') {
            $total_dana = $row['total_dana'] + $nominal;
    
            // Update nilai total_dana di database
            $hapus = mysqli_query($conn, "DELETE FROM transaksi_dana WHERE id='$id'");
            $update = mysqli_query($conn, "UPDATE total_seluruh SET total_dana = $total_dana");

            header('location:dana.php');
    
            if (!$update) {
                echo "Error saat memperbarui total_dana: " . mysqli_error($conn);
            }
        }else if($keterangan == 'tarik'){
            $total_dana = $row['total_dana'] - $nominal;
    
            // Update nilai total_dana di database
            $hapus = mysqli_query($conn, "DELETE FROM transaksi_dana WHERE id='$id'");
            $update = mysqli_query($conn, "UPDATE total_seluruh SET total_dana = $total_dana");

            header('location:dana.php');
    
            if (!$update) {
                echo "Error saat memperbarui total_dana: " . mysqli_error($conn);
            }
        }
    ?>
    <!-- akhir delete dan update -->