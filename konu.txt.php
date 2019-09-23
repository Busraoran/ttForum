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
	<li><a href='anasayfa.php'><span>anasayfa</span></a></li>
   <li><a href='hakkimizda.php'><span>hakkımızda</span></a></li>
   <li class='active'><a href='konu.php'><span>konular</span></a></li>
   <li><a href='iletisim.php'><span>iletisim</span></a></li>
</ul>
</div>
<div class="ara">
<form action="index.php?islem=ara" method="post">
<input type="text" name="ara"/><button type="submit" >ara</button>
</form>
</div>
<form action="index.php" method="post">
			<div class="cikis">
                <button class="logout_button">Çıkış Yap</button>
			</div>
		</form>



</body>
</html>
<?php 
try{
	
	$db = new PDO("mysql:host=localhost;dbname=blog;charset=utf8","root","");
	
}catch(PDOException $mesaj){
	
	
	echo $mesaj->getmessage();
	
}

$islem = @$_GET["islem"];

switch ($islem){
	
	case "ara":
	
	if($_POST){
		
		$ara = $_POST["ara"];
		
		if(!$ara){
			echo "lutfen bos bırakmayın";			
		}else{
			$v = $db->prepare("select * from konular  where konu_baslik regexp ? order by konu_id desc");
		$v->execute(array($ara));
		$x = $v->fetchAll(PDO::FETCH_ASSOC);
		$xx = $v->rowCount();
		if($xx){
		echo "<div style='font-size:22px;color:green;position:relative; left:400px;'>aramanızla ilgili ".$xx." sonuc bulundu</div>";	
		foreach($x as $m){
			?>
			 <div class="konu">
		<h3><?php echo $m["konu_baslik"];?></h3>
		<h5>ekleyen : <?php echo $m["konu_ekleyen"];?> <span>tarih : <?php echo $m["konu_tarih"];?></h5>
		<p><?php echo substr($m["konu_aciklama"],0,200);?></p>
		<div class="x"><a href="index.php?islem=devam&id=<?php echo $m["konu_id"];?>">devamı</a></div>
	    </div>
			<?php	
		}
		}else{
			echo "<div style='font-size:22px;color:red;position:relative; left:400px;'>hiç sonuc bulunamadı</div>";
		}	
	}
  }
		
	break;
	case "devam":
	$id =  @$_GET["id"];
	 $v = $db->prepare("select * from konular where konu_id=?");
	  $v->execute(array($id));
	 $x =  $v->fetchAll(PDO::FETCH_ASSOC);
	  $xx = $v->rowCount();
	  if($xx){
		  foreach($x as $m){
			  ?>
			  <div class="devam">
				<h3><?php echo $m["konu_baslik"];?></h3>
				<h5>ekleyen : <?php echo $m["konu_ekleyen"];?> <span>tarih : <?php echo $m["konu_tarih"];?></span></h5>
				<p><?php echo $m["konu_aciklama"];?></p>
				</div>
			  <?php	  
		  }
		  
		 // konu hit baslangıc
		 if(!@$_COOKIE["hit".$id]){
		 $hit = $db->prepare("update konular set konu_hit= konu_hit +1 where konu_id=?");
		 $hit->execute(array($id));
		 
		 setcookie("hit".$id,"_",time ()+9898989898);
		 }
		 // konu hit bitis
		
		
		  
		  // yorumları listele
		  
		  $c = $db->prepare("select * from yorumlar where yorum_konu_id=?");
		  
		  $c->execute(array($id));
		  
		  $x = $c->fetchAll();
		  $xx = $c->rowCount();
		  
		  if($xx){
			
            echo "<div class='w'>bu konuya (".$xx.") yorum yazılmıs</div>";		
			foreach($x as $b){
				
				
				?>
				
				<div class="yorum">
				<h4> ekleyen : <?php echo $b["yorum_ekleyen"];?> <span>tarih :  <?php echo $b["yorum_tarih"];?></h4>
				<p><?php echo $b["yorum_mesaj"];?></p>
				</div>
				
				<?php
				
			}  
			  
			  
		  }else{
			  
			echo "<div class='mesajiniz'>bu konuya hic yorum yazılmamıs ilk yazan sen ol</div>";  
			  
		  }
		  
		  
		  
		  // yorumları listele bitisi
		  
		  // yorumları ekleyelim
		  if($_POST){
			 
              $isim	    = $_POST["isim"];		 
              $eposta	= $_POST["eposta"];		 
              $mesaj	= $_POST["mesaj"];		 
              $konuid   = $_POST["konuid"];		 
			  
			  if(!$isim || !$eposta || !$mesaj){
				  
				  echo "gerekli alanları doldurmanız gerekiyor";
				  
			  }else{
			  $c = $db->prepare("insert into yorumlar set 
			  
			                 yorum_ekleyen=?,
							 yorum_eposta=?,
			                 yorum_mesaj=?,
                             yorum_konu_id=? 							 
			  
			  ");
			  
			 $x = $c->execute(array($isim,$eposta,$mesaj,$konuid));
			 
			 
			 if($x){
				 
				 
				 echo "<div class='mesajiniz'>mesajınız basarılı bir sekilde gonderilmistir yonlendiriliyorsunuz</div>";
				 $url = $_SERVER['HTTP_REFERER'];  // hangi sayfadan gelindigi degerini verir.

				 header ("refresh: 2; url=".$url."");
				 
			 }else{
				 
				 echo "yorum gonderirken bir hata olustu";
				 
			 }
			 
			  }
		  }else{
			  
			 ?>
			 <div class="yorumlar">
			  <h2>yorum gonder</h2>
             <form action="" method="post">
			 <table cellpadding="5" cellspacing="5">
			 <tr>
			 <td>isim</td>
			 <td><input type="text" name="isim"/></td>
			 </tr>
			 <tr>
			 <td>eposta</td>
			 <td><input type="text" name="eposta"/></td>
			 </tr>
			 <tr>
			 <td>mesaj</td>
			 <td><textarea name="mesaj" id="" cols="50" rows="10"></textarea></td>
			 </tr>
			 <tr>
			 <td></td>
			 <td><input type="hidden" name="konuid" value="<?php echo $m["konu_id"];?>"/></td>
			 </tr>
			  <tr>
			 <td></td>
			 <td><button type="submit">mesaj gonder</button></td>
			 </tr>
			 </table>
			 </form>
			 </div>
			 
             <?php			 
			  
			  
		  }
		  // yorum ekleme bitisi
		  
		  
	  }else{
		  echo "boyle bir konu yok silinmis yada hiç var olmamıs olabilir";
	  }


	break;
	
	case "iletisim":
	echo "burası iletisim";
	break;
	
	case "hakkimda":
	echo "hakkimda";
	break;

	default:
   // sayfalama
   $sayfa = intval(@$_GET["sayfa"]);
   if(!$sayfa){
	   $sayfa = 1;
   }
   $v = $db->prepare("select * from konular");
   $v->execute(array());
   $toplam = $v->rowCount();
   $limit = 2;
   $goster = $sayfa*$limit-$limit; 
   $sayfa_sayisi = ceil($toplam/$limit);
   $forlimit = 2;
   
   // sayfalama bitis
	
	
	$v = $db->query("select * from konular  order by konu_id desc limit $goster,$limit");
	
	$v->execute(array());
	$x = $v->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($x as $m){
		
		// konuya ait yorum sayısını bul
		
		$v = $db->prepare("select * from yorumlar where yorum_konu_id=?");
		$v->execute(array($m["konu_id"]));
		$zban = $v->rowCount();
		
		
		
		?>
		
	    <div class="konu">
		<h3><?php echo $m["konu_baslik"];?></h3>
		<h5>ekleyen : <?php echo $m["konu_ekleyen"];?> yorum : (<?php echo $zban;?>) goruntulenme : <?php echo $m["konu_hit"];?><span>tarih : <?php echo $m["konu_tarih"];?></span></h5>
		<p><?php echo substr($m["konu_aciklama"],0,200);?>....</p>
		<div class="x"><a href="index.php?islem=devam&id=<?php echo $m["konu_id"];?>">devamı</a></div>
	    </div>
		<?php
	}
	
	// sayfalam linkleri
	
	for($i = $sayfa - $forlimit; $i<$sayfa + $forlimit +1; $i++){
		
		if($i>0 && $i<= $sayfa_sayisi){
			
			if($i == $sayfa){
				echo "<span class='aktif'>".$i."</span>";
			}else{
				
				echo "<span class='sayfa'><a href='index.php?sayfa=".$i."'>".$i."</a></span>";
			}
		}
	}
	if($sayfa != $sayfa_sayisi){
	echo "<span class='sayfa'><a href='index.php?sayfa=".$sayfa_sayisi."'>son</a></span>";
	}
	break;
	
	


}






?>