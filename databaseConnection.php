<!--
	databaseConnection.php
    
    *Connects to the database
 -->
 <?php
//login to database server
@ $db = mysql_pconnect('localhost','sunnypop','moodmusic1');

//report error and quit if login failed
if(!db)
{
	$_SESSION['alert'] = 'Error: Could not login to database server. Please try again later.';
	exit;	
}
else 
{
	//print "Logged in to database server";
}

//choose the correct database
$db_found = mysql_select_db('sunnyPop',$db);
?>