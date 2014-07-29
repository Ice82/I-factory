<?php 
include("../commonSetting.php");

$alberghi = $CF->getAlberghi("");
//print_r($alberghi);
foreach($alberghi AS $albergo){
	echo $albergo['ID']." - ".$albergo['RAGSOC']."<br />";
	mkdir("../alberghi/".$albergo['ID'], 0777);
}

?>