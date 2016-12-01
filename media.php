<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
include "config/page.php";

$id_user=$_SESSION['kode'];
$nm_user=$_SESSION['namauser'];
$photo=$_SESSION['photo'];
$sesi_username			= isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
if ($sesi_username != NULL || !empty($sesi_username) ||$_SESSION['leveluser']=='1'  )

{

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="FA SMS GATEWAY">

    <title>FA SMS GATEWAY</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">
    <link rel="stylesheet"  type="text/css" href="<?php echo $ambilcss1; ?>">
    <link rel="stylesheet"  type="text/css" href="<?php echo $ambilcss2; ?>">
	<link rel="shortcut icon" href="logosaga.png">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    <script src="assets/js/time.js" type="text/javascript"></script>
      <style type="text/css">
          .web{
              font-family:tahoma;
              top:10%;
              border:1px solid #CDCDCD;
              border-radius:10px;
              padding:10px;
              width:38%;
              margin:auto;
          }
          #search_keyword_id
          {
              width:300px;
              border:solid 1px #CDCDCD;
              padding:10px;
              font-size:14px;
          }
          #result
          {
              position:absolute;
              width:320px;
              display:none;
              margin-top:-1px;
              border-top:0px;
              overflow:hidden;
              border:1px #CDCDCD solid;
              background-color: white;
          }
          .show
          {
              font-family:tahoma;
              padding:10px;
              border-bottom:1px #CDCDCD dashed;
              font-size:15px;
          }
          .show:hover
          {
              background:#364956;
              color:#FFF;
              cursor:pointer;
          }
      </style>


  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="media.php" class="logo"><b>FA SMS GATEWAY</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->

                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">

                    </li>
                    <span id="dates"><span id="the-day">Hari, 00 Bulan 0000</span> <span id="the-time">00:00:00</span> </span>
                </ul>
                <!--  notification end -->

            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">

                    <li><a class="logout" href="logout.php" onclick="return confirm('Apakah anda yakin ?');"><i class="glyphicon glyphicon-off"></i><span> Logout</span></a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <?php
                  $user=mysqli_query($mysqli,"select * from tbl_user where id_user='$id_user'");
                  while($rowuser=mysqli_fetch_array($user)) {
                      echo "<p class='centered'><a href='?id=profile'><img src='" . $rowuser['photo'] . "' class='img-circle' width='60'></a></p>";
                      echo "<h5 class='centered'>" . $rowuser['username'] . "</h5>";
                  }
                  ?>

                  <li class="mt">
                      <a class="<?php echo $classmenu1 ?>" href="?id=home">
                          <i class="fa fa-dashboard"></i>
                          <span>Menu Awal</span>
                      </a>
                  </li>

				  <li class="mt">
                      <a data-toggle="modal" data-target="#myModal" href="" >
                          <i class="fa 	fa-pencil-square-o"></i>
                          <span>Tulis Pesan</span>
                      </a>
                  </li>




                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-folder-o"></i>
                          <span>Pesan</span>
                      </a>
                      <ul class="sub active">
                          <li><a  class="<?php echo $classmenu2 ?>" href="?id=inbox">Kotak Masuk</a></li>
                          <li><a  class="<?php echo $classmenu3 ?>" href="?id=outbox">Kotak Keluar</a></li>
                          <li><a  class="<?php echo $classmenu4 ?>" href="?id=sent">Pesan Terkirim</a></li>
                          <li><a data-toggle="modal" data-target="#modalsiaran" href="">
                              <span>Pesan Siaran</span>
                          </a></li>

                          <li><a class="<?php echo $classmenu5 ?>" href="?id=schedule">Pesan Terjadwal</a></li>


                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-folder-o"></i>
                          <span>Pemesanan</span>
                      </a>
                      <ul class="sub active">
                          <li><a  class="<?php echo $classmenu10 ?>" href="?id=tunda">Ditunda</a></li>
                          <li><a  class="<?php echo $classmenu11 ?>" href="?id=aktif">Aktif</a></li>
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Pengaturan</span>
                      </a>
                      <ul class="sub">
                          <li><a class="<?php echo $classmenu6 ?>" href="?id=profile">Profile</a></li>
                          <!-- <li><a  class="<?php echo $classmenu7 ?>" href="?id=auto">AutoReplay</a></li> -->
                      </ul>
                  </li>
                  <li class="active sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Kontak</span>
                      </a>
                      <ul class="sub">
                          <li><a class="<?php echo $classmenu8 ?>" href="?id=pb">Semua</a></li>
                          <li><a  class="<?php echo $classmenu9 ?>" href="?id=grp">Group</a></li>

                      </ul>
                  </li>

                  <li class="mt">

                      <a class="logout" href="logout.php" onclick="return confirm('Apakah anda yakin ?');">
                          <i class="glyphicon glyphicon-off"></i>
                          <span>Logout</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->


      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">

	  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Tulis Pesan</h4>
						      </div>
						      <div class="modal-body">
						        <form class="form-horizontal style-form" action="" method="post">

								    <div class="form-group">
								        <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
								        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" name="pesan" placeholder="Isikan Pesan" required></textarea>
								        </div>
								    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Ke</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control search_keyword" name="nohp" id="search_keyword_id" placeholder="Isikan No Hp Tujuan" required>
                                            <span id="result"></span>
                                        </div>
                                    </div>


						      <div class="modal-footer">

						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <input type="submit" class="btn btn-primary" name="input" value="KIRIM">
						      </div>
							  </form>
                              </div>
						    </div>
						  </div>
					</div>
 <div class="modal fade" id="modalsiaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                  <h4 class="modal-title" id="myModalLabel">Pesan Siaran</h4>
                              </div>
                              <div class="modal-body">
                                  <form class="form-horizontal style-form" action="" method="post">

                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Group</label>
                                          <div class="col-sm-10">

                                              <select name="group"><option value=0 selected>- Pilih Grups -</option>

                                                  <?php
                                                  $q = mysqli_query($mysqli,"select * from pbk_groups");

                                                  while ($a = mysqli_fetch_array($q)){

                                                          echo "<option value='$a[1]'>$a[0]</option>";

                                                  }
                                                  ?>
                                                  ?>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-sm-2 col-sm-2 control-label">Pesan</label>
                                          <div class="col-sm-10">
                                              <textarea type="text" class="form-control" name="pesan" placeholder="Isikan Pesan" required></textarea>
                                          </div>
                                      </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <input type="submit" class="btn btn-primary" name="inputgroup" value="KIRIM">
                              </div>
                              </form>
                          </div>
                      </div>
                  </div>

          <section class="wrapper">
              <?php
              include "config/koneksi.php";
              if (isset($_POST['input'])) {
                  $nohp=$_POST['nohp'];
                  $pesan=$_POST['pesan'];
				  $jmlSMS=ceil(strlen($pesan)/153);
				  $pecah=str_split($pesan, 153);
				  $hasil=mysqli_query($mysqli,"SHOW TABLE STATUS LIKE 'outbox'");
				  $data=mysqli_fetch_array($hasil);
				  $newID=$data['Auto_increment'];
				  for ($i=1; $i<=$jmlSMS; $i++)
				  {
					  $udh="050003A7".sprintf("%02s",$jmlSMS).sprintf("%02s",$i);

					  $msg=$pecah[$i-1];
					  if($i == 1){
						  $sql = mysqli_query($mysqli,"INSERT INTO outbox(DestinationNumber,UDH,TextDecoded,ID,Multipart,CreatorID) VALUES
						  ('$nohp','$udh','$msg','$newID','true','Gammu')");
						  if ($sql > 0) {
							echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Kirim<br/></div>";
							} else {
								echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
							}
					  }else {
						   $sql = mysqli_query($mysqli,"INSERT INTO outbox_multipart(UDH,TextDecoded,ID,SequencePosition) VALUES
						  ('$udh','$msg','$newID','$i')");
						  if ($sql > 0) {
							echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Kirim<br/></div>";
							} else {
								echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysqli_error($mysqli)."<br/></div>";
							}
					  }
				  }




              }
              if (isset($_POST['inputgroup'])) {
                  $group = $_POST['group'];
                  $message = $_POST['pesan'];
                  $query = mysqli_query($mysqli, "SELECT * FROM pbk WHERE GroupID='".$group."'");
                  while ($row = mysqli_fetch_array($query)) {
                      $query2 = "INSERT INTO outbox (DestinationNumber, TextDecoded, CreatorID) VALUES ('" . $row['Number'] . "', '$message', 'Gammu')";
                      $hasil = mysqli_query($mysqli,$query2);

                      if ($hasil > 0) {
                          echo "<div class='alert alert-block alert-success'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-check'></i> BERHASIL </strong>Pesan Berhasil di Kirim ke no " . $row['Number'] . "<br/></div>";
                      } else {
                          echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'><i class='fa fa-times'></i></button><strong><i class='fa fa-times'></i> MAAF! </strong>" .mysql_error()."<br/></div>";
                      }

                  }
              }

              ?>
              <?php include $ambil; ?>

          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <div>
      <footer class="site-footer">
          <div class="text-center">
              FA SMS GATEWAY @ 2016
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
       </div>
      <!--footer end-->


    <!-- js placed at the end of the document so the pages load faster -->

    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->

      <script src="<?php echo $ambiljs1; ?>"></script>
      <script src="<?php echo $ambiljs2; ?>"></script>
      <script src="<?php echo $ambiljs3; ?>"></script>
      <script src="<?php echo $ambiljs4; ?>"></script>
      <?php include $ambilfungsi; ?>


      <script type="text/javascript">

          function Ajax()
          {
              var
                  $http,
                  $self = arguments.callee;

              if (window.XMLHttpRequest) {
                  $http = new XMLHttpRequest();
              } else if (window.ActiveXObject) {
                  try {
                      $http = new ActiveXObject('Msxml2.XMLHTTP');
                  } catch(e) {
                      $http = new ActiveXObject('Microsoft.XMLHTTP');
                  }
              }

              if ($http) {
                  $http.onreadystatechange = function()
                  {
                      if (/4|^complete$/.test($http.readyState)) {
                          document.getElementById('header_inbox_bar').innerHTML = $http.responseText;
                          setTimeout(function(){$self();}, 10000);
                      }

                  };
                  $http.open('GET', 'cek_inbox.php' + '?' + new Date().getTime(), true);
                  $http.send(null);
              }
              else  {
                  document.getElementById('header_inbox_bar').innerHTML = $http.responseText;
              }

          }


      </script>

      <script type="text/javascript">
          setTimeout(function() {Ajax();}, 10000);
      </script>

      <script type="text/javascript">
          $(function(){
              $(".search_keyword").keyup(function()
              {
                  var search_keyword_value = $(this).val();
                  var dataString = 'search_keyword='+ search_keyword_value;
                  if(search_keyword_value!='')
                  {
                      $.ajax({
                          type: "POST",
                          url: "search.php",
                          data: dataString,
                          cache: false,
                          success: function(html)
                          {
                              $("#result").html(html).show();
                          }
                      });
                  }
                  return false;
              });

              $("#result").live("click",function(e){
                  var $clicked = $(e.target);
                  var $phonebook = $clicked.find('.phonebook').html();
                  var decoded = $("<span/>").html($phonebook).text();
                  $('#search_keyword_id').val(decoded);
              });

              $(document).live("click", function(e) {
                  var $clicked = $(e.target);
                  if (! $clicked.hasClass("search_keyword")){
                      $("#result").fadeOut();
                  }
              });

              $('#search_keyword_id').click(function(){
                  $("#result").fadeIn();
              });
          });
      </script>

  </body>
</html>
<?php
}else{
    session_destroy();
    header('Location:index.php?status=Silahkan Login');
}
?>