<?php

class Helpers
{

  var $arrayext = array('.jpg','.png', '.gif','.pdf');

  var $mesi = array(
      array('ID'=>'1','nome'=>'Gennaio'),
      array('ID'=>'2','nome'=>'Febbraio'),
      array('ID'=>'3','nome'=>'Marzo'),
      array('ID'=>'4','nome'=>'Aprile'),
      array('ID'=>'5','nome'=>'Maggio'),
      array('ID'=>'6','nome'=>'Giugno'),
      array('ID'=>'7','nome'=>'Luglio'),
      array('ID'=>'8','nome'=>'Agosto'),
      array('ID'=>'9','nome'=>'Settembre'),
      array('ID'=>'10','nome'=>'Ottobre'),
      array('ID'=>'11','nome'=>'Novembre'),
      array('ID'=>'12','nome'=>'Dicembre')
  );

static function data_sql($data){ // Creo una array dividendo la data sulla base dello slash
  $array = explode("/", $data); 
  // Riorganizzo gli elementi nello stile YYYY/MM/DD
  $data_sql = $array[2]."/".$array[1]."/".$array[0]; 
  // Restituisco il valore della data in formato sql
  return $data_sql; 
}

static function data_it($data){ // Creo una array dividendo la data sulla base dello slash
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

 function Upload ($dir, $nome_file, $nome_filetemp, $filtrare = false, $resize = null, $changename = false, $prename = null) {
        
        $max_upload_width = 1024;
	$max_upload_height = 900;

        $cartella_upload=$dir.'/';  //cartella in cui eseguire l'upload (controllare permessi scrittura)
	// $filtrare; filtrare x estensioni ammesse? 1=si 0=no
	$array_estensioni_ammesse=array('.csv','.jpg','.xls','.pdf'); //estensioni ammesse
        $estensione = strtolower(substr($nome_file, strrpos($nome_file, "."), strlen($nome_file)-strrpos($nome_file, ".")));
	/* upload file */
	if($filtrare==1){
            if(!in_array($estensione,$array_estensioni_ammesse)){
                $errori['estensioni'] = "Errore: Upload File non ammesso a causa della sua estensione. Estensioni ammesse: ".implode(", ",$array_estensioni_ammesse);
            }
	}
        
        if(!file_exists($cartella_upload)){
            $errori['cartella'] = "Errore: La cartella di destinazione per l'upload del file non esiste.";
        }


        if($resize){

            if($estensione == ".jpg")
                $image_source = imagecreatefromjpeg($nome_filetemp);
            if($estensione == ".gif")
                $image_source = imagecreatefromgif($nome_filetemp);
            if($estensione == ".png")
                $image_source = imagecreatefrompng($nome_filetemp);

                $remote_file = $cartella_upload.$nome_file;
		imagejpeg($image_source,$remote_file,100);
		chmod($remote_file,0644);


            list($width, $height) = getimagesize($nome_filetemp);
            
            if($width>$max_upload_width || $height >$max_upload_height){
                $proportions = $width/$height;
                if($width>$height){
                    $new_width = $max_upload_width;
                    $new_height = round($max_upload_width/$proportions);
                }
                else{
                    $new_height = $max_upload_height;
                    $new_width = round($max_upload_height*$proportions);
                }

                $new_image = imagecreatetruecolor($new_width , $new_height);
		$image_source = imagecreatefromjpeg($remote_file);

		imagecopyresampled($new_image, $image_source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagejpeg($new_image,$remote_file,100);

		imagedestroy($new_image);
            }
            imagedestroy($image_source);
            return $errori;
        }


        if(is_uploaded_file($nome_filetemp)) {
            if($changename){
                $nome_file = $prename.time().$estensione;
            }
            if(move_uploaded_file($nome_filetemp, $cartella_upload.$nome_file)){
                chmod($cartella_upload.$nome_file,0777); //permessi per poterci sovrascrivere/scaricare
                    return $nome_file;
            }else{
		$errori['upload'] = "Errore: Upload file non effettuato";
            }
	}else{
            $errori['upload'] = "Errore: Problemi con l'upload del file";
	}

        return $errori;
 }

static function permalink($str, $separator = 'dash', $lowercase = FALSE)
    {
        $str = strtolower($str);
        if ($separator == 'dash')
        {
            $search		= '_';
            $replace	= '-';
        }
        else
        {
            $search		= '-';
            $replace	= '_';
        }

        $trans = array(
            '&\#\d+?;'				=> '',
            '&\S+?;'				=> '',
            '\s+'					=> $replace,
            '[^a-z0-9\-\._]'		=> '',
            $replace.'+'			=> $replace,
            $replace.'$'			=> $replace,
            '^'.$replace			=> $replace,
            '\.+$'					=> ''
        );

        $str = strip_tags($str);

        foreach ($trans as $key => $val)
        {
            $str = preg_replace("#".$key."#i", $val, $str);
        }

        if ($lowercase === TRUE)
        {
            $str = strtolower($str);
        }

        return trim(str_replace(".","",stripslashes($str)));
    }

function paginazionePanel($totalePagine,$parametriDiRicerca,$pagina,$urlPagina,$numeroLink = 10)
 {
  settype($totalePagine, integer);
  settype($pagina, integer);
  settype($numeroLink, integer);
  //unset($parametriDiRicerca['pagina']);
 $URL = new Rewrite();
 //print_r($parametriDiRicerca);
  //echo $totalePagine;

  if($totalePagine>1)
   {
	$parametriDiRicerca = (count($parametriDiRicerca)>0)?'&amp;'.implode('&amp;',$parametriDiRicerca):NULL;
    $paginazione = "";

	if($totalePagine <= $numeroLink)
	 {
	  for($i=1; $i<=$totalePagine; $i++)
	   {
	    if($pagina == $i)
		 $paginazione .= '<li class="sel">'.$i.'</a></li>';
		else
		 	$paginazione .="<li><a href=\"".$URL->rewrite($urlPagina."?pag=".$i)."\" title=\"vai all'ultima pagina ".$i."\">$i</a></li>";
	   }
      }
	else
	 {
		 $paginazione .= "<li><a href=\"".$URL->rewrite($urlPagina."?pag=1".$parametriDiRicerca)."\" title=\"vai alla prima pagina\">&laquo;</a></li>";

	  for($i=($pagina-floor($numeroLink/2));$i<$pagina;$i++)
	   {
	    if($i>0)
		 {
	      $numeroLink--;
		  	$paginazione .= '<li><a href="'.$URL->rewrite($urlPagina.'?pag='.$i.'').'" title="vai alla pagina  '.($i).'">'.($i).'</a></li>';
		 }
	   }
	  $paginazione .= "<li class=\"sel\"><a href='#'>".$pagina."</a></li>";

	  for($i=$pagina+1;$i<=$pagina+$numeroLink;$i++)
	   {
	    if($i>$totalePagine)
		 break;
		 	$paginazione .= '<li><a href="'.$URL->rewrite($urlPagina."?pag=".$i."").'" title="vai alla pagina  '.($i).'">'.($i).'</a></li>';
	   }
	  	$paginazione .= "<li><a href=\"".$URL->rewrite($urlPagina."?pag=".$totalePagine.$parametriDiRicerca)."\" title=\"vai all'ultima pagina\">&raquo;</a></li>";

	  }
     return $paginazione;
   }
  else
   return false;
 }    

function paginazione($totalePagine,$parametriDiRicerca,$pagina,$urlPagina,$numeroLink = 5){
  settype($totalePagine, integer);
  settype($pagina, integer);
  settype($numeroLink, integer);
  //unset($parametriDiRicerca['pagina']);
 //$URL = new RewriteCls();
 //print_r($parametriDiRicerca);
  //echo $totalePagine;
 	
  if($totalePagine>1){
    //$parametriDiRicerca = (count($parametriDiRicerca)>0)?'&amp;'.implode('&amp;',$parametriDiRicerca):NULL;
    $paginazione = "";
    if($totalePagine <= $numeroLink){
	for($i=1; $i<=$totalePagine; $i++){
            if($pagina == $i)
                $paginazione .= "<li class=\"sel\">$i</li>";
            else
                $paginazione .="<li><a href=\"".$urlPagina."/pagina-".$i.".html\" title=\"vai all'ultima pagina ".$i."\">$i</a></li>";
        }
    }else{
        $paginazione .= "<li><a href=\"".$urlPagina."/pagina-1.html\" title=\"vai alla prima pagina\">&laquo;</a></li>";
        for($i=($pagina-floor($numeroLink/2));$i<$pagina;$i++){
            if($i>0){
                $numeroLink--;
                $paginazione .= '<li><a href="'.$urlPagina.'/pagina-'.$i.'.html" title="vai alla pagina"'.$i.'">'.$i.'</a></li>';
            }
        }
	$paginazione .= "<li class=\"sel\">".$pagina."</li>";
        for($i=$pagina+1;$i<=$pagina+$numeroLink;$i++){
            if($i>$totalePagine)
		 break;
            $paginazione .= '<li><a href="'.$urlPagina."/pagina-".$i.".html".'" title="vai alla pagina '.$i.'">'.$i.'</a></li>';
        }
        $paginazione .= '<li><a href="'.$urlPagina.'/pagina-'.$totalePagine.'".html" title="vai all\'ultima pagina">&raquo;</a></li>';
    }
    
    return $paginazione;
    
    }else
        return false;
 }     
 
    function readyFolder($path){
       	$files=Array();
	if(file_exists($path)){
		$handle = opendir($path);
		while (false !== ($file = readdir($handle))) {
                        if(is_file($path."/".$file)){
                                $ext = strtolower(substr($file, strrpos($file, "."), strlen($file)-strrpos($file, ".")));
                                if(in_array($ext,$this->arrayext)){
                                        array_push($files,$file);
				}
			}
		}
		$handle = closedir($handle);
	}
	sort($files);
	return $files;
    }

    function troncaTesto($string, $caratteri, $abbr = false, $punti = false)
    {
        if(strlen($string) <= $caratteri)
            return $string;

        $nuovo = wordwrap($string, $caratteri, "|");
        $nuovotesto = explode("|", $nuovo);

        $testo = $nuovotesto[0];

        if($punti)
            $testo = $testo . "...";

        if($abbr)
            $testo = '<abbr title="' . $string . '">' . $testo . '</abbr>';

        return $testo;
    }
    
    function svuota_cartella($dirpath, $ext = null) {
        $dirpath .= "/";
        //echo $dirpath;
        if($ext){
            $handle = opendir($dirpath);
            while (($file = readdir($handle)) !== false) {
                if (substr($file, -strlen($ext)) == $ext){
                    //echo "Cancellato: " . $file . "<br/>";
                    @unlink($dirpath . $file);
                }else{
                    echo "NON cancellato: " . $file . "<br/>";
                }
            }
            closedir($handle);
        }else{
          $handle = opendir($dirpath);
          while (($file = readdir($handle)) !== false) {
            //echo "Cancellato: " . $file . "<br/>";
            @unlink($dirpath . $file);
          }
          closedir($handle);
        }
    }

} //end class