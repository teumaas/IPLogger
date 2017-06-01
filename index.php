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

	$sql = "INSERT INTO IPLogs (IP, Hostname, Port, UserAgent)
	VALUES ('$IP', '$HOST', '$PORT', '$USER')";

	$conn->query($sql);

	$sqlJSON = "SELECT id, IP, Hostname, Port, UserAgent, Date FROM IPLogs";

	$result = $conn->query($sqlJSON);

	$header = array (
		array (
			'name' => 'id',
			'title' => 'ID',
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
			'title' => 'UserAgent',
		),
		array (
			'name' => 'Date',
			'title' => 'Date',
		),
	);

	while($row = $result->fetch_assoc())
	{	
		$log[] = array(
		"id" => $row['id'],
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