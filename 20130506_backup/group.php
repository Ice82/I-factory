<?php 


$citta= strtolower($_REQUEST['citta']);

if ($citta != ""){
	$url = 'http://api.groupon.de/api/v1/deals/oftheday/IT/'.$citta;
	//echo $dati;
	$dati = simplexml_load_file(rawurldecode($url));
	/*echo "<pre>";
	print_r($dati);
	echo "</pre>";*/ 
	//$xml = simplexml_load_file(rawurldecode('http://aziende.freecomm.biz/390344/xml/1/prodotti.xml'));
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>I-factory - groupon</title>
<style>
#menu { border: solid #ccc 1px; width: 200px; float: left;}
#deal { border: solid #ccc 1px; width: 500px; float: left; margin-left: 10px; height: auto; }

</style>
</head>
<body>
<h1>Prova</h1>
<div id="menu">
<h3><a href="/groupon/bari">Bari</a></h3>
<h3><a href="/groupon/milano">Milano</a></h3>
<h3><a href="/groupon/bari">Roma</a></h3>
</div>

<div id="deal">

<?php 
if($citta){
		/*echo "<pre>";
		print_r($dati->deal);
		echo "</pre>";*/ 
	
	foreach($dati->deal AS $itemGEN){
		$valori = $itemGEN->attributes();
		echo $valori['title'].'<br /><br />';
		/*echo "<pre>";
		print_r($itemGEN);
		echo "</pre>";*/ 
	}



 
}else{
	echo 'Nessuna citt&agrave; selezionata';
}
?>


</div>
</body>
</html>