<?php
//setting header to json
header('Content-Type: application/json');
//set connection connection
$conn=mysqli_connect('127.0.0.1', 'aisling','', 'activity_db');
if(!$conn){
	die("Connection failed: ");
}

//execute query select  FROM activity_tracker;
$result = mysqli_query($conn,"SELECT ROUND(AVG(hr_bpm),0) AS avg_bpm, ROUND(STDDEV(hr_bpm),0) AS stddev_bpm FROM activity_tracker ORDER BY ts desc limit 15");

//loop through the returned data
$data = array();

while($row = mysqli_fetch_array( $result, MYSQLI_ASSOC )) {
	$data[] = $row;
}

//close connection
$result=mysqli_close($conn);

//now print the data
print json_encode($data);
