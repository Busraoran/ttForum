<!DOCTYPE html>
<html>
<head>
  <title>Veritabanı Yönetimi - Ekle</title>
  <meta charset="UTF-8">
</head>
   <header>
    <?php
        include 'ayarlar.php';
    ?>
   </header>
   <body>
    <?php
        if(isset($_POST['submit'])){
            $isim=$_POST['isim'];
            $soyisim=$_POST['soyisim'];
            $sql = "INSERT INTO bilgiler (ISIM, SOYISIM) 
                                                VALUES('$isim', '$soyisim')";
            if($baglanti->query($sql) == TRUE){
                echo "Kayıt eklendi...";
            } else {
                echo $baglanti->error;
            }
        }
    ?>
    <form method="POST" action="">
          İsim: <input type="text" name="isim"><br>
          Soyisim: <input type="text" name="soyisim"><br>
         <br>
         <input type="submit" name="submit" value="Ekle">
    </form>
    <br><a href='listele.php'>Kayıtları listele</a>
   </body>
</html>