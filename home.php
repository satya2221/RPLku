<?php
    require "kripto_side/angka_inisiasi.php";
    $objet=new angka_inisiasi();
//    $eaa = $objet ->find_n();
//    $jaa = $objet ->find_e();
//    $tet = $objet ->o_n();
//    echo $eaa."<br>";
//    echo $jaa."<br>".$tet."<br>";
//    $ascii = unpack("C*", "007/11012021/4/ARS"); //001/20052020/3
//    print_r($ascii);
//    echo "<br>";
//    $baa = pack("C*",...$ascii);
//    echo $baa."<br>";
//    //echo strlen($objet->enkrip("006/10012021/4/ARS"))."<br>";
////    print_r($objet->find_d());
////    echo "<br>";
//    $paaa = $objet->enkrip("007/11012021/4/ARS");
//    print_r($paaa);
//    //$array_pa = explode("|",$paaa);
//    echo "<br>";
//    echo "<br>";

    //print_r($objet->for_dekrip("0011999361",$paaa));
//    echo "<br>".$objet->for_dekrip(1);
    require "kripto_side/playfair.php";
    $objek = new playfair();
//    $array_kunci = $objek ->BuatKunci();
//    print_r($array_kunci);
//    $misal_2 = $objek ->simpan_spasi("kamyu","GOoD BrOOMSS");
//    print_r($misal_2);
//    echo "<br>";
//    print_r($objek->rombak_pesan("kamyu","GOoD BrOOMSS"));
//   x echo "<br>";
//   x $objek ->simpan_spasi("kamyu","GOoD BrOOMSS");
//    $enkripsian = $objek->enkripsi("GOoD BrOOMS");
//    echo $enkripsian."<br>";
//  x  print_r($objek->spasi);
//   x echo "<br>";
    //print_r($objek->dekripsi("kamyu",$enkripsian));
