<?php
class IMAGE {
	function UpImgsResize ($path,$nome_file,$nome_filetemp) {
     	$dimensione_massima=614400; //dimensione massima consentita per file in byte 1024 byte = 1 Kb
	$dimensione_massima_Kb=$dimensione_massima/1024;
	$cartella_upload= $path.'/'; //cartella in cui eseguire l'upload (controllare permessi scrittura)
	$filtrare=1; //filtrare x estensioni ammesse? 1=si 0=no
	$array_estensioni_ammesse=array('.jpg','.gif','.png'); //estensioni ammesse
		if($nome_file==""){
		echo "<p class=label>Errore.1: Non è stata selezionata nessuna immagine per l'upload</p>";
		} else{ //start 1
		/* upload img */
		if($filtrare==1){
			$estensione = strtolower(substr($nome_file, strrpos($nome_file, "."), strlen($nome_file)-strrpos($nome_file, ".")));
			if(!in_array($estensione,$array_estensioni_ammesse)){
				print "<p class=label>Errore.2: Upload Immagine non ammesso a causa della sua estensione. Estensioni ammesse: ".implode(", ",$array_estensioni_ammesse)."</p>";
				}
			}
		if(!file_exists($cartella_upload)){
			print "<p class=label>Errore.3: La cartella di destinazione per l'upload dell'immagine non esiste.</p>";
			}
		if(is_uploaded_file($nome_filetemp)) {
		if(move_uploaded_file($nome_filetemp, $cartella_upload.$nome_file)){
				chmod($cartella_upload.$nome_file,0777); //permessi per poterci sovrascrivere/scaricare
				echo "<p class=label>Upload Immagine riuscito in maniera corretta.</p>";
				} else {
					echo "<p class=label>Errore.4: Upload Immagine non effettuato.</p>";
					}
		} else {
			echo "<p class=label>Errore.5: Problemi con l'upload del file.</p>";
			}
		/* end upload img */
		$src_filename = $cartella_upload.$nome_file;
		list($src_width,$src_height,$src_type,$src_attr) = getimagesize($src_filename);
		if($src_width > 410) {
		//inizio il resize
		switch($src_type){
				case 1:
				$src_image =imagecreatefromgif($src_filename);
				break; 
            			case 2: 
		                $src_image =imagecreatefromjpeg($src_filename);
		                break; 
			        case 3: 
		                $src_image =imagecreatefrompng($src_filename);
		                break; 
		                default:    ;//return false;
		                }
		if(!($src_image==0)){
			//salvo l'immagine con altezza 400 lasciandola proporzionata 
       			$dest_width = '410';
       			$quality = '100';
		        $ratio = $src_width / $dest_width;
		        $dest_image = imagecreatetruecolor($dest_width, $src_height / $ratio); 
		        imagecopyresampled($dest_image, $src_image, 0, 0, 0, 0, $src_width / $ratio, $src_height / $ratio, $src_width, $src_height); 
		        imagejpeg($dest_image, $src_filename, $quality); 

	       		} else {
	       			echo "<p class=label>Errore.6: Problemi con il resize del file.</p>";
	       			}
		//end resize
		}	
		} //end 1
	} //chiude function upImgsResize
	
	
	function UpImgs ($path,$nome_file,$nome_filetemp,$nome) {
     	$dimensione_massima=614400; //dimensione massima consentita per file in byte 1024 byte = 1 Kb
	$dimensione_massima_Kb=$dimensione_massima/1024;
	$cartella_upload= $path.'/'; //cartella in cui eseguire l'upload (controllare permessi scrittura)
	$filtrare=1; //filtrare x estensioni ammesse? 1=si 0=no
	$array_estensioni_ammesse=array('.jpg','.gif','.png'); //estensioni ammesse
		if($nome_file==""){
		echo "<p class=label>Errore.1: Non è stata selezionata nessuna immagine per l'upload</p>";
		} else{ //start 1
		/* upload img */
		if($filtrare==1){
			$estensione = strtolower(substr($nome_file, strrpos($nome_file, "."), strlen($nome_file)-strrpos($nome_file, ".")));
			if(!in_array($estensione,$array_estensioni_ammesse)){
				print "<p class=label>Errore.2: Upload Immagine non ammesso a causa della sua estensione. Estensioni ammesse: ".implode(", ",$array_estensioni_ammesse)."</p>";
				}
			}
		if(!file_exists($cartella_upload)){
			print "<p class=label>Errore.3: La cartella di destinazione per l'upload dell'immagine non esiste.</p>";
			}
		if(is_uploaded_file($nome_filetemp)) {
		if(move_uploaded_file($nome_filetemp, $cartella_upload.$nome.$estensione)){
				chmod($cartella_upload.$nome.$estensione,0777); //permessi per poterci sovrascrivere/scaricare
				echo "<p class=label>Upload Immagine riuscito in maniera corretta.</p>";
				} else {
					echo "<p class=label>Errore.4: Upload Immagine non effettuato.</p>";
					}
		} else {
			echo "<p class=label>Errore.5: Problemi con l'upload del file.</p>";
			}
		/* end upload img */
		} //end 1
	} //chiude function upImgs
	
}
// END CLASS IMAGE
?>
