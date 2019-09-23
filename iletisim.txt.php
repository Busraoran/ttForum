<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="style.css"/>
	<link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
   <style>
        #HARITA_M {

            height: 450px;
            width: 750px;
            margin-left:350px;
            top: 70px;
        }
    </style>
        <script src="http://maps.google.com/maps/api/js?sensor=false">
            </script>
        <script>
            if (navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(showCurrentLocation);
            }
        else
        {
            alert("Geolocation API DESTEKLENMIYOR");
        }

        function showCurrentLocation(position)
        {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var coords = new google.maps.LatLng(latitude, longitude);
            var mapOptions = {
                zoom: 20,
                center: coords,
                mapTypeControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
           
            //HARITAYI OLUSTUR VE HTML5 DIV ICINE KOY

            map = new google.maps.Map(
                                      document.getElementById("HARITA_M"), mapOptions
                                      );
                                      //ILK ISARETLEYICIYI KOY
                                      var marker = new google.maps.Marker({
                                                                          position: coords,
                                                                          map: map,
                                                                          title: "BULUNULAN KONUM!"
                                                                          });
        }
        </script>
    </head>
    
    <body>
    <div id='cssmenu'>
            <ul>
            <li><a href='anasayfa.php'><span>anasayfa</span></a></li>
            <li id="news"><a href="hakkimizda.php">Hakkımızda</a></li>
            <li id="about"><a href="konu.php"> Konular </a></li>
            <li class='active' id="contact"><a href="iletisim.php"> İletişim </a></li>
    </ul>
    </div>
        <div>
            <div id="HARITA_M"></div>
        </div>
        <form action="index.php" method="post">
			<div class="cikis">
                <button class="logout_button">Çıkış Yap</button>
			</div>
		</form>
    </body>
</html>