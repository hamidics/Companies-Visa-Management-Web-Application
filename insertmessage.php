<?php
session_start();	
include("../db.php");
// Minimum digits to display. 0 = Default = Only Required Digits

// DO NOT EDIT BELOW THIS POINT! <-------------------------------------------------------

// Find the current hit count and increment it
//$sql="insert into messages (sender_id";
//$rsmessage=mysql_query($sql) or die (mysql_error());

while($rwmessage=mysql_fetch_array($rsmessage)){
$sqluser="select name from users where id='$rwmessage[senderid]'";
$rsuser=mysql_query($sqluser) or die (mysql_error());
$rwuser=mysql_fetch_array($rsuser);
	echo "<b>$rwuser[name]:</b>$rwmessage[message] ($rwmessage[time])<br/>";

}



?>