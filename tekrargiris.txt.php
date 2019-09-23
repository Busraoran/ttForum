<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>

<!DOCTYPE html>
<html>
<head>
<title>Giriş Formu</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Kayıt işlemi başarıyla gerçekleşti.Giriş yapınız...</h2></center>
			<div class="imgcontainer">
				<img src="imgs/indir.jpg" alt="Avatar" class="avatar">
			</div>
		<form action="index.php" method="post">
		
			<div class="inner_container">
				<label><b>Kullanıcı Adı</b></label>
				<input type="text" placeholder="Kullanıcı adı girin" name="username" required>
				<label><b>Şifre</b></label>
				<input type="password" placeholder="Şifre girin" name="password" required>
				<button class="login_button" name="login" type="submit">Giriş</button>
			</div>
		</form>
		
		<?php
			if(isset($_POST['login']))
			{
				@$username=$_POST['username'];
				@$password=$_POST['password'];
				$query = "select * from userinfotbl where username='$username' and password='$password' ";
				//echo $query;
				$query_run = mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
					$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
					
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					
					header( "Location: anasayfa.php");
					}
					else
					{
						echo '<script type="text/javascript">alert("Böyle bir kullanıcı yok. Geçersiz kimlik bilgileri")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Veri tabanı hatası")</script>';
				}
			}
			else
			{
			}
		?>
		
	</div>
</body>
</html>