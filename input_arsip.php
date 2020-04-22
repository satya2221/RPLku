<?php   
    include "proses/koneksi.php";
    session_start();
    if (empty($_SESSION['email'])) {
        header("location:login.php?pesan=belum_login");
    }
    elseif(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $role = $_SESSION['role'];
        $query = mysqli_query($link,"SELECT * from pegawai where email='$email'");
        $datauser = mysqli_fetch_array($query);
    }
    $no_disposisi=$_GET['no_disposisi'];
    $querydisp = mysqli_query($link,"SELECT * FROM lembar_disposisi ld INNER JOIN melaksanakan m on ld.no_disposisi= m.no_disposisi WHERE ld.no_disposisi='$no_disposisi'");
    $datadisposisi = mysqli_fetch_array($querydisp);         
    $queryarsip = mysqli_query($link,"SELECT * FROM arsip");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Arsip</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="cssnya/input_surat.css">
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
	<p>Input No arsip dan arsipkan surat dan disposisi</p>
  <a href="detail_surat.php?isi_surat=<?php echo $datadisposisi['isi_surat']; ?>" target="blank"><button class="btn btn-outline-danger mb-2 mx-1">Lihat Surat</button></a>
  <a href="detail_surat.php?isi_surat=<?php echo $datadisposisi['isi_disposisi']; ?>" target="blank"><button class="btn btn-outline-danger mb-2 mx-1">Lihat Disposisi</button></a>
  <a href="detail_surat.php?isi_surat=<?php echo $datadisposisi['LPJ']; ?>" target="blank"><button class="btn btn-outline-danger mb-2 mx-1">Lihat LPJ</button></a>
	</center>
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4">
      <form class="forminput_disp" action="proses/up_arsip.php" method="post" style="color: white;">
        <div class="form-group">
          <label for="input_no_arsip">Input No Arsip</label>
          <input type="text" class="form-control" id="input_no_arsip" placeholder="xxx/ddmmyyyy/category/ars" name="no_arsip" required>
        </div>
        <div class="form-group">
          <label for="input_no_surat">No Surat</label>
          <h4><input type="text" class="form-control-plaintext" id="input_no_surat" value="<?php echo $datadisposisi['no_surat'];?>" name="no_surat" required readonly></h4>
        </div>
        <div class="form-group">
          <label for="input_no_disposisi">No Disposisi</label>
          <h4><input type="text" class="form-control-plaintext" id="input_no_disposisi" value="<?php echo $datadisposisi['no_disposisi'];?>" name="no_disposisi" required readonly></h4>
        </div>
        <div class="form-group">
          <label for="input_isi_surat">File surat</label>
          <h4><input type="text" class="form-control-plaintext" id="input_isi_surat" value="<?php echo $datadisposisi['isi_surat'];?>" name="isi_surat" required readonly></h4>
        </div>
        <div class="form-group">
          <label for="input_isi_disposisi">File disposisi</label>
          <h4><input type="text" class="form-control-plaintext" id="input_isi_surat" value="<?php echo $datadisposisi['isi_disposisi'];?>" name="isi_disposisi" required readonly></h4>
        </div>
        <div class="form-group">
          <label for="input_lpj">LPJ</label>
          <h4><input type="text" class="form-control-plaintext" id="input_lpj" value="<?php echo $datadisposisi['LPJ'];?>" name="LPJ" required readonly></h4>
        </div>
        <center>
          <button type="submit" class="btn btn-outline-light my-1">Arsipkan</button>
          <button type="submit" class="btn btn-outline-light my-1 disabled" disabled="">Edit data</button>
        </center>
      </form>
    </div>
  </div>
  
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>