//   x echo "<br>";
//   x print_r($objek->spasi);
//   x echo "<br>";


    include "proses/koneksi.php";
    session_start();
    if (empty($_SESSION['email'])) {
        header("location:login.php?pesan=belum_login");
    }
    elseif(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $role = $_SESSION['role'];
        $query = mysqli_query($link,"SELECT * from pegawai where email='$email'");
        $data = mysqli_fetch_array($query);
    }
    else {
        $role = "kosong";
    }
    $no_jabatan = $data['nip'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="cssnya/home.css">
</head>
<body style="background-color: #aceacc">
 <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #00923f;">
  <a class="navbar-brand" href="#"><img src="cssnya/asset/Kejaksaan_Agung_Republik_Indonesia.png" width="45" height="45"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php if ($role == "Kepala Bagian"):?>
      <?php   
            else:?>
      <li class="nav-item">
              <a class="nav-link" href="surat.php">Surat</a>
          <?php endif; ?>    
      </li>
      <li class="nav-item">
        <a class="nav-link" href="disposisi.php">Disposisi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="arsip.php">Arsip</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Notifikasi <span class="badge badge-light">3</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">
          	<small><i>17 April 2018</i></small> <br>
          	Response dari Kabag TU please check it
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li> -->
    </ul>
      <span style="color: white"><?php  echo $data['nama'];?></span>  
      <a href="proses/logout.php"><button class="btn btn-outline-dark my-2 my-sm-0 mx-2" style="color: white">Logout</button></a>
  </div>
</nav>
<div class="jumbotronnya">
        <div class="container p-5">
        <div class="jumbotron text-center " style="border-radius:25px;">
            <center>
                <img src="cssnya/asset/Kejaksaan_Agung_Republik_Indonesia.png" style="width: 20%; height: 20%;">
                <hr width= "25%" class="my-2">
                <h2>Kejaksaan Negeri Denpasar</h2>
            </center>    
        </div>
    </div>
</div>
<div class="d-flex justify-content-center flex-row p-2 justify-content-center">
  <?php if ($role != "Kepala Bagian") : ?>
	     <a href="surat.php" style="color: white;">
            <div class="flex-fill p-2 bd-danger" style="background-color: #f46f6f; ">
                <h3><strong>Surat Masuk</strong></h3>
                <div class="container">
                	<div class="row">
                		<div class="col-6">
                <p>Periksa surat-surat yang baru saja dimasukkan ke dalam sistem</p>
                <strong>Surat Baru : </strong>
                <?php  
                  $query_home_surat = mysqli_query($link, "SELECT * FROM surat");
                  $banyak_surat =  mysqli_num_rows($query_home_surat);

                  $query_home_disp = mysqli_query($link, "SELECT * FROM lembar_disposisi");
                  $banyak_disp =  mysqli_num_rows($query_home_disp);

                  $surat_baru = $banyak_surat - $banyak_disp;
                  echo $surat_baru;
                ?>
                </div>
                		<div class="col-6">
                			<img class="float-right" src="cssnya/asset/mail.svg" width="80%" height="80%">
                		</div>
                </div>
            	</div>
            	<center> 
            		Click box ini untuk detail
                </center>
            </div>
        </a>
        <a href="disposisi.php" style="color: white;">
            <div class="flex-fill p-2 bd-danger" style="background-color: #6faef4;">
                <h3><strong>Lembar Disposisi</strong></h3>
                <div class="container">
                	<div class="row">
                		<div class="col-6">
               				 <p>Periksa Disposisi yang sudah dibuat dan sedang/akan dilaksanakan</p>
                       <strong>On-going : </strong>
                       <?php 
                          $query_ars=mysqli_query($link, "SELECT * FROM arsip"); 
                          $banyaknya = mysqli_num_rows($query_ars);

                          $disp_new  = $banyak_disp - $banyaknya;
                          echo $disp_new;
                        ?>
                		</div>
                		<div class="col-6">
                			<img class="float-right" src="cssnya/asset/document.svg" width="80%" height="80%">
                		</div>
                </div>
            	</div>
            	<center>
            		Click box ini untuk detail
                </center>
            </div>
         </a>
         <a href="arsip.php" style="color: white;">
            <div class="flex-fill p-2 bd-danger" style="background-color: #ff8a00;">
                <h3><strong>Arsip</strong></h3>
                <div class="container">
                	<div class="row">
                		<div class="col-6">
               				 <p>Lihat surat dan lembar disposisi yang sudah selesai dilaksanakan</p>
                       <strong>Arsip saat ini :</strong>
                        <?php 
                            echo $banyaknya;
                        ?>
                		</div>
                		<div class="col-6">
                			<img class="float-right"  src="cssnya/asset/checklist.svg" width="80%" height="80%">
                		</div>
                </div>
            	</div>
            	<center> 
                Clickbox untuk detail
                </center>
            </div>
        </a>
        <?php else: ?>
           <a href="disposisi.php" style="color: white;">
            <div class="flex-fill p-2 bd-danger" style="background-color: #6faef4;">
                <h3><strong>Lembar Disposisi</strong></h3>
                <div class="container">
                  <div class="row">
                    <div class="col-6">
                       <p>Periksa Disposisi yang sudah dibuat dan sedang/akan dilaksanakan</p>
                    </div>
                    <div class="col-6">
                      <img class="float-right" src="cssnya/asset/document.svg" width="80%" height="80%">
                    </div>
                </div>
              </div>
              <center>
                Click box ini untuk detail
                </center>
            </div>
         </a>
       <?php endif; ?>
</div>
<div class="d-flex justify-content-center flex-row p-2">
  <?php if ($role == "Kepala Bagian"||$role == "Petugas TU"):?>
    <div class="p-2 justify-content-center bd-light" style="background-color:#afdbf5">
    <h1>Keseluruhan data</h1>
    <center>
      <h5><strong>Surat Masuk : </strong></h5>
      <h5><strong>Disposisi : </strong></h5>
      <h5><strong>Selesai : </strong></h5>         
    </center>
  </div>
  </div>
  <?php else: ?>
	<div class="p-2 bd-light" style="background-color: #f4e2cc">
		<div class="container">
		<h1>Yang sedang berlangsung</h1>
		<table class="table table-hover table-striped my-2">
			<tr class="table-info">
				<th>No Surat</th>
				<th>Pelaksana</th>
				<th>Keterangan</th>
			</tr>
      <!-- SELECT * FROM lembar_disposisi WHERE no_disposisi NOT IN (SELECT no_disposisi FROM arsip) -->
      <?php 
        $berlangsung = mysqli_query($link, "SELECT * FROM lembar_disposisi ldp INNER JOIN melaksanakan m ON m.no_disposisi = ldp.no_disposisi INNER JOIN pegawai ON ldp.nip_pelaksana=nip");?>
        
      <?php  while ($datajalan = mysqli_fetch_array($berlangsung)) {?>
			<tr>
				<td><?php print_r($objet ->for_dekrip($no_jabatan, $datajalan['no_disposisi'])) ; ?></td>
				<td><?php echo $datajalan['nama']; ?></td>
				<td><?php echo $datajalan['status']; ?></td>
			</tr>
      <?php } ?>
		</table>
	</div>
	</div>
	<div class="p-2 bd-light" style="background-color:#afdbf5">
		<h1>Keseluruhan data</h1>
    <center>
      <h5>
        <strong>Surat Masuk :
          <?php  
            echo $banyak_surat;
          ?> 
        </strong>
      </h5>
      <h5>
        <strong>Disposisi : 
          <?php  
            echo $banyak_disp;
          ?> 
        </strong>
      </h5>
      <h5>
        <strong>Selesai : 
          <?php  
            echo $banyaknya;
          ?> 
        </strong>
      </h5>         
    </center>
	</div>
</div>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>