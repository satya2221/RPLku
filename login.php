<!DOCTYPE html>
<html>
<head>
	<title>Login Sistem Surat</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="cssnya/login.css">
</head>
<body class="text-center">
	<form class="form-signin" action="proses/cek_login.php" method="POST">
		<img class="mb-4" src="cssnya/asset/Kejaksaan_Agung_Republik_Indonesia.png" alt="" width="72" height="72">
		<h1 class="h3 mb-3 font-weight-normal">Sistem Surat <br> Kejaksaan Negeri Denpasar</h1>
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
                elseif($_GET['pesan']=="regisberhasil"){
        ?>
                <h5 align="center">Berhasil registrasi</h5>
        <?php        }
                elseif($_GET['pesan'] == "regisgagal"){
        ?>
                <h5 align="center">Gagal registrasi</h5>
        <?php        }
            }?>
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="" autofocus="">
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">
			<label class="mb-1"><a href="registrasi.php">Registrasi disini</a></label>
			<button class="btn btn-lg btn-primary btn-block mt-3" type="submit" value="Login">Sign in</button>
	</form>
</body>
</html>