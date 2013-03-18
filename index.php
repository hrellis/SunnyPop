<!--
	index.php
    
    *main page
    **gets the IP address which allows detection of city,country
    **gets the weatehr for the city 
    **adds all this information to a database
    
    **reads in the artists stored in the database
 -->
 <?php
	//loads in the header file
	include "template/templateStart.php";

	//grab ip address
	//WARNING: if client is using proxy setiings or redirect, this will e incorrect
	$ip = $_SERVER['REMOTE_ADDR'];
	
	//when running on local host, spoof a Dundee Uni IP Address
	if($ip == "::1")
		$ip = "134.36.36.8";
	
?>
<div id="contentCol1">
    <h2>Your Location</h2>
        <?php
            //if ping to database works, it is connected so continue
            if(mysql_ping())
            {
                //YQL: get city and country
                $baseYQL = 	    "http://query.yahooapis.com/v1/public/yql?q=select%20city%2C%20country_name%20from%20pidgets.geoip%20where%20ip%3D'";
                $endYQL = "'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";
                $YQL = $baseYQL.$ip.$endYQL;
                
                //load json
                $session = curl_init($YQL);
                curl_setopt($session, CURLOPT_HEADER, false);
                curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
                $json = curl_exec($session);
                curl_close($session);
                
                //echo $json;
                
                //convert json into php object
                $yqlObject = json_decode($json);
                
                //store in variables
                $city = $yqlObject->{'query'}->{'results'}->{'Result'}->{'city'};
                $country = $yqlObject->{'query'}->{'results'}->{'Result'}->{'country_name'};
				
				//get the current week number and year
				$weekNumber = date("W");
				$year = Date("Y");
				 
                //gets the current weather for the city, country
                include "weather.php";
            }
            else //ping failed and connection not made
            {
                //print out error and try to reconnect
                echo 'Connection to database was lost. Trying again..';
                include "databaseConnection.php";	
            }
        ?>
        
        <?php
			//populate weather details of client
			//echo $weekNumber.", ".$year."<br>";
			mysql_query("INSERT INTO locationWeather (city, country, weatherType, weekNumber, year)
				VALUES ('".$city."','".$country."','".$condition."','".$weekNumber."','".$year."');");
				
            //print to screen city and county
            echo $city,', ',$country; 
            echo '<br />Weather : ',$condition;
        ?>
   </div><!--contentCol1-->
   
   <div id="contentCol2">
    <h2>Playlist</h2>
        <?php
            //reads in the music stored in dataase o albums being listened to near you
            //include "getMusic.php" 
			include "read_dB.php";
        ?>
    </div><!--contentCol2-->
    
     <div id="contentCol3">
        <?php
			//include pictures from Flickr based on search of city, country
            include "pictureFeed.php";
        ?>
     </div><!--contentCol3-->

<?php
	//loads in footer file
	include "template/templateEnd.php"
?>


	