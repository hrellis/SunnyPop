<!--
	pictureFeed.php
    
    *Searches Flickr for pictures tagged with Dundee
    **prints them to screen
 -->
 
 <?php
	echo "<h2>". $city . "'s Photos</h2>";
 
	/*?>//YQL: get pictures from the city, max 2 from Flickr
	//set up API keys
	// Include the PHP SDK.  
	include_once("yosdk/lib/Yahoo.inc");  
	  
	// Define constants to store your API Key (Consumer Key) and  
	// Shared Secret (Consumer Secret).  
	define("API_KEY","86b7a029642504b247d7de33b7ea70a6");  
	define("SHARED_SECRET","9c929534513c62b8"); 
	
	//send API key info
	$two_legged_app = new YahooApplication(API_KEY,SHARED_SECRET);
	$flickr_query =  "select * from flickr.photos.search where text=\"".$city."\"limit 2";
	$flickrResponse = $two_legged_app->query($flickr_query);  
	var_dump($flickrResponse);<?php */
	
?>

<img HEIGHT="30%" WIDTH="35%"src="http://farm3.staticflickr.com/2215/2115098996_e62215243d_z.jpg" />
<p> Flickr username: "Jim Gove" </p>