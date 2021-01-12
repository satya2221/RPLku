<?php 
	include "koneksi.php";
    require "../kripto_side/playfair.php";
    require "../kripto_side/angka_inisiasi.php";
    session_start();

    $playfair = new playfair();
    $rsa = new angka_inisiasi();

    $email = $_SESSION['email'];
    $role = $_SESSION['role'];

    $no_disposisi = $_POST['no_disposisi'];
    $no_disposisi = $rsa->enkrip($no_disposisi);
    // $isi_surat = $_POST['isi_surat'];
    $no_surat = $_POST['no_surat'];
    $no_surat = $rsa->enkrip($no_surat);
    // $tgl_terbit = $_POST['tgl_input'];
    // $disposisi_kejari  = $_POST['instruksiKajari'];
    // $pelaksana = $_POST['nip_pelaksana'];
    $respon=$_POST['respon'];

    // if ($role=="Kepala Kantor") {
    //   $isi_disposisi = $_POST['file_disposisi'];
    // 	$querynya = mysqli_query($link,"INSERT INTO lembar_disposisi 
    // 				VALUES('$no_disposisi','$isi_surat','$no_surat','$tgl_terbit','$isi_disposisi','$disposisi_kejari','$pelaksana')");
    // 	if ($querynya) {
    // 		header("location:../disposisi.php?proses=berhasil");
    // 	}
    // 	else{
    // 		header("location:../disposisi.php?proses=gagal");
    // 	}
    // }
    // if($role=="Sekretaris"){
    //   $targetfolder = "../surat/";
    //   $targetfolder = $targetfolder . basename( $_FILES['file_disposisi']['name']) ;
    //   $filenya  = $_FILES['file_disposisi']['name'];
    //   $file_type=$_FILES['file_disposisi']['type'];

    //     if ($file_type=="application/pdf" || $file_type=="image/jpeg") {
    //        if(move_uploaded_file($_FILES['file_disposisi']['tmp_name'], $targetfolder))
    //        {
    //         $querynya = mysqli_query($link,"UPDATE lembar_disposisi SET no_disposisi ='$no_disposisi', isi_surat='$isi_surat' ,    tgl_terbit='$tgl_terbit', isi_disposisi='$filenya', nip_pelaksana ='$pelaksana' WHERE no_surat ='$no_surat' ");
    //        // echo "File Berhasil di Upload  file ". basename( $_FILES['file_disposisi']['name']). " is uploaded";
    //         $status='ditugaskan';
    //         $lpj = $no_surat . ' ' . $pelaksana;
    //         $query_pel = mysqli_query($link,"INSERT INTO melaksanakan VALUES('$pelaksana','$no_disposisi','','$lpj','$status')");
    //           if ($querynya && $query_pel) {
    //              header("location:../disposisi.php?proses=berhasil");
    //           }
    //          else {
    //          header("location:../disposisi.php?proses=gagal");
    //          }
    //        }
    //     }
    // }
    if ($role=="Kepala Bagian") {
        $targetfolder = "../surat/";
        $targetfolder = $targetfolder . basename( $_FILES['file_lpj']['name']) ;
        $filenya  = $_FILES['file_lpj']['name'];
        $file_type=$_FILES['file_lpj']['type'];
            if ($filenya != "") {
                if ($file_type=="application/pdf" || $file_type=="image/jpeg") {
                    if(move_uploaded_file($_FILES['file_lpj']['tmp_name'], $targetfolder))
                    {
                        $query = mysqli_query($link,"UPDATE melaksanakan SET LPJ='$filenya', status='diselesaikan' WHERE no_disposisi='$no_disposisi' ");
                        if ($query) {
                            header("location:../disposisi.php?proses=berhasil");
                          } else {
                            header("location:../disposisi.php?proses=gagal");
                          }
                    }
                }
            } 
            else {
              //$playfair->simpan_spasi($no_surat,$respon);
              $respon = $playfair->enkripsi($no_surat,$respon);
              $query = mysqli_query($link,"UPDATE melaksanakan SET resp='$respon', status='dijalankan'WHERE no_disposisi='$no_disposisi' ");
              if ($query) {
                header("location:../disposisi.php?proses=berhasil");
              } else {
                header("location:../disposisi.php?proses=gagal");
              }
            }
    }
    elseif ($role=="Kepala Kantor") {
        $query = mysqli_query($link,"UPDATE melaksanakan SET status='selesai' ");
        if ($query) {
                header("location:../disposisi.php?proses=berhasil");
        } else {
                header("location:../disposisi.php?proses=gagal");
        }
    }
    else{
        header("location:../input_arsip.php?no_disposisi=$no_disposisi");
    }
    
 ?>