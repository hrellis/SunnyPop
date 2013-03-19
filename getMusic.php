<!--
	getMusic.php
    
    *Grabs the artist name from Last.fm from most listened to
    **adds the name to dB
    **adds the week info 
 -->
 
 <?php
	include "databaseConnection.php";
	
	if($db_found)//if dB is found
	{
		//get current songs from Last.fm being listened to
		//add to dB
		if(mysql_ping())
		{
			//YQL: get artist name
			$baseYQL = "http://query.yahooapis.com/v1/public/yql?q=select%20a.content%20from%20html%20where%20url%3D%22http%3A%2F%2Fwww.last.fm%2F%22%20and%20xpath%3D'%2F%2F*%5B%40id%3D%22scrobbleStream%22%5D%2Fli%5B1%5D%2Fdiv%2Fdiv%5B1%5D%2Fstrong%5B2%5D'%20&format=json&callback=cbfunc";
			$YQL = $baseYQL;
			
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
			$artist = $yqlObject->{'query'}->{'results'}->{'strong'};
			echo 'Artist: '.$artist;
		}
		else //ping failed and connection not made
		{
			//print out error and try to reconnect
			echo 'Connection to database was lost. Trying again..';
			include "databaseConnection.php";	
		}
		
	}
		//add artist to dB
		mysql_query("INSERT INTO music (artist, albumTitle, songTitle, urlOfSong, weekNumber, year)
				VALUES (".$artist."','NULL', 'NULL','". $urlOfSOng."','".$weekNumber."','".$year."');");
?>