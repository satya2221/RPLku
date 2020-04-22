<?php 
	include "koneksi.php";
    session_start();

    $no_arsip = $_POST['no_arsip'];
    $no_surat = $_POST['no_surat'];
    $isi_surat = $_POST['isi_surat'];
    $no_disposisi = $_POST['no_disposisi'];
    $isi_disposisi = $_POST['isi_disposisi'];
    $lpj = $_POST['LPJ'];

    $query = mysqli_query($link,"INSERT INTO arsip VALUES('$no_arsip','$no_surat','$isi_surat','$no_disposisi','$isi_disposisi','$lpj' )");
    // $query_pel = mysqli_query($link,"DELETE FROM melaksanakan WHERE no_disposisi='$no_disposisi' ");
    // $query_surat = mysqli_query($link,"DELETE FROM surat WHERE no_surat ='$no_surat' ");
    // $query_disp = mysqli_query($link,"DELETE FROM lembar_disposisi WHERE no_disposisi='$no_disposisi' ");
    if ($query) {
    	header("location:../arsip.php?proses=berhasil");
    }
    else{
    	header("location:../arsip.php?proses=gagal");
        
    }