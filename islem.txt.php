<?php 

require_once 'dbconfig/config.php';


if (isset($_POST['insertislemi'])) {
	
	

	$kaydet=$db->prepare("INSERT into konular set
		username=:username,
		
		");

	$insert=$kaydet->execute(array(

		'username' => $_POST['username'],
		
	));

	

	if ($insert) {
		
		//echo "kayıt başarılı";

		Header("Location:index.php?durum=ok");
		exit;

	} else {

		//echo "kayıt başarısız";
		Header("Location:index.php?durum=no");
		exit;
	}



}


if (isset($_POST['updateislemi'])) {
	
	$username=$_POST['username'];

	$kaydet=$db->prepare("UPDATE bilgilerim set
		username=:username,
		
		where konular={$_POST['username']}
		");

	$insert=$kaydet->execute(array(

		'username' => $_POST['username'],
		
	));

	

	if ($insert) {
		
		//echo "kayıt başarılı";

		Header("Location:duzenle.php?durum=ok&username=$username");
		exit;

	} else {

		//echo "kayıt başarısız";
		Header("Location:duzenle.php?durumno&username=$username");
		exit;
	}



}

if ($_GET['username']=="ok") {
	

	$sil=$db->prepare("DELETE from konular where username=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['username']
	));

	if ($kontrol) {
		
		//echo "kayıt başarılı";

		Header("Location:index.php?durum=ok");
		exit;

	} else {

		//echo "kayıt başarısız";
		Header("Location:index.php?durum=no");
		exit;
	}


}

?>