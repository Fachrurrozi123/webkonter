<!-- Delete dan Update -->
<?php
        $conn = mysqli_connect('localhost', 'root', '', 'audit_harian');
        $tabel_total_seluruh = mysqli_query($conn, "SELECT * FROM total_seluruh");
        $row = mysqli_fetch_assoc($tabel_total_seluruh);
   
        $id = $_GET['id'];
        $nominal = $_GET['nominal'];
        $keterangan = $_GET['keterangan_transaksi'];
        
        if ($keterangan == 'transfer') {
            $total_ovo = $row['total_ovo'] + $nominal;
    
            // Update nilai total_ovo di database
            $hapus = mysqli_query($conn, "DELETE FROM transaksi_ovo WHERE id='$id'");
            $update = mysqli_query($conn, "UPDATE total_seluruh SET total_ovo = $total_ovo");

            header('location:ovo.php');
    
            if (!$update) {
                echo "Error saat memperbarui total_ovo: " . mysqli_error($conn);
            }
        }else if($keterangan == 'tarik'){
            $total_ovo = $row['total_ovo'] - $nominal;
    
            // Update nilai total_ovo di database
            $hapus = mysqli_query($conn, "DELETE FROM transaksi_ovo WHERE id='$id'");
            $update = mysqli_query($conn, "UPDATE total_seluruh SET total_ovo = $total_ovo");

            header('location:dana.php');
    
            if (!$update) {
                echo "Error saat memperbarui total_ovo: " . mysqli_error($conn);
            }
        }
    ?>
    <!-- akhir delete dan update -->