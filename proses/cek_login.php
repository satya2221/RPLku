<?php 
    session_start();
    include "koneksi.php";
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $query = mysqli_query($link,"SELECT * FROM pegawai where email='$email' and pass='$password'") or die (mysqli_error($link));
    $data = mysqli_fetch_array($query);
    $role = $data['jabatan'];
    $nip = $data['nip'];
    $cek = mysqli_num_rows($query);
    if($cek >0){
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['nip'] = $nip;
        $_SESSION['status'] = "login";
        header("location:../home.php");
    }
    else{
        header("location:../login.php?pesan=gagal");
    }
?>