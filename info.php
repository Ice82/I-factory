<?php
//phpinfo();

//include("commonSetting.php");
include("class/Conn.php");

$CNN = new Conn();

print_r($CNN->getProva());

?>