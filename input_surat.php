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
    date_default_timezone_set("Asia/Jakarta");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Input surat</title>
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
          <li class="nav-item active">
                  <a class="nav-link" href="surat.php">Surat <span class="sr-only">(current)</span></a>
              <?php endif; ?>    
          </li>
          <li class="nav-item">
            <a class="nav-link" href="disposisi.php">Disposisi</a>
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
    <h1>Input Surat</h1>
    <p>Masukkan surat yang baru masuk. Pastikan format sudah sesuai!</p>
    </center>
<form action="proses/up_surat.php" method="post" enctype="multipart/form-data" class="forminput_surat"style="color: white">
  <div class="form-group" style="color: white">
    <label for="input_no_surat"><h5>Input No Surat</h5></label>
    <input type="text" class="form-control" id="input_no_surat" placeholder="xxx/ddmmyyyy/category" name="no_surat" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputTanggal"><h5>Tanggal</h5></label>
      <input type="date" class="form-control" id="inputTanggal" name="tgl_input" readonly value="<?php echo date('Y-m-d');?>">
    </div>
    <div class="form-group col-md-6">
      <label for="nip_penginput"><h5>NIP Penginput</h5></label>
      <input type="text" class="form-control" id="nip_penginput" name="nip_pengisi" readonly value="<?php echo $datauser['nip'];?>">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
    <label for="inputFileSurat"><h5>Isi Surat</h5></label>
    <input type="file" class="form-control-file" id="inputFileSurat" name="file_surat" required>
    </div>
  </div>
    <center>
      <button type="submit" class="btn btn-outline-light my-1">Input Surat</button>
    </center>
</form>
</div>
</body>
</html>