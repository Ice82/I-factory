<?php

class Rewrite{

function rewrite($indirizzo){ 
/*	
	if(strstr($indirizzo,'fier'))
    {
    	$url_esploso = explode("?",$indirizzo);
		preg_match("#pagina=([\w-]+)&?#i",$indirizzo,$ris);
		$pagina = $ris[1];
		if($pagina)
			$indirizzo = "fiere/".$pagina;
		else
			$indirizzo = "fiere"; 
    	
    }
*/	
	if(strstr($indirizzo,'fairs'))
    {
    	
    	$url_esploso = explode("?",$indirizzo);
		preg_match("#id=([0-9]+)&?#i",$indirizzo,$ris);
		$id = $ris[1];
		if($id)
			$indirizzo = "fiere/fiere-".$id;
		
    	
    }
    
	
	return $indirizzo; 


}





	
	
} //chiusura classe