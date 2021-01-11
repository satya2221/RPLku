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
        $query = mysqli_query($link,"SELECT * from pegawai where email='$email'");
        $data = mysqli_fetch_array($query);
    }
    $no_disposisi = $_GET['no_disp'];
    $querydisp = mysqli_query($link,"SELECT * FROM lembar_disposisi ld INNER JOIN pegawai p on nip_pelaksana=p.nip INNER JOIN melaksanakan m on ld.no_disposisi= m.no_disposisi where ld.no_disposisi='$no_disposisi'");
    // $querysurat = mysqli_query($link,"SELECT * FROM surat where no_surat= '$no_surat'");
    // $datasurat = mysqli_fetch_array($querysurat);
    $datadisposisi = mysqli_fetch_array($querydisp);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Surat</title>
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
    <h1>Detail</h1>
    <h3><strong><?php echo $datadisposisi['no_disposisi']; ?></strong></h3>
    <a href="detail_surat.php?isi_surat=<?php echo $datadisposisi['isi_surat']; ?>" target="blank"><button class="btn btn-outline-danger mb-2 mx-1">Lihat Surat</button></a>

    <a href="detail_surat.php?isi_surat=<?php echo $datadisposisi['isi_disposisi']; ?>" target="blank"><button class="btn btn-outline-danger mb-2 mx-1">Lihat Disposisi</button></a>

    <?php if(strpos($datadisposisi['LPJ'], $datadisposisi['nip_pelaksana'])): ?>
    <a href=""><button class="btn btn-outline-danger mb-2 mx-1 disabled" disabled>Lihat LPJ</button></a>
    <?php else: ?>
      <a href="detail_surat.php?isi_surat=<?php echo $datadisposisi['LPJ']; ?>" target="blank"><button class="btn btn-outline-danger mb-2 mx-1">Lihat LPJ</button></a>
    <?php endif; ?>

    </center>
<form action="proses/up_laksanakan.php" method="post" enctype="multipart/form-data" class="forminput_disp"style="color: white">
  <div class="form-row mx-1">
  <div class="form-group col-md-6">
    <center>
    <label for="input_no_surat"><h5>No Disposisi</h5></label>
    </center>
      <h4><input type="text" class="form-control-plaintext" id="input_no_surat" value="<?php echo $datadisposisi['no_disposisi'];?>" name="no_disposisi" readonly style="text-align: center"></h4>
  </div>
  <div class="form-group col-md-6">
    <center>
    <label for="input_pelaksana"><h5>Pelaksana</h5></label>
    </center>
    <h4><input type="text" class="form-control-plaintext" id="input_no_surat" value="<?php echo $datadisposisi['nama'];?>" name="pelaksana" readonly style="text-align: center"></h4>
  </div>
  </div>
  <div class="form-row mx-1">
    <div class="form-group col-md-6">
      <center>
      <label for="input_no_surat"><h5>No Surat</h5></label>
      </center>
      <h4><input type="text" class="form-control-plaintext" id="input_no_surat" name="no_surat" readonly value="<?php echo $datadisposisi['no_surat'];?>" style="text-align: center"></h4>
    </div>
    <div class="form-group col-md-6">
      <center>
      <label for="inputTanggal"><h5>Tanggal Terbit</h5></label>
      </center>
      <h4><input type="date" class="form-control-plaintext" id="inputTanggal" name="tgl_input" readonly value="<?php echo date('Y-m-d');?>" style="text-align: center"></h4>
    </div>
  </div>
  <div class="form-row mx-1">
    <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
      <center>
        <label for="inputstatus"><h5>Status</h5></label>
        <h4><input type="text" class="form-control-plaintext" id="inputFileDisposisi" name="file_disposisi" readonly value="<?php echo $datadisposisi['status'];?>"style="text-align: center;"></h4>
        </center>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4"></div>
    <div class="form-group col-md-4">
      <center>
      <label for="inputFileDisposisi"><h5>LPJ</h5></label>
      </center>
      <?php if($role=="Kepala Bagian"): ?>
        <center><p>Format file : xxx/ddmmyyyy/lpj/(nomor jabatan)</p></center>
      <?php if($datadisposisi['resp']===''): ?>
        <!-- <input type="file" class="form-control-file" id="inputFileDisposisi" name="file_lpj" readonly> -->
      <?php else: ?>
        <input type="file" class="form-control-file" id="inputFileDisposisi" name="file_lpj" required>
      <?php endif; ?>
      <?php else: ?>
            <h4><input type="text" class="form-control-plaintext" id="inputFileDisposisi" name="file_lpj" value="<?php echo $datadisposisi['LPJ'] ?>" style="text-align: center;" required readonly></h4>
      <?php endif; ?>
    </div>
  </div>
  <div class="form-row mx-1">
  <div class="form-group col-md-6">
    <center><label for="instruksiDisposisi"><h5>Instruksi</h5></label></center>
      <textarea class="form-control" id="instruksiDisposisi" name="instruksiKajari" rows="4" readonly><?php print_r($playfair->dekripsi($datadisposisi['no_surat'],$datadisposisi['disposisi_kejari']));?></textarea>
  </div>
    <div class="form-group col-md-6">
      <center><label for="responDisposisi"><h5>Respon</h5></label></center>
      <?php if($role=="Kepala Bagian"): ?>
        <textarea class="form-control" id="responDisposisi" name="respon" rows="4" required><?php print_r($playfair->dekripsi($datadisposisi['no_surat'],$datadisposisi['resp']));?></textarea>
      <?php else: ?>
       <textarea class="form-control" id="responDisposisi" name="respon" rows="4" readonly required><?php print_r($playfair->dekripsi($datadisposisi['no_surat'],$datadisposisi['resp']));?></textarea>
      <?php endif; ?>
    </div>
  </div>
    <center>
      <?php if($role=="Kepala Bagian"): ?>
        <button type="submit" class="btn btn-outline-light my-1">Submit</button>
      <?php else: ?>
        <?php if(strpos($datadisposisi['LPJ'], $datadisposisi['nip_pelaksana'])): ?>
        <button type="submit" class="btn btn-outline-light my-1 disabled" disabled>Disposisi selesai</button>
        <?php else: ?>
          <?php if($role=="Kepala Kantor"): ?>
            <button type="submit" class="btn btn-outline-light my-1">Disposisi selesai</button>
          <?php else: ?>
            <?php if($datadisposisi['status'] != "selesai"): ?>
              <button type="submit" class="btn btn-outline-light my-1 disabled" disabled>Arsipkan Disposisi</button>
            <?php else: ?>
              <button type="submit" class="btn btn-outline-light my-1">Arsipkan Disposisi</button>
            <?php endif; ?>
          <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>
    </center>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>