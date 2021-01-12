<?php   
    include "proses/koneksi.php";
    require "kripto_side/angka_inisiasi.php";
    session_start();
    $rsa = new angka_inisiasi();
    if (empty($_SESSION['email'])) {
        header("location:login.php?pesan=belum_login");
    }
    elseif(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $role = $_SESSION['role'];
        $nip = $_SESSION['nip'];
        $query = mysqli_query($link,"SELECT * from pegawai where email='$email'");
        $datauser = mysqli_fetch_array($query);
    }
    if ($role=="Kepala Bagian") {
      $queryarsip = mysqli_query($link,"SELECT * FROM arsip a INNER JOIN melaksanakan m on a.no_disposisi= m.no_disposisi WHERE m.nip_pelaksana='$nip'");
    }
    else{
       $queryarsip = mysqli_query($link,"SELECT * FROM arsip a INNER JOIN melaksanakan m on a.no_disposisi= m.no_disposisi");
    }
    $no_jabatan = $datauser['nip'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Arsip</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body style="background-color: #aceacc">
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #00923f;">
  <a class="navbar-brand" href="#"><img src="cssnya/asset/Kejaksaan_Agung_Republik_Indonesia.png" width="45" height="45"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
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
      <li class="nav-item active">
        <a class="nav-link" href="arsip.php">Arsip<span class="sr-only">(current)</span></a>
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
      <span style="color: white"><?php  echo $datauser['nama'];?></span>  
      <a href="proses/logout.php"><button class="btn btn-outline-dark my-2 my-sm-0 mx-2" style="color: white">Logout</button></a>
  </div>
</nav>
<div class="container my-1">
	<center class="mt-2">
	<h1>Arsip</h1>
  <?php if (isset($_GET['proses'])){
                  if($_GET['proses']=="berhasil"){
  ?>
            <center><h3>Proses Berhasil</h3></center>
  <?php } 
                  else {
  ?>
           <center><h3>Proses Gagal</h3></center>
  <?php           } 
        } 
  ?>
	<p>Berikut daftar surat dan disposisi yang sudah diselesaikan</p>
	</center>
    	   <table align="center" class="table table-hover table-striped my-2 table-bordered" style="text-align: center;">
        <thead class="table-danger">
        <tr>
            <th>Nomor Arsip</th>
            <th>Nomor Surat</th>
            <?php if($role!="Kepala Bagian"): ?>
            <th>Isi Surat</th>
            <?php endif; ?>
            <th>Nomor Disposisi</th>
            <th>Isi Disposisi</th>
            <th>LPJ</th>
        </tr>
    	</thead>
      <?php while ($dataarsip = mysqli_fetch_array($queryarsip)) { ?>
        <tr>
        	<td><?php print_r($rsa ->for_dekrip($no_jabatan, $dataarsip['no_arsip'])); ?></td>
        	<td><?php print_r($rsa ->for_dekrip($no_jabatan, $dataarsip['no_surat'])) ; ?></td>
          <?php if($role!="Kepala Bagian"): ?>
        	<td><a href="detail_surat.php?isi_surat=<?php echo $dataarsip['isi_surat']; ?>" target="blank"><?php echo $dataarsip['isi_surat']; ?></a></td>
          <?php endif; ?>
        	<td><?php print_r($rsa ->for_dekrip($no_jabatan, $dataarsip['no_disposisi'])) ; ?></td>
          <td><a href="detail_surat.php?isi_surat=<?php echo $dataarsip['isi_disposisi']; ?>" target="blank"><?php echo $dataarsip['isi_disposisi']; ?></a></td>
          <td><a href="detail_surat.php?isi_surat=<?php echo $dataarsip['isi_lpj']; ?>" target="blank"><?php echo $dataarsip['isi_lpj']; ?></a></td>
        </tr>
      <?php } ?>
    </table>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>