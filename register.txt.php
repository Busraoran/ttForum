<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
<body>
<style type="text/css">
                    body {
	background-size: cover;
	background: -webkit-linear-gradient(left, rgba(121, 216, 108, 0.842), rgba(122, 182, 212, 0.596));
  background: -o-linear-gradient(left,  rgba(121, 216, 108, 0.842), rgba(122, 182, 212, 0.596));
  background: -moz-linear-gradient(left, rgba(121, 216, 108, 0.842), rgba(122, 182, 212, 0.596));
  background: linear-gradient(left,  rgba(121, 216, 108, 0.842), rgba(122, 182, 212, 0.596));
   
}
</style>
<title>Kaydolma Sayfası</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">

	<div id="main-wrapper">
	<center><h2>Giriş Formu</h2></center>
		<form action="register.php" method="post">
			<div class="imgcontainer">
			<img src="logo1.png" alt="Avatar" class="avatar">
			</div>
			<div class="inner_container">
				<label><b>Kullanıcı Adı</b></label>
				<input type="text" placeholder="Kullanıcı adı girin" name="username" required>
				<label><b>Şifre</b></label>
				<input type="password" placeholder="Şifre girin" name="password" required>
				<label><b>Şifreyi Onayla</b></label>
				<input type="password" placeholder="Şifre girin" name="cpassword" required>
				<button name="register" class="sign_up_btn" type="submit">Gİriş</button>
				
				<a href="index.php"><button type="button" class="back_btn"><< Girişe Dön</button></a>
			</div>
		</form>
		
		<?php
			if(isset($_POST['register']))
			{
				@$username=$_POST['username'];
				@$password=$_POST['password'];
				@$cpassword=$_POST['cpassword'];
				
				if($password==$cpassword)
				{
					$query = "select * from userinfotbl where username='$username'";
					//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("Bu kullanıcı adı zaten var .. Lütfen başka bir kullanıcı adı deneyin!")</script>';
						}
						else
						{
							$query = "insert into userinfotbl values('$username','$password')";
							$query_run = mysqli_query($con,$query);
							if($query_run)
							{
								echo '<script type="text/javascript">alert("Kullanıcı Kayıtlı .. Hoşgeldiniz")</script>';
								$_SESSION['username'] = $username;
								$_SESSION['password'] = $password;
								header( "Location: tekrargiris.php");
							}
							else
							{
								echo '<p class="bg-danger msg-block">Kayıt Sunucu hatası nedeniyle başarısız oldu. Lütfen daha sonra tekrar deneyin</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("Veritabanı Hatası")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Şifre ve Şifreyi Onayla eşleşmiyor")</script>';
				}
				
			}
			else
			{
			}
		?>
	</div>
</body>
</html>