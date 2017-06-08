<?php		
		$servername = "";
		$username = "";
		$password = "";
		$dbname = "";

		$conn = new mysqli($servername, $username, $password, $dbname);
				
		$IP = $_SERVER['REMOTE_ADDR'];
		$HOST = gethostbyaddr($_SERVER['REMOTE_ADDR']);
		$PORT = $_SERVER['REMOTE_PORT'];
		$USER = $_SERVER['HTTP_USER_AGENT'];
		
		$getCountry = 'http://ip-api.com/line/' . $IP .'?fields=countryCode';
		$getCity = 'http://ip-api.com/line/' . $IP .'?fields=city';
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $getCountry);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$COUNTRY = strtolower(curl_exec($ch));
		curl_close($ch);
						
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $getCity);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$CITY = curl_exec($ch);
		curl_close($ch);

		$sql = "INSERT INTO IPLogs (IP, Country, City, Hostname, Port, UserAgent) VALUES ('$IP', '$COUNTRY', '$CITY', '$HOST', '$PORT', '$USER')";
		$conn->query($sql);
		
		$sqlJSON = "SELECT ID, Country, City, IP, Hostname, Port, UserAgent, Date FROM IPLogs";
		$result = $conn->query($sqlJSON);

		$header = array (
			array (
				'name' => 'ID',
				'title' => 'ID',
			),
			array (
				'name' => 'Country',
				'title' => 'Country',
			),
			array (
				'name' => 'City',
				'title' => 'City',
			),
			array (
				'name' => 'IP',
				'title' => 'IP',
			),
			array (
				'name' => 'Hostname',
				'title' => 'Hostname',
			),
			array (
				'name' => 'Port',
				'title' => 'Port',
			),
			array (
				'name' => 'UserAgent',
				'title' => 'User Agent',
			),
			array (
				'name' => 'Date',
				'title' => 'Date',
			),
		);
		
		while($row = $result->fetch_assoc())
		{	
			$log[] = array(
			"ID" => $row['ID'],
			"Country" => '<span class="flag-icon flag-icon-' . $row['Country'] . '"></span>',
			"City" => $row['City'],
			"IP" => '<a href="https://iplookup.flagfox.net/?ip=' . $row['IP'] . '&host='. $row['Hostname'] . '" target="_blank">' . $row['IP'] .'</a>',
			"Hostname" => $row['Hostname'],
			"Port" => $row['Port'],
			"UserAgent" => $row['UserAgent'],
			"Date" => $row['Date']
			);
		}

		$json_data = $log;
		$json_headers = $header;
			
		$fh = fopen("headers.json", 'w') or die("Error opening output file");
		$fd = fopen("data.json", 'w') or die("Error opening output file");
		fwrite($fh, json_encode($json_headers, JSON_UNESCAPED_UNICODE));
		fwrite($fd, json_encode($json_data, JSON_UNESCAPED_UNICODE));
		fclose($fd);
		fclose($fh);
			
		$conn->close();
?>
