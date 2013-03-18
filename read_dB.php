<!--
	read_dB.php
    
    *iterates through the dB and prints all the rows to screen
 -->
 
 <?php

if($db_found)//if dB is found
{
	$SQL = "SELECT artistName,songTitle,urlOfSong FROM music";
	$result = mysql_query($SQL);
	$db_field = mysql_fetch_assoc($result);
	
	//prints out first item
	print "<a href='".$db_field['urlOfSong'] ."'>";
		print $db_field['artistName'] ." - ";
		print $db_field['songTitle']."</a><BR>";
	
	//iterate through entre dB table
	//adds url to Last.fm playlist for artist
	while ($db_field = mysql_fetch_assoc($result)) 
	{
		print "<a href='".$db_field['urlOfSong'] ."'>";
		print $db_field['artistName'] ." - ";
		print $db_field['songTitle']."</a><BR>";
	}
	//print "Database found";
	mysql_close($db);
}
else //print error message
{
	print "Database not found";
}

?>