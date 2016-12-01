<?php
 session_start();
 $sesi_username         = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )
{
// panggil berkas koneksi.php
include "../config/koneksi.php";


?>

 <div class="span8">
    <div class="table-responsive">

<table class="table table-striped" cellspacing="0" width="100%">
<thead>
    <tr>
        <th class="site-footer">No</th>
        <th class="site-footer">Nama</th>
        <th class="site-footer">Perihal</th>
        <th class="site-footer">Tanggal</th>
    </tr>
</thead>
<tbody>
    <?php
        $i = 1;
        $jml_per_halaman = 5; // jumlah data yg ditampilkan perhalaman
        $jml_data = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM `order` WHERE status='aktif'"));
        $jml_halaman = ceil($jml_data / $jml_per_halaman);
        // query pada saat mode pencarian
        if(isset($_POST['cari'])) {
            $kunci = $_POST['cari'];
            echo "<strong>Hasil pencarian untuk kata kunci $kunci</strong>";
            $query = mysqli_query($mysqli,"
               SELECT ID,ReceivingDateTime,SenderNumber,(select a.Name from pbk a where a.Number=b.SenderNumber)as nmpengirim,TextDecoded FROM inbox b
                WHERE SenderNumber LIKE '%$kunci%'
                OR TextDecoded LIKE '%$kunci%'
                order by ReceivingDateTime DESC
            ");
        // query jika nomor halaman sudah ditentukan
        } elseif(isset($_POST['halaman'])) {
            $halaman = $_POST['halaman'];
            $i = ($halaman - 1) * $jml_per_halaman  + 1;
            $query = mysqli_query($mysqli,"SELECT ID,ReceivingDateTime,SenderNumber,(select a.Name from pbk a where a.Number=b.SenderNumber)as nmpengirim,TextDecoded FROM inbox b order by ReceivingDateTime DESC LIMIT ".(($halaman - 1) * $jml_per_halaman).", $jml_per_halaman");
        // query ketika tidak ada parameter halaman maupun pencarian
        } else {
            $query = mysqli_query($mysqli,"SELECT * FROM `order` WHERE status='aktif'");
            $halaman = 1; //tambahan
        }
         while($data = mysqli_fetch_array($query)){



    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $data['perihal']  ?></td>
        <td><?php echo $data['tanggal']  ?></td>


    </tr>

    <?php
        $i++;
        }
    ?>
</tbody>
</table>

 </div>
<?php if(!isset($_POST['cari'])) { ?>
<!-- untuk menampilkan menu halaman -->
<div class="pagination">
  <ul>

    <?php

    // tambahan
    // panjang pagig yang akan ditampilkan
    $no_hal_tampil = 5; // lebih besar dari 3

    if ($jml_halaman <= $no_hal_tampil) {
        $no_hal_awal = 1;
        $no_hal_akhir = $jml_halaman;
    } else {
        $val = $no_hal_tampil - 2; //3
        $mod = $halaman % $val; //
        $kelipatan = ceil($halaman/$val);
        $kelipatan2 = floor($halaman/$val);

        if($halaman < $no_hal_tampil) {
            $no_hal_awal = 1;
            $no_hal_akhir = $no_hal_tampil;
        } elseif ($mod == 2) {
            $no_hal_awal = $halaman - 1;
            $no_hal_akhir = $kelipatan * $val + 2;
        } else {
            $no_hal_awal = ($kelipatan2 - 1) * $val + 1;
            $no_hal_akhir = $kelipatan2 * $val + 2;
        }

        if($jml_halaman <= $no_hal_akhir) {
            $no_hal_akhir = $jml_halaman;
        }
    }

    for($i = $no_hal_awal; $i <= $no_hal_akhir; $i++) {
        // tambahan
        // menambahkan class active pada tag li
        $aktif = $i == $halaman ? ' active' : '';
    ?>
    <ul class="pagination">

    <li class="halaman<?php echo $aktif ?>" id="<?php echo $i ?>"><a href="#"><?php echo $i ?></a></li>

    </ul>

    <?php } ?>

  </ul>
</div>
</div>
<?php } ?>

<?php

?>
<?php
}else{
    session_destroy();
    header('Location:../index.php?status=Silahkan Login');
}
?>