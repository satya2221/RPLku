<?php
    include "koneksi.php";

    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($link,"INSERT INTO pegawai values ('$nip','$nama','$jabatan','$email','$password')");

    if($query){
        $msg = "Registrasi Berhasil";
        header("location:../login.php?pesan=regisberhasil");
    }
    else{
        $msg = "Registrasi Gagal";
        header("location:../login.php?pesan=regisgagal");
    }

