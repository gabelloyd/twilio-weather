<?php

// What does this do?  
// Call Twilio Number 401-441-6954.  Twilio will look for 'FromZip' and respond with the current weather. 
// If weather is not available, just say "It will be a sunny day someday!" and hang-up.

	// Look for the FromCity
	// Read City.  Twilio read the zip as a string.  This sounds better.
	// Reference URL:  https://www.twilio.com/docs/api/twiml/twilio_request
	if(!$citycode = $_REQUEST['FromCity'])
		$citycode = "New York City";
	// Look for the FromState
	// Read State for weather api.
	// Reference URL:  https://www.twilio.com/docs/api/twiml/twilio_request
	if(!$statecode = $_REQUEST['FromState'])
		$statecode = "NY";	
		
	
	//weatherunderground api query
	//try to make the area dynamically change the location.
	// Reference URL: http://www.wunderground.com/weather/api/d/docs?d=data/conditions
	$weather_url = file_get_contents("http://api.wunderground.com/api/55f2cd0398a1022a/conditions/q/19530.json");
	$weather_output = json_decode($weather_url);
	
	/* TESTING TO SEE THE DATA */
				//echo "<pre>";
				//print_r($weather_output);
				//echo "</pre>";
	
	header("content-type: text/xml");
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>

<Response>
	<Say voice="woman">The weather for <?php echo $citycode ?>, <?php echo $statecode ?>  is currently <?php echo $weather_output->weather ?> with a temperature at <?php echo $weather_output->temp_f ?> with winds <?php echo $weather_output->wind_string ?>.  Enjoy your day! Good-bye!</Say>
</Response>