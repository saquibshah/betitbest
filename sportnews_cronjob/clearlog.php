<?php
//We run this thing from command line.
error_reporting(0);

// Create connection
$con=mysqli_connect("localhost","db1029865-news","8WYYMBxQDyj5","db1029865-sportnews");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_set_charset($con,"utf8");

//Delete log that is older than a weeks
$last7Days = strtotime('-7 days');
$sql = "DELETE FROM sportnews_log where `created_on`< $last7Days";
mysqli_query($con, $sql);

// Close connections
mysqli_close($con);

echo "Timestamp of created_on 7 days ago ".$last7Days."\n";
echo "Ran successfully\n";
exit;