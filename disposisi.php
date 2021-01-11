<?php   
    include "proses/koneksi.php";
    require "kripto_side/playfair.php";

    session_start();
    $playfair = new playfair();
    if (empty($_SESSION['email'])) {
        header("location:login.php?pesan=belum_login");
    }
    elseif(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $role = $_SESSION['role'];
        $nip = $_SESSION['nip'];
        $query = mysqli_query($link,"SELECT * from pegawai where email='$email'");
        $data = mysqli_fetch_array($query);
    }
    if ($role=="Kepala Bagian") {
      $querydisp = mysqli_query($link,"SELECT * FROM lembar_disposisi ld INNER JOIN melaksanakan m on ld.no_disposisi= m.no_disposisi WHERE m.nip_pelaksana='$nip'");
       $query_pel = mysqli_query($link,"SELECT * FROM melaksanakan");
      $data_pel = mysqli_fetch_array($query_pel);
    } 
    else {
        $querydisp = mysqli_query($link,"SELECT * FROM lembar_disposisi ");
      // $querydisp1 = mysqli_query($link,"SELECT * FROM lembar_disposisi ");
      // while ($datadisp1 = mysqli_fetch_array($querydisp1)){
      //   $x=$datadisp1['no_disposisi'];
      //   $query_pel = mysqli_query($link,"SELECT * FROM melaksanakan WHERE no_disposisi = '$x'");
      //   $data_pel = mysqli_fetch_array($query_pel);
      //   if (!empty($data_pel)) {
      //     $querydisp = mysqli_query($link,"SELECT * FROM lembar_disposisi ld INNER JOIN melaksanakan m on ld.no_disposisi= m.no_disposisi");
      //     break;
      //   }
      //   else{
      //     $querydisp = mysqli_query($link,"SELECT * FROM lembar_disposisi ");
      //   }
      // }
      // if (empty($data_pel)) {
      //   $querydisp = mysqli_query($link,"SELECT * FROM lembar_disposisi ");
      // } 
      // else {
      //   $querydisp = mysqli_query($link,"SELECT * FROM lembar_disposisi ld INNER JOIN melaksanakan m on ld.no_disposisi= m.no_disposisi");
      // }
       //ld INNER JOIN melaksanakan m on ld.no_disposisi= m.no_disposisi
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Surat</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="cssnya/surat.css">
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
      <li class="nav-item active">
        <a class="nav-link" href="disposisi.php">Disposisi<span class="sr-only">(current)</span></a>
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
<div class="container my-1">
	<center class="mt-2">
	<h1>Daftar Disposisi</h1>
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
  <?php if($role=="Kepala Bagian"): ?>
  <p>Berikut Lembar disposisi yang perlu anda laksanakan</p>
  <?php else: ?>
	<p>Berikut Lembar disposisi yang sedang diproses atau sedang dilaksanakan</p>
<?php endif; ?>
	</center>
    	   <table align="center" class="table table-hover table-striped my-2 table-bordered" style="text-align: center;">
        <thead class="table-danger">
        <tr>
            <th>Nomor Disposisi</th>
            <th>Isi Disposisi</th>
            <th>Tanggal Terbit</th>
            <th>Nomor Surat</th>
            <th>Isi Surat</th>
            <th>Instruksi Kejari</th>
            <th>Pelaksana</th>
           <!--  <th>Status</th> -->
            <th>Detail</th>
        </tr>
    	</thead>
      <?php while ($datadisp = mysqli_fetch_array($querydisp)) { ?>
        <tr>
        	<td><?php echo $datadisp['no_disposisi']; ?></td>
          <td><?php echo $datadisp['isi_disposisi']; ?></td>
          <td><?php echo $datadisp['tgl_terbit']; ?></td>
          <td><?php echo $datadisp['no_surat']; ?></td>
          <td><?php echo $datadisp['isi_surat']; ?></td>
        	<td><?php print_r($playfair->dekripsi($datadisp['no_surat'],$datadisp['disposisi_kejari'])); ?></td>
          <td><?php echo $datadisp['nip_pelaksana']; ?></td>
          <!-- <?php if(empty($data_pel)): ?>
            <td>Belum ada</td>
          <?php else: ?>
          <td><?php echo $datadisp['status']; ?></td>
        <?php endif; ?> -->
        	<td><a href="detail_disp.php?no_disp=<?php echo $datadisp['no_disposisi']; ?>"><button class="btn btn-danger btn-sm">Detail</button></a>
               <?php if ($role == "Kepala Kantor"||$role == "Sekretaris"): ?>
              <a href="disposisi_kejari.php?no_surat=<?php echo $datadisp['no_surat']; ?>"><button class="btn btn-danger btn-sm m-1">buat disposisi</button></a>
            <?php endif; ?>
          </td>
        </tr>
         <?php } ?>
    </table>
    </div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>