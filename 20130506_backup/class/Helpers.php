<?php

class Helpers
{

function data_sql($data){ // Creo una array dividendo la data sulla base dello slash
  $array = explode("/", $data); 
  // Riorganizzo gli elementi nello stile YYYY/MM/DD
  $data_sql = $array[2]."/".$array[1]."/".$array[0]; 
  // Restituisco il valore della data in formato sql
  return $data_sql; 
}

function data_it($data){ // Creo una array dividendo la data sulla base dello slash
  $array = explode("-", $data); 
  // Riorganizzo gli elementi nello stile YYYY/MM/DD
  $data_it = $array[2]."/".$array[1]."/".$array[0]; 
  // Restituisco il valore della data in formato sql
  return $data_it; 
}

static function printR($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
	
}

static function getNomeFile(){
	$pagina = $_SERVER['REQUEST_URI'];
        $pagina = substr($pagina, 1);
        $pagina = explode("/",$pagina);
	$pagina = end($pagina);
	
	if ( strpos($pagina,"?") > 0){
		$valori = explode("?",$pagina);
		$pagina = $valori[0];
	}
	//echo $pagina;
	return $pagina; 	
}

 function Upload ($dir, $nome_file, $nome_filetemp,$filtrare) {
    //$peso  la dimensione massima consentita per file in byte 1024 byte = 1 Kb
	//$dimensione_massima_Kb=$peso/1024;
	$cartella_upload=$dir.'/';  //cartella in cui eseguire l'upload (controllare permessi scrittura)
	$filtrare= $filtrare; //filtrare x estensioni ammesse? 1=si 0=no
	$array_estensioni_ammesse=array('.pdf','.jpg'); //estensioni ammesse
		/* upload file */
		if($filtrare==1){
			$estensione = strtolower(substr($nome_file, strrpos($nome_file, "."), strlen($nome_file)-strrpos($nome_file, ".")));
			if(!in_array($estensione,$array_estensioni_ammesse)){
				print "<p class=label>Errore.2: Upload File non ammesso a causa della sua estensione. Estensioni ammesse: ".implode(", ",$array_estensioni_ammesse)."</p>";
			}
		}
		if(!file_exists($cartella_upload)){
			print "<p class=label>Errore.3: La cartella di destinazione per l'upload del file non esiste.</p>";
		}
		if(is_uploaded_file($nome_filetemp)) {
			if(move_uploaded_file($nome_filetemp, $cartella_upload.$nome_file)){
				chmod($cartella_upload.$nome_file,0777); //permessi per poterci sovrascrivere/scaricare
				//echo "<p class=label>Upload file riuscito in maniera corretta.</p>";
			} else {
				echo "<p class=label>Errore.4: Upload file non effettuato.</p>";
			}
		} else {
			echo "<p class=label>Errore.5: Problemi con l'upload del file.</p>";
		}
		/* end upload file */
 }
	
	
}