<?php 
	include "koneksi.php";
	require "../kripto_side/playfair.php";

    session_start();
    $playfair = new playfair();
    $email = $_SESSION['email'];
    $role = $_SESSION['role'];

    $no_disposisi = $_POST['no_disposisi'];
    $isi_surat = $_POST['isi_surat'];
    $no_surat = $_POST['no_surat'];
    $tgl_terbit = $_POST['tgl_input'];
    $disposisi_kejari  = $_POST['instruksiKajari'];
    $pelaksana = $_POST['nip_pelaksana'];


    if ($role=="Kepala Kantor") {
      $isi_disposisi = $_POST['file_disposisi'];
      $playfair->simpan_spasi($no_surat,$disposisi_kejari);
      $disposisi_kejari = $playfair->enkripsi($no_surat,$disposisi_kejari);
    	$querynya = mysqli_query($link,"INSERT INTO lembar_disposisi 
    				VALUES('$no_disposisi','$isi_surat','$no_surat','$tgl_terbit','$isi_disposisi','$disposisi_kejari','$pelaksana')");
    	if ($querynya) {
    		header("location:../disposisi.php?proses=berhasil");
    	}
    	else{
    		header("location:../disposisi.php?proses=gagal");
    	}
    }
    elseif($role=="Sekretaris"){
      $targetfolder = "../surat/";
      $targetfolder = $targetfolder . basename( $_FILES['file_disposisi']['name']) ;
      $filenya  = $_FILES['file_disposisi']['name'];
      $file_type=$_FILES['file_disposisi']['type'];

        if ($file_type=="application/pdf" || $file_type=="image/jpeg") {
           if(move_uploaded_file($_FILES['file_disposisi']['tmp_name'], $targetfolder))
           {
            $querynya = mysqli_query($link,"UPDATE lembar_disposisi SET no_disposisi ='$no_disposisi', isi_surat='$isi_surat' ,    tgl_terbit='$tgl_terbit', isi_disposisi='$filenya', nip_pelaksana ='$pelaksana' WHERE no_surat ='$no_surat' ");
           // echo "File Berhasil di Upload  file ". basename( $_FILES['file_disposisi']['name']). " is uploaded";
            $status='ditugaskan';
            $lpj = $no_surat . ' ' . $pelaksana;
            $query_pel = mysqli_query($link,"INSERT INTO melaksanakan VALUES('$pelaksana','$no_disposisi','','$lpj','$status')");
              if ($querynya && $query_pel) {
                 header("location:../disposisi.php?proses=berhasil");
              }
             else {
             header("location:../disposisi.php?proses=gagal");
             }
           }
        }
    }
   
 ?>