<?php
include "config/koneksi.php";
$query = "SELECT * FROM inbox WHERE Processed = 'false'";
$hasil = mysqli_query($mysqli,$query);
while ($data = mysqli_fetch_array($hasil))
{

  $id = $data['ID'];


  $noPengirim = $data['SenderNumber'];

  $msg = strtoupper($data['TextDecoded']);
  $pecah = explode(" ", $msg);

	 $query1 = "SELECT keyword1 FROM tbl_autoreply WHERE keyword1='$pecah[0]'";
     $hasil1 = mysqli_query($mysqli,$query1);
     $data1 = mysqli_fetch_array($hasil1);

  if ($pecah[0] == $data1[0])
  {
	 $keyword2 = $pecah[1];
   $serah = explode("#", $keyword2);
     $query2 = "SELECT * FROM tbl_autoreply WHERE keyword2='$keyword2'";
     $hasil2 = mysqli_query($mysqli,$query2);

     if (count($serah)==4) {
      $hasil2 = mysqli_query($mysqli,"insert into `order` (`nama`,`perihal`,`tanggal`,`status`,`nomorhp`) values ('$serah[1]','$serah[2]','$serah[3]','tunda','$noPengirim') ");
          $reply = "Silahkan tunggu verifikasi dalam waktu 1x24jam ";
        // $reply = "Keyword tidak ditemukan";
        }
     elseif (mysqli_num_rows($hasil2) == 0)
     {
      // $reply = "Silahkan tunggu verifikasi dalam waktu 1x24jam #".$serah[0]."#".$serah[1]."#".$serah[2].count($serah);
        $reply = "Keyword tidak ditemukan";
     }

     else
     {
        $data2 = mysqli_fetch_array($hasil2);
        $pesan = $data2[3];
        $reply = $pesan;
     }
  }
  else $reply = "Maaf perintah salah";

  $query3 = "INSERT INTO outbox(DestinationNumber, TextDecoded) VALUES

('$noPengirim', '$reply')";
  $hasil3 = mysqli_query($mysqli,$query3);


  $query3 = "UPDATE inbox SET Processed = 'true' WHERE ID = '$id'";
  $hasil3 = mysqli_query($mysqli,$query3);
}