<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Surat</title>
    <link rel="stylesheet" type="text/css" href="cssnya/login.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="text-center">
<form class="form-signin" action="proses/p_regist.php" method="POST">
    <img class="mb-4" src="cssnya/asset/Kejaksaan_Agung_Republik_Indonesia.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Registrasi</h1>
    <?php
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
            ?>
            <h5 align="center">Login gagal! Email dan/atau password salah!</h5>
            <?php
        }
        elseif ($_GET['pesan'] == "belum_login") {
            ?>
            <h5 align="center">Anda belum Login</h5>
            <?php
        }
        elseif ($_GET['pesan'] == "logout"){
            ?>
            <h5 align="center">berhasil logout</h5>
        <?php     }
    }?>
    <label for="inputEmail" class="sr-only">NIP</label>
    <input type="text" id="inputEmail" name="nip" class="form-control nip" placeholder="NIP" required="" autofocus="">
    <label for="inputPassword" class="sr-only">Nama</label>
    <input type="text" id="inputPassword" name="nama" class="form-control nama" placeholder="Nama" required="">

    <label for="inputPassword" class="sr-only">Jabatan</label>
    <input type="text" id="inputPassword" name="jabatan" class="form-control" placeholder="Jabatan" required="">

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">

    <label class="mb-1">Kontak admin untuk proses selanjutnya</label>
    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" value="Login">Daftar</button>
</form>
</body>
</html>