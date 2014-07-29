<?
include("db.php");

//##############################################################################################################################
// data per database mysql
function data_sql($data){ // Creo una array dividendo la data sulla base dello slash
  $array = explode("/", $data); 
  // Riorganizzo gli elementi nello stile YYYY/MM/DD
  $data_sql = $array[2]."/".$array[1]."/".$array[0]; 
  // Restituisco il valore della data in formato sql
  return $data_sql; 
}
//##############################################################################################################################

//##############################################################################################################################
// data per visualizzazione
function data_it($data){ // Creo una array dividendo la data sulla base dello slash
  $array = explode("-", $data); 
  // Riorganizzo gli elementi nello stile YYYY/MM/DD
  $data_it = $array[2]."/".$array[1]."/".$array[0]; 
  // Restituisco il valore della data in formato sql
  return $data_it; 
}
//##############################################################################################################################

//##############################################################################################################################
// Mi permette di prelevare singoli dati dalle tabelle aventi come chiave primaria ID
function getDati($tabella,$oggetto,$chiave){ 
global $db_host, $db_user, $db_pass, $db_name;
$conn = mysql_connect($db_host, $db_user, $db_pass) or die("Errore nella connessione a MySql da getDati: " . mysql_error());
mysql_select_db($db_name,$conn) or die("Errore nella selezione del db: " . mysql_error());
$query = "SELECT ". $oggetto ." FROM ". $tabella ." WHERE ID='". $chiave ."'";
$result = mysql_query($query, $conn);
$row = mysql_fetch_array($result);
 if ($row[0] == "") {
   return "";
 } else {
   return $row[0];
 }
mysql_close($conn);
}
//##############################################################################################################################

//##############################################################################################################################
// Cancella qualsiasi cartella
function eliminaCartella($dirname){
	if(file_exists($dirname) && is_file($dirname)) {
		unlink($dirname);
	}elseif(is_dir($dirname)){
		$handle = opendir($dirname);
		while (false !== ($file = readdir($handle))) { 
			if(is_file($dirname.$file)){
				unlink($dirname.$file);
			}else{
			 eliminaCartella($dirname.$file);
			}
		}
		$handle = closedir($handle);
		rmdir($dirname);
	}
}
//##############################################################################################################################


?>