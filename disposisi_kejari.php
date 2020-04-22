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
    $no_surat = $_GET['no_surat'];
    $querysurat = mysqli_query($link,"SELECT * FROM surat where no_surat= '$no_surat'");
    $datasurat = mysqli_fetch_array($querysurat);

    $querydisp = mysqli_query($link,"SELECT * FROM lembar_disposisi where no_surat='$no_surat'"); 
    $datadisposisi = mysqli_fetch_array($querydisp);

    $querypelaksana = mysqli_query($link,"SELECT * from pegawai where jabatan='Kepala Bagian'");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Disposisi</title>
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
              <a class="nav-link" href="surat.php">Surat </a>
          <?php endif; ?>    
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="disposisi.php">Disposisi<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Arsip</a>
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
    <h1>Disposisi</h1>
    <p>Buat disposisi dari surat</p>
    <a href="detail_surat.php?isi_surat=<?php echo $datasurat['isi_surat']; ?>" target="blank"><button class="btn btn-outline-danger mb-2">Lihat Surat</button></a>
    </center>
<form action="proses/up_disp_kejari.php" method="post" enctype="multipart/form-data" class="forminput_surat"style="color: white">
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="input_no_surat"><h5>Input No Disposisi</h5></label>
    <?php if($role=="Sekretaris"): ?>
      <p>Cek apakah sudah sesuai dengan aturan penomoran</p>
    <input type="text" class="form-control" id="input_no_surat" value="<?php echo $datadisposisi['no_disposisi'];?>" name="no_disposisi" required>
    <?php else: ?>
      <input type="text" class="form-control" id="input_no_surat" value="<?php echo $datasurat['no_surat'];?>/disp" name="no_disposisi" readonly>
    <?php endif; ?>
  </div>
  <div class="form-group col-md-6">
    <label for="input_pelaksana"><h5>Pelaksana</h5></label>
    <?php if($role=="Sekretaris"): ?>
      <p>Periksa lagi pelaksana disposisi</p>
    <?php endif; ?>
    <select class="form-control" id="input_pelaksana"name="nip_pelaksana" required>
      <?php while ($datapelaksana = mysqli_fetch_array($querypelaksana)) { ?>
      <option value="<?php  echo $datapelaksana['nip'];?>"><?php  echo $datapelaksana['nama'];?></option>
    <?php } ?>
    </select>
    <!-- <input type="text" class="form-control" id="input_pelaksana" placeholder="xxx/ddmmyyyy/category" name="nip_pelaksana" required> -->
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="input_no_surat"><h5>No Surat</h5></label>
      <input type="text" class="form-control" id="input_no_surat" name="no_surat" readonly value="<?php echo $datasurat['no_surat'];?>">
    </div>
    <div class="form-group col-md-6">
      <label for="isi_surat"><h5>Isi Surat</h5></label>
      <input type="text" class="form-control" id="isi_surat" name="isi_surat" readonly value="<?php echo $datasurat['isi_surat'];?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputTanggal"><h5>Tanggal</h5></label>
      <input type="date" class="form-control" id="inputTanggal" name="tgl_input" readonly value="<?php echo date('Y-m-d');?>">
    </div>
    <div class="form-group col-md-6">
      <?php if($role=="Sekretaris"): ?>
        <label for="inputFileDisposisi"><h5>Isi Disposisi</h5></label>
        <input type="file" class="form-control-file" id="inputFileDisposisi" name="file_disposisi" required>
      <?php else: ?>
        <label for="inputFileDisposisi"><h5>Isi Disposisi</h5></label>
        <input type="text" class="form-control" id="inputFileDisposisi" name="file_disposisi" readonly value="<?php echo $datasurat['no_surat'];?>/disp.pdf">
      <?php endif; ?>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
    <label for="instruksiDisposisi">Instruksi</label>
    <?php if($role=="Kepala Kantor"): ?>
      <textarea class="form-control" id="instruksiDisposisi" name="instruksiKajari" rows="4" required></textarea>
    <?php else: ?>
      <textarea class="form-control" id="instruksiDisposisi" name="instruksiKajari" rows="4" readonly required><?php echo $datadisposisi['disposisi_kejari'];?></textarea>
    <?php endif; ?>
    </div>
  </div>
    <center>
      <button type="submit" class="btn btn-outline-light my-1">Input Disposisi</button>
    </center>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>