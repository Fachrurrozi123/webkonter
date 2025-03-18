<!-- Delete dan Update -->
<?php
        $conn = mysqli_connect('localhost', 'root', '', 'audit_harian');
        $tabel_total_seluruh = mysqli_query($conn, "SELECT * FROM total_seluruh");
        $row = mysqli_fetch_assoc($tabel_total_seluruh);
   
        $id = $_GET['id'];
        $nominal = $_GET['nominal'];
        $keterangan = $_GET['keterangan_transaksi'];
        
        if ($keterangan == 'transfer') {
            $total_gopay = $row['total_gopay'] + $nominal;
    
            // Update nilai total_gopay di database
            $hapus = mysqli_query($conn, "DELETE FROM transaksi_gopay WHERE id='$id'");
            $update = mysqli_query($conn, "UPDATE total_seluruh SET total_gopay = $total_gopay");

            header('location:gopay.php');
    
            if (!$update) {
                echo "Error saat memperbarui total_gopay: " . mysqli_error($conn);
            }
        }else if($keterangan == 'tarik'){
            $total_gopay = $row['total_gopay'] - $nominal;
    
            // Update nilai total_gopay di database
            $hapus = mysqli_query($conn, "DELETE FROM transaksi_gopay WHERE id='$id'");
            $update = mysqli_query($conn, "UPDATE total_seluruh SET total_gopay = $total_gopay");

            header('location:dana.php');
    
            if (!$update) {
                echo "Error saat memperbarui total_gopay: " . mysqli_error($conn);
            }
        }
    ?>
    <!-- akhir delete dan update -->