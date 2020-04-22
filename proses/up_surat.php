<?php 
	include "koneksi.php";
    session_start();
    $email = $_SESSION['email'];
    
    $no_surat = $_POST['no_surat'];
    $tgl_input = $_POST['tgl_input'];
    $nip_pengisi = $_POST['nip_pengisi'];

    $targetfolder = "../surat/";
    $targetfolder = $targetfolder . basename( $_FILES['file_surat']['name']) ;
    $filenya  = $_FILES['file_surat']['name'];
    $file_type=$_FILES['file_surat']['type'];

    if ($file_type=="application/pdf" || $file_type=="image/jpeg") {
		 if(move_uploaded_file($_FILES['file_surat']['tmp_name'], $targetfolder))
		 {
		 	$querynya = mysqli_query($link,"INSERT INTO surat VALUES('$no_surat','$tgl_input','$nip_pengisi','$filenya')");
		 // echo "File Berhasil di Upload  file ". basename( $_FILES['file']['name']). " is uploaded";
		 header("location:../surat.php?proses=berhasil");
		 }
		 else {
		 header("location:../surat.php?proses=gagal");
		 }
	}
 ?>