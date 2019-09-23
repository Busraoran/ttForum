<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>kolay video dersleri</title>
	<link rel="stylesheet" href="style.css"/>
	<link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
</head>
<body>
	
	<div id='cssmenu'>
        <ul>
		<li  class='active'><a href='anasayfa.php'><span>anasayfa</span></a></li>
        <li id="news"><a href="hakkimizda.php">Hakkımızda</a></li>
        <li id="about"><a href="konu.php"> Konular </a></li>
		<li id="contact"><a href="iletisim.php"> İletişim </a></li>
</ul>
</div>
<div class="ara">
<form action="index.php?islem=ara" method="post">

<input type="text" name="ara"/><button type="submit" >ara</button>
<form action="index.php" method="post">
			<div class="cikis">
                <button class="logout_button">Çıkış Yap</button>
			</div>
		</form>
	
		
</form>
</div>




</body>
</html>