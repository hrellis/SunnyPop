<?php 
	//YQL: get the weather for city and country
	$baseYQL="http://query.yahooapis.com/v1/public/yql?q=select%20item.condition.text%20from%20weather.forecast%20where%20location%20in%20(%0A%20%20select%20id%20from%20weather.search%20where%20query%3D%22";
	$endYQL = "%22)%20limit%201%3B&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";
	$YQL = $baseYQL. urlencode($city.", ".$country) .$endYQL;
	//echo $YQL;
	
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
	$condition = $yqlObject->{'query'}->{'results'}->{'channel'}->{'item'}->{'condition'}->{'text'};
?>
				