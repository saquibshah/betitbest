#!/usr/local/bin/php
<html><head><meta charset="utf-8"/></head></html>
<?php

//Character encoding in right form -also added in delta.php and livescoreout.php
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");
//echo mb_internal_encoding()."<Br />";

$xmlFile='../../xmls/sportradar/ls/livescore_betitbest_delta.xml';
//$xmlFile='xmls/sportradar/ls_(18-02-15)_(18-29)/livescore_betitbest_delta.xml';
//echo time()."<br>";
$generatedFor="";
$xmlcounter=0;

echo time()."- start importing livescores.\n";
if (file_exists($xmlFile)) { 
    $xml = simplexml_load_file($xmlFile); 
     echo "<br>xml Datei vorhanden\n";
$link = mysql_connect('localhost', 'db1029865-sosu', 'bib_db_sosu');
//$link = mysql_connect('localhost', 'root', '');

    if (!$link) {
        die('Verbindung schlug fehl: ' . mysql_error());
    } else {
        echo 'Verbindung steht';
    }
mysql_select_db('db1029865-bib');
//mysql_select_db('test');
mysql_query("SET NAMES 'utf8'");

	if($xml) { 
					$generatedTime=$xml['generatedAt'];
					$xmlcounter=$xml['counter'];
					//echo "<br>test".$generatedTime;
					$XMLDATE=$generatedTime;
					if ($XMLDATE!="" || $XMLDATE!=0){
						$x_jahr=substr($XMLDATE,0,4);
						$x_monat=substr($XMLDATE,5,2);
						$x_tag=substr($XMLDATE,8,2);
						$x_stunde=substr($XMLDATE,11,2);
						$x_minute=substr($XMLDATE,14,2);
						$xmltime= mktime($x_stunde,$x_minute,0,$x_monat,$x_tag,$x_jahr);
					}
					else{
						$xmltime = 0;
					}
					
					echo "<br>XMLZEIT: ".$xmltime."<br>";
					$generatedFor=$xml['generatedFor'];
					$xmlcounter=$xml['counter'];
					echo "<br>Generiert für: ".$generatedFor;
					echo "<br>Counter: ".$xmlcounter;
					echo "<br>geändert von: delta";

					//check the previous value of the counter
					$query=mysql_query("SELECT counter FROM ls_matches_soccer_test WHERE xmltime='$xmltime' AND matchstatus!='Not started' ORDER BY matchdate DESC LIMIT 1");
					$counterFromDB=mysql_fetch_array($query);
					$counterValueFromDB=$counterFromDB['counter'];
					$counterValueFromDB=(int)$counterValueFromDB;
					echo "<br>Counter Value from DB: ".$counterValueFromDB."<br>";
					
					//check the previous value of the counter from ls_matches_soccer_counter table
					$countQuery=mysql_query("SELECT * FROM ls_matches_soccer_counter");
					$countFromCounterDB=mysql_fetch_array($countQuery);
					$countValue=$countFromCounterDB['counter'];
					$countValue=(int)$countValue;
					echo "<br>Counter Value from DB Counter: ".$countValue;
					echo "<br>Counter Last Updated By: ".$countFromCounterDB['lastchangeby']."<br>";
					
					//do something with counter values
					//if($counterValueFromDB=0 || $counterValueFromDB=""){$counterValueFromDB=1;}
					if($xmlcounter>$counterValueFromDB //&& $counterValueFromDB!=0
					){
						echo "<br>New Counter value is greater than old Counter value<br>";
					}
					
					if ($xmlcounter>($counterValueFromDB+1)){
						mysql_query("INSERT INTO `ls_matches_soccer_counter` (generatedFor, counter, lastchangeby) VALUES ('$generatedFor', '$xmlcounter', 'delta') ON DUPLICATE KEY 
						UPDATE `counter` = VALUES (counter), `lastchangeby` = VALUES(lastchangeby) ");
					}

					//$logname="main_xml2db.log";
					//$datei=fopen($logname,"a");
					//fputs($datei,"$eintragen\n\n");
					//fclose($datei);
						
					$checkrows = mysql_query("SELECT `generatedFor` FROM `ls_matches_soccer_counter` where `counter` != '$xmlcounter' Limit 1");
					
					$num_rows = mysql_num_rows($checkrows);
					$row = mysql_fetch_array($checkrows);
	
					if ($num_rows<1 && $xmlcounter>($counterValueFromDB+1)){
						mysql_query("INSERT INTO `ls_matches_soccer_counter` (generatedFor, counter, lastchangeby) VALUES ('$generatedFor', '$xmlcounter', 'delta') ON DUPLICATE KEY 
						UPDATE `counter` = VALUES (counter), `lastchangeby` = VALUES(lastchangeby) ");
						
						$num_rows=0;
					}
						
					else{
						if($xmlcounter>$countValue){
							$jetzt=time();
							$logname="counter_error_xml2db.log";
							$datei=fopen($logname,"a+");
							$eintragen=date('d.M.Y-H:i:s',$jetzt)."-".$xmlcounter."";
							fputs($datei,"$eintragen\n\n\r");
							fclose($datei);
						}
					}
					
		
	}
mysql_close();
	}

	//var_dump($xml);
	//echo $xml->getName() . "<br>";
	//echo $xml->Matchdate;
	//echo $xml->Matchdate[0];
	//print_r($xml);
?>