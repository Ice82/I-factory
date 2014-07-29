<?php
ini_set('session.cache_limiter', 'private');
//session_start($session_name);


class generalClass{
 public $myPdo;
 private $stPdo;
 private $errori = array();
 private $result = array();
 private $indice = 0;
 private $lingua;

 //var $ore = array ( "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00",
//		"13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30","19:00", "19:30", "20:00","20:30", "21:00");

var $ore = array ( "00:30", "01:00", "01:30", "02:00", "02:30", "03:00", "03:30", "04:00", "04:30",
		"05:00", "05:30", "06:00", "06:30", "07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00");

var $mesi = array (
        array('id'=>'1','label'=>'Gennaio', 'start' => '01','end'=>  '31'),
        array('id'=>'2','label'=>'Febbraio', 'start' => '01','end'=>  '28'),
        array('id'=>'3','label'=>'Marzo', 'start' => '01','end'=>  '31'),
        array('id'=>'4','label'=>'Aprile', 'start' => '01','end'=>  '30'),
        array('id'=>'5','label'=>'Maggio', 'start' => '01','end'=>  '31'),
        array('id'=>'6','label'=>'Giugno', 'start' => '01','end'=>  '30'),
        array('id'=>'7','label'=>'Luglio', 'start' => '01','end'=>  '31'),
        array('id'=>'8','label'=>'Agosto', 'start' => '01','end'=>  '31'),
        array('id'=>'9','label'=>'Settembre', 'start' => '01','end'=>  '30'),
        array('id'=>'10','label'=>'Ottobre', 'start' => '01','end'=>  '31'),
        array('id'=>'11','label'=>'Novembre', 'start' => '01','end'=>  '30'),
        array('id'=>'12','label'=>'Dicembre', 'start' => '01','end'=>  '31')
    );
var $anni = array ( '2012', '2011');

 function __construct()
  {
   //$this->lingua = $_SESSION['lingua']?$_SESSION['lingua']:'1';
   global $db_host, $db_user,$db_pass ,$db_name;
   $dbdsn  = "mysql:host=".$db_host.";port=3306;dbname=".$db_name; // mysql
   $dbuser = $db_user;
   $dbpass = $db_pass;
 
   try 
    {
	 $this->myPdo = new PDO($dbdsn, $dbuser, $dbpass);
	 //return $this->$myPdo;
	 //echo "Connessione riuscita<br><br>";
    }
   catch(PDOException $e) 
    {
	 die( 'Errore di connessione: '.$e->getMessage());
    }
  }
  
  function storeErrors($error)
   {
    $this->errori[$this->indice]=$error;
	$this->indice++;
   }
  
  function getErrors()
   {
    return $this->errori;
   }
  
  function closeConnection()
   {
    $this->myPdo = NULL;
   }
  
  function executeQuery($query)
   {  
     $this->myPdo->exec("SET CHARACTER SET utf8"); 
	 $this->myPdo->exec("SET NAMES utf8");
     $this->stPdo = $this->myPdo->prepare($query);
	 if(!$this->stPdo)
	  {
	   $errorinfo = $this->myPdo->errorInfo();
	   $this->storeErrors($errorinfo[2]);
	   return false;
	  }
	 else
	  {	
	   if(!$this->stPdo->execute())
	    {
	     $errorinfo = $this->stPdo->errorInfo();
	     $this->storeErrors($errorinfo[2]);
		 return false;
	    }
	   else
	    {
		 return $this->stPdo;
		}
	  }	 
   }
   
  function fetchAll()
   {
    $rows = $this->stPdo->fetchAll();
	$this->stPdo->closeCursor();
	return $rows;
   }
   
  //restituisce i dati dell'utente backOffice

	static function printR($arr){
		echo "<pre>";
		print_r($arr);
		echo "</pre>";

	}
 
function data_sql($data){ // Creo una array dividendo la data sulla base dello slash
  $array = explode("/", $data); 
  // Riorganizzo gli elementi nello stile YYYY/MM/DD
  $data_sql = $array[2]."/".$array[1]."/".$array[0]; 
  // Restituisco il valore della data in formato sql
  return $data_sql; 
}

function dividiOra($valore){
  list($ore, $minuti) = explode(":", $valore);
  $minuti = $minuti/60;
  return ($ore+$minuti);
}


function datediff($tipo, $partenza, $fine)
    {
        switch ($tipo)
        {
            case "A" : $tipo = 365;
            break;
            case "M" : $tipo = (365 / 12);
            break;
            case "S" : $tipo = (365 / 52);
            break;
            case "G" : $tipo = 1;
            break;
        }
        $arr_partenza = explode("/", $partenza);
        $partenza_gg = $arr_partenza[0];
        $partenza_mm = $arr_partenza[1];
        $partenza_aa = $arr_partenza[2];
        $arr_fine = explode("/", $fine);
        $fine_gg = $arr_fine[0];
        $fine_mm = $arr_fine[1];
        $fine_aa = $arr_fine[2];
        $date_diff = mktime(12, 0, 0, $fine_mm, $fine_gg, $fine_aa) - mktime(12, 0, 0, $partenza_mm, $partenza_gg, $partenza_aa);
        $date_diff  = floor(($date_diff / 60 / 60 / 24) / $tipo);
        return $date_diff;
    }

function data_it($data){ // Creo una array dividendo la data sulla base dello slash
  $array = explode("-", $data); 
  // Riorganizzo gli elementi nello stile YYYY/MM/DD
  $data_it = $array[2]."/".$array[1]."/".$array[0]; 
  // Restituisco il valore della data in formato sql
  return $data_it; 
}

function pulisci($data){ // Creo una array dividendo la data sulla base dello slash
  return str_replace("/","",$data); 
}

 
 // Inserisce una nuova sede
 function addCedolino($valori)
   {
    $errore = array();
    
    $query = "INSERT INTO cedolino(typeID,sedeID,file,mese,anno,data) VALUES ('".$valori['type']."','".$valori['sede']."',
                                                '".$valori['file']."','".$valori['mese']."',
                                                '".$valori['anno']."','".date("Y-m-d")."')";
    if(!$this->executeQuery($query))
	 $errore['add'] = $this->getErrors();
    return $errore;
   }
   
   

 // Inserisce una nuova sede
 function addSede($valori)
   {
    $errore = array();
    $prova = ($valori['c_prova']) ? str_replace(",",".",$valori['c_prova']) : "0.00";
    $query = "INSERT INTO Sedi(NOME,ABILITATO,INDIRIZZO,CITTA,
                               PROVINCIA,CAP,TELEFONO,CELLULARE_1,
                               CELLULARE_2,EMAIL,NOTTE,C_NOTTE,C_GIORNO,C_PDA,
                               C_APP,business,C_PDA_B,C_APP_B,TKC_NOTTE,TKC_GIORNO,
                               TKC_PDA,TKC_APP,TKC_PDA_B,TKC_APP_B, C_PROVA) VALUES ('".$valori['sede']."','".$valori['abilitato']."',
                                                '".$valori['indirizzo']."','".$valori['citta']."',
                                                '".$valori['provincia']."','".$valori['cap']."',
                                                '".$valori['telefono']."','".$valori['cellulare_1']."',
                                                '".$valori['cellulare_2']."','".$valori['email']."',
                                                '".$valori['notte']."','".str_replace(",",".",$valori['c_notte'])."',
                                                '".str_replace(",",".",$valori['c_giorno'])."','".str_replace(",",".",$valori['c_pda'])."',
                                                '".str_replace(",",".",$valori['c_app'])."','".$valori['business']."',
                                                '".str_replace(",",".",$valori['c_pda_b'])."','".str_replace(",",".",$valori['c_app_b'])."',
                                                '".str_replace(",",".",$valori['c_notte'])."','".str_replace(",",".",$valori['tkc_giorno'])."',
                                                '".str_replace(",",".",$valori['tkc_pda'])."','".str_replace(",",".",$valori['tkc_app'])."',
                                                '".str_replace(",",".",$valori['tkc_pda_b'])."','".str_replace(",",".",$valori['tkc_app_b'])."','".$prova."')";
    if(!$this->executeQuery($query))
	 $errore['sede'] = $this->getErrors();
    return $errore;
   }
  
  function ListCedolinoSede($type,$sede = null)
   {
       if(!($sede))
              $query = "SELECT c.*, s.NOME as nomeSede 
                            FROM cedolino AS c
                                JOIN Sedi AS s ON (c.sedeID=s.ID)
                                WHERE c.typeID='{$type}'
                              ORDER BY s.NOME,c.anno,c.mese DESC";
       else
              $query = "SELECT c.*, s.NOME as nomeSede 
                            FROM cedolino AS c
                                JOIN Sedi AS s ON (c.sedeID=s.ID)
                                WHERE c.sedeID='{$sede}' AND c.typeID='{$type}'
                              ORDER BY s.NOME,c.anno,c.mese DESC";

    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }   
   
  function esisteRett($userID)
   {
        $query = "SELECT ID,valore
                            FROM borsellino
                                WHERE userID='{$userID}'
                              ";

    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
        
   }    
   
  // Prelevo Sedi
  function getSedi($abilitato)
   {
       if($abilitato)
              $query = "SELECT * FROM Sedi WHERE ABILITATO = 'SI' ORDER BY NOME ASC";
       else
              $query = "SELECT * FROM Sedi ORDER BY NOME ASC";

    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function getSediHome()
   {
	$query = "SELECT s.*,u.COGNOME AS RESPONSABILE
			 FROM Sedi AS s
			 	JOIN User AS u ON (s.ID=u.SEDE)
			 WHERE s.ABILITATO = 'SI' AND s.NOME!='Neutra' ORDER BY s.NOME ASC";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }
   
   
function getSediById($id)
   {
    $query = "SELECT * FROM Sedi WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  //Upload sedi
  function uploadSede($valori)
   {
    $errore = array();
    $query = "UPDATE Sedi SET NOME='".$valori['sede']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['nome'] = 1;
    $query = "UPDATE Sedi SET INDIRIZZO='".$valori['indirizzo']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['indirizzo'] = 1;
    $query = "UPDATE Sedi SET CITTA='".$valori['citta']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['citta'] = 1;
    $query = "UPDATE Sedi SET PROVINCIA='".$valori['provincia']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['provincia'] = 1;
    $query = "UPDATE Sedi SET CAP='".$valori['cap']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cap'] = 1;
    $query = "UPDATE Sedi SET TELEFONO='".$valori['telefono']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['telefono'] = 1;
    $query = "UPDATE Sedi SET CELLULARE_1='".$valori['cellulare_1']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cellulare_1'] = 1;
    $query = "UPDATE Sedi SET CELLULARE_2='".$valori['cellulare_2']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cellulare_2'] = 1;
    $query = "UPDATE Sedi SET EMAIL='".$valori['email']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['email'] = 1;
    $query = "UPDATE Sedi SET C_GIORNO='".str_replace(",",".",$valori['c_giorno'])."',
    			      C_NOTTE='".str_replace(",",".",$valori['c_notte'])."',
                              C_PDA='".$valori['c_pda']."',
                              C_APP='".str_replace(",",".",$valori['c_app'])."',
                              C_APP_B='".str_replace(",",".",$valori['c_app_b'])."',
                              C_PDA_B='".str_replace(",",".",$valori['c_pda_b'])."',
                              C_PROVA='".str_replace(",",".",$valori['c_prova'])."'
                        WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['compensi'] = 1;
    $query = "UPDATE Sedi SET TKC_GIORNO='".str_replace(",",".",$valori['tkc_giorno'])."',
    			      TKC_NOTTE='".str_replace(",",".",$valori['tkc_notte'])."',
                              TKC_PDA='".$valori['tkc_pda']."',
                              TKC_APP='".str_replace(",",".",$valori['tkc_app'])."',
                              TKC_APP_B='".str_replace(",",".",$valori['tkc_app_b'])."',
                              TKC_PDA_B='".str_replace(",",".",$valori['tkc_pda_b'])."'
                        WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['compensi'] = 1;
    $query = "UPDATE Sedi SET NOTTE='".$valori['notte']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['notte'] = 1;
    $query = "UPDATE Sedi SET business='".$valori['business']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['business'] = 1;
    $query = "UPDATE Sedi SET ABILITATO='".$valori['abilitato']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['abilitato'] = 1;
    return $errore;
   }

  // Prelevo Type
  function getType()
   {
    $query = "SELECT * FROM Type ORDER BY NOME ASC";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function addResponsabile($valori)
   {
    $query = "INSERT INTO User (COGNOME,CELLULARE,TYPE,LOGIN,PSW,DATA,SEDE,ABILITATO) VALUES
 							('".addslashes($_POST['cognome'])."',
							 '".$_POST['cellulare']."',
							 '".$_POST['type']."',
							 '".addslashes($_POST['login'])."',
							 '".addslashes($_POST['password'])."',
							 '".date("Y/m/d")."',
                                                         '".$_POST['sede']."',
                                                         '".$_POST['abilitato']."')";
    if(!$this->executeQuery($query))
	 return $errore = 1;
   }

  // Prelevo Responsabili
  function getResponsabili($id = null)
   {
    if ($id){
   	$query = "SELECT User.*,Sedi.NOME AS nomeSEDE, Sedi.EMAIL AS emailSEDE
   					FROM User
    					LEFT JOIN Sedi ON (User.SEDE=Sedi.ID)
    					WHERE User.ID = '".$id."'
    					ORDER BY User.COGNOME ASC";    	
    }else{
   	$query = "SELECT User.*, Sedi.NOME AS nomeSEDE, Sedi.EMAIL AS emailSEDE
   				FROM User
    					LEFT JOIN Sedi ON (User.SEDE=Sedi.ID)
    					ORDER BY User.COGNOME ASC";
	}
	//echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function getResponsabileById($id)
   {
    $query = "SELECT * FROM User WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function getResponsabileBySedeID($sedeID)
   {
    $query = "SELECT * FROM User WHERE SEDE='".$sedeID."' AND ABILITATO='SI'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }


  function uploadResponsabile($valori)
   {
    
   	$errore = array();
    $query = "UPDATE User SET COGNOME='".$valori['cognome']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cognome'] = 1;
    $query = "UPDATE User SET CELLULARE='".$valori['cellulare']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cellulare'] = 1;
    $query = "UPDATE User SET EMAIL='".$valori['email']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cellulare'] = 1;
	 $query = "UPDATE User SET TEL='".$valori['telefono']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['telefono'] = 1;
	 $query = "UPDATE User SET CELLULARE1='".$valori['cellulare1']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cellulare1'] = 1;
	 $query = "UPDATE User SET LOGIN='".$valori['login']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['login'] = 1;
    $query = "UPDATE User SET PSW='".$valori['password']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['password'] = 1;
    $query = "UPDATE User SET SEDE='".$valori['sede']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['sede'] = 1;
    $query = "UPDATE User SET ABILITATO='".$valori['abilitato']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['abilitato'] = 1;
    $query = "UPDATE User SET TYPE='".$valori['type']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['type'] = 1;

    return $errore;
   }

  function addDipendente($valori)
   {
    $errori = array();
    echo "<pre>";
    $query = "INSERT INTO Anagrafica_dipendenti (COGNOME, NOME,
                                                 CF, SEDE, LAVORO, DATA_NASCITA, LUOGO_NASCITA, PROV_NASCITA,
                                                 CAP_NASCITA, INDIRIZZO, LUOGO_RES, PROV_RES, CAP_RES, TITOLO_STUDIO, 
                                                 DATA_INS,ID_RESPONSABILE,INTESTATARIO,IBAN,EMAIL,PAGAMENTO,NPERMESSO,DATARILASCIO,RILASCIATODA,TELESELLER,COMPENSO) VALUES ('".addslashes($_POST['cognome'])."',
                                                 '".addslashes($_POST['nome'])."',
						 '".addslashes($_POST['cf'])."',
						 '".$_POST['sede']."',
                                                 '".addslashes($_POST['lavoro'])."',
						 '".$this->data_sql($_POST['data'])."',
						 '".addslashes($_POST['luogo'])."',
						 '".addslashes($_POST['prov'])."',
						 '".addslashes($_POST['cap'])."',
						 '".addslashes($_POST['indirizzo'])."',
						 '".addslashes($_POST['luogo_re'])."',
						 '".addslashes($_POST['prov_re'])."',
						 '".addslashes($_POST['cap_re'])."',
						 '".addslashes($_POST['titolo'])."',
             '".date("Y/m/d")."',
             '".$_SESSION['user']."',
             '".addslashes($_POST['intestatario'])."',
             '".addslashes($_POST['iban'])."',
             '".addslashes($_POST['email'])."',
             '".addslashes($_POST['pagamento'])."',
             '".addslashes($_POST['npermesso'])."',
             '".addslashes($_POST['datarilascio'])."',
             '".addslashes($_POST['rilasciatoda'])."','".$_POST['teleseller']."','".str_replace(",",".",$_POST['compenso'])."')";
    if(!$this->executeQuery($query))
	 return $errore['inserimento'] = "no";
    return $errore;
   }

	/*Richiamato dalla pagina creaFlusso */
   function getDipByID($id)
   {
    $query = "SELECT a.* FROM Anagrafica_dipendenti as a
    					WHERE a.ID='".$id."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }
   
   
  function getDipendenteById($id)
   {
    $query = "SELECT a.*,s.DATA_ASSUNZIONE,s.DATA_CESSAZIONE FROM Anagrafica_dipendenti as a
    					JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
    					WHERE a.ID='".$id."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function uploadDipendente($valori)
   {
    $errore = array();
    $query = "UPDATE Anagrafica_dipendenti SET COGNOME='".addslashes($valori['cognome'])."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cognome'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET NOME='".addslashes($valori['nome'])."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['nome'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET CF='".addslashes($valori['cf'])."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cf'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET ID_RESPONSABILE='".$valori['responsabile']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['responsabile'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET INTESTATARIO='".addslashes($valori['intestatario'])."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['intestatario'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET IBAN='".addslashes($valori['iban'])."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['iban'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET SEDE='".$valori['sede']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['sede'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET LAVORO='".$valori['lavoro']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['lavoro'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET DATA_NASCITA='".$this->data_sql($valori['data'])."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['data_nascita'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET LUOGO_NASCITA='".$valori['luogo']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['luogo_nascita'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET PROV_NASCITA='".$valori['prov']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['prov_nascita'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET CAP_NASCITA='".$valori['cap']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cap_nascita'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET INDIRIZZO='".$valori['indirizzo']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['indirizzo'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET LUOGO_RES='".$valori['luogo_re']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['luogo_re'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET PROV_RES='".$valori['prov_re']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['prov_re'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET CAP_RES='".$valori['cap_re']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['cap_re'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET TITOLO_STUDIO='".$valori['titolo']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['titolo_studio'] = 1;
    $query = "UPDATE Anagrafica_dipendenti SET EMAIL='".$valori['email']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['email'] = 1;
	$query = "UPDATE Anagrafica_dipendenti SET PAGAMENTO='".$valori['pagamento']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['pagamento'] = 1;
	$query = "UPDATE Anagrafica_dipendenti SET NPERMESSO='".$valori['npermesso']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['npermesso'] = 1;
	$query = "UPDATE Anagrafica_dipendenti SET DATARILASCIO='".$valori['datarilascio']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['datarilascio'] = 1;
	$query = "UPDATE Anagrafica_dipendenti SET RILASCIATODA='".$valori['rilasciatoda']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['rilasciatoda'] = 1;
	$query = "UPDATE Anagrafica_dipendenti SET TELESELLER='".$valori['teleseller']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['teleseller'] = 1;
	$query = "UPDATE Anagrafica_dipendenti SET COMPENSO='".str_replace(",",".",$valori['compenso'])."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['compenso'] = 1;
	 if ($valori['data_assunzione']) {
		$query = "UPDATE Stato_dipendenti SET DATA_ASSUNZIONE='".$this->data_sql($valori['data_assunzione'])."' WHERE ID_DIPENDENTE='".$valori['id']."'";
    	if(!$this->executeQuery($query))
	 	 $errore['data_assunzione'] = 1;
	}
	if ($valori['data_cessazione']) {
		$query = "UPDATE Stato_dipendenti SET DATA_CESSAZIONE='".$this->data_sql($valori['data_cessazione'])."' WHERE ID_DIPENDENTE='".$valori['id']."'";
    	if(!$this->executeQuery($query))
	 	 $errore['data_cessazione'] = 1;
	}
	return $errore;
   }


  function getDipendentiAppesiByIDresponsabile($id_responsabile)
   {
    if ($id_responsabile){
    $query = "SELECT a.*,
                          s.NOME AS nomeSede
                    FROM 
                        Anagrafica_dipendenti AS a
			JOIN Sedi AS s ON (s.ID=a.SEDE)
                    WHERE
                        a.ID_RESPONSABILE = '".$id_responsabile."'
                        AND a.DATA_INS> '2011-07-25' AND a.ID NOT IN (SELECT ID_DIPENDENTE FROM Stato_dipendenti)";
		}else{
    $query = "SELECT a.*,s.NOME AS nomeSede
              FROM
              Anagrafica_dipendenti AS a,
              Sedi AS s
              WHERE
                a.ID NOT IN (SELECT ID_DIPENDENTE FROM Stato_dipendenti) 
				AND a.ID NOT IN (SELECT ID_DIPENDENTE FROM Stato_dipendenti WHERE DATA_CESSAZIONE='2010-01-01')
				AND a.SEDE=s.ID
              ORDER BY s.NOME ASC";
		}
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }


function addLavoro($valori)
   {
    $errore = array();
    $query = "INSERT INTO Lavoro(NOME,ABILITATO) VALUES ('".$valori['nome']."','".$valori['abilitato']."')";
    if(!$this->executeQuery($query))
	 $errore['lavoro'] = 1;
    return $errore;
   }

  // Prelevo Sedi
  function getLavoro($abilitato)
   {
       if($abilitato)
              $query = "SELECT * FROM Lavoro WHERE ABILITATO = 'SI' ORDER BY NOME ASC";
       else
              $query = "SELECT * FROM Lavoro ORDER BY NOME ASC";

    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

function getLavoroById($id)
   {
    $query = "SELECT * FROM Lavoro WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  //Upload sedi
  function uploadLavoro($valori)
   {
    $errore = array();
    $query = "UPDATE Lavoro SET NOME='".$valori['nome']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['nome'] = 1;
    $query = "UPDATE Lavoro SET ABILITATO='".$valori['abilitato']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['abilitato'] = 1;
    return $errore;
   }

  function deleteLavoro($id)
   {
    $errore = array();
    $query = "DELETE FROM Lavoro WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
	 $errore['lavoro'] = 1;
    return $errore;
   }

   
  function deleteSede($id)
   {
    $errore = array();
    $query = "DELETE FROM Sedi WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
	 $errore['lavoro'] = 1;
    return $errore;
   }

  function getFlusso($tipologia)
   {
      $userID = $_SESSION['user'];
      $user = $this->getResponsabileById($userID);

    $query = "INSERT INTO Flusso(DATA,SEDE,TIPOLOGIA) VALUES('".date("Y/m/d")."','".$user[0]['SEDE']."','".$tipologia."')";
    if(!$this->executeQuery($query))
	 return false;
     $flusso = $this->myPdo->lastInsertId();
     return $flusso;
   }

function getUserByID($id)
   {
    $query = 'SELECT * FROM User WHERE ID="'.$id.'"';
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }


   function getEmailSede($id)
   {
    $query = 'SELECT EMAIL FROM Sedi WHERE ID="'.$id.'"';
    if(!$this->executeQuery($query))
	 return false;
	else
	 $appo = $this->fetchAll();
	 
	return $appo[0]['EMAIL']; 
   }
   
   function getFlussoOdierno($tipologia)
   {
    $query = 'SELECT * FROM Flusso WHERE DATA=CURDATE() AND SEDE="'.$_SESSION['sede'].'" AND TIPOLOGIA="'.$tipologia.'"';

    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }
   
  function inviaMail($id_flusso)
   {
    $query = "SELECT a.*,si.NOME as nomeSEDE, l.NOME as nomeLAVORO, s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE as CESSAZIONE
              FROM Stato_dipendenti AS s
                   JOIN Anagrafica_dipendenti AS a ON (s.ID_DIPENDENTE=a.ID)
                   JOIN Sedi AS si ON (a.SEDE=si.ID)
                   JOIN Lavoro AS l ON (a.LAVORO=l.ID)
              WHERE
                s.FLUSSO = '".$id_flusso."'";
    if(!$this->executeQuery($query))
				return false;
    else
        $dati = $this->fetchAll();
	  
	  $responsabile = $this->getUserByID($_SESSION['user']);
	  $email_sede = $this->getEmailSede($responsabile[0]['SEDE']);
          
//echo "<pre>";
    //print_r($dati);
               $a= $this->getValConf(2).", ".$this->getValConf(3).", ".$email_sede.", postmaster@i-factory.biz";
                $oggetto= stripslashes($this->getValConf(5))." - Creazione flusso per Assunzione n. ".$id_flusso."/".$dati[0]['nomeSEDE'];
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                $messaggio .= 'Spett.le Studio Galeandro, Vogliate predisporre tutti i documenti utili per le assunzioni sotto indicate.<br>In fede<br>';
                $messaggio .= $dati[0]['nomeSEDE']." - ".date("d/m/Y H:i:s")."<br>";
                $messaggio .= '<br><strong>Responsabile</strong> '.$responsabile[0]['COGNOME']."<br>";
                $messaggio .= '<br>Flusso n. <strong>'.$id_flusso.'</strong> - del '.date("d/m/Y H:i:s");
                $messaggio .= '<br>';
                $messaggio .= '<table border=1><tr><th style="font-size: 10px;"><b>Cognome Nome</b></th><th style="font-size: 10px;"><b>C.f</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Data di Nascita</th><th style="font-size: 10px;"><b>Luogo di nascita</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Prov</b></th><th style="font-size: 10px;"><b>Cap</b></th><th style="font-size: 10px;"><b>Indirizzo</b></th><th style="font-size: 10px;"><b>Città</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Prov</b></th><th style="font-size: 10px;"><b>Cap</b></th><th style="font-size: 10px;"><b>Sede</b></th><th style="font-size: 10px;"><b>Lavoro</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Data Assunzione</b></th><th style="font-size: 10px;"><b>Data Cessazione</b></th><th style="font-size: 10px;"><b>E-mail</b></th><th style="font-size: 10px;"><b>Titolo di studio</b></th><th style="font-size: 10px;"><b>Intestatario C/c</b></th><th style="font-size: 10px;"><b>IBAN</b></th>';
                $messaggio .= '</tr>';
              foreach($dati AS $dato){
                $messaggio .= '<tr><td nowrap style="font-size: 10px;">'.$dato['COGNOME'].' '.$dato['NOME'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['CF'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dato['DATA_NASCITA']).'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['LUOGO_NASCITA'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['PROV_NASCITA'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['CAP_NASCITA'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['INDIRIZZO'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['LUOGO_RES'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['PROV_RES'].'</td><td style="font-size: 10px;">'.$dato['CAP_RES'].'</td><td style="font-size: 10px;">'.$dato['nomeSEDE'].'</td><td style="font-size: 10px;">'.$dato['nomeLAVORO'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dato['ASSUNZIONE']).'</td><td style="font-size: 10px;">'.$this->data_it($dato['CESSAZIONE']).'</td><td style="font-size: 10px;">'.$dato['EMAIL'].'</td><td style="font-size: 10px;">'.$dato['TITOLO_STUDIO'].'</td><td style="font-size: 10px;">'.$dato['INTESTATARIO'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['IBAN'].'</td>';
                $messaggio .= '</tr>';
              }
                $messaggio .= '</table>';
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);
                
     //return $flusso;
   }


function inviaMailCessazione($id_flusso)
   {
    $query = "SELECT a.*,si.NOME as nomeSEDE, l.NOME as nomeLAVORO, s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE as CESSAZIONE,s.MOTIVAZIONE AS MOTIVAZIONE
              FROM Stato_dipendenti AS s
                   JOIN Anagrafica_dipendenti AS a ON (s.ID_DIPENDENTE=a.ID)
                   JOIN Sedi AS si ON (a.SEDE=si.ID)
                   JOIN Lavoro AS l ON (a.LAVORO=l.ID)
              WHERE
                s.FLUSSO_CESSAZIONE = '".$id_flusso."'";
    if(!$this->executeQuery($query))
				return false;
    else
        $dati = $this->fetchAll();
	  
	  $responsabile = $this->getUserByID($_SESSION['user']);
	  $email_sede = $this->getEmailSede($responsabile[0]['SEDE']);
    //echo "<pre>";
    //print_r($dati);
               $a= $this->getValConf(2).", ".$this->getValConf(3).", ".$email_sede.", postmaster@i-factory.biz";
                $oggetto= stripslashes($this->getValConf(5))." - Creazione flusso per Cessazione n. ".$id_flusso."/".$dati[0]['nomeSEDE'];
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                $messaggio .= 'Spett.le Studio Galeandro, Vogliate predisporre tutti i documenti utili per le cessazione sotto indicate.<br>In fede<br>';
                $messaggio .= $dati[0]['nomeSEDE']." - ".date("d/m/Y H:i:s")."<br>";
                $messaggio .= '<br><strong>Responsabile</strong> '.$responsabile[0]['COGNOME']."<br>";
                $messaggio .= '<br>Flusso n. <strong>'.$id_flusso.'</strong> - del '.date("d/m/Y H:i:s");
                $messaggio .= '<br>';
                $messaggio .= '<table border=1><tr><th style="font-size: 10px;"><b>Motivazione</b></th><th style="font-size: 10px;"><b>Cognome Nome</b></th><th style="font-size: 10px;"><b>C.f</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Data di Nascita</th><th style="font-size: 10px;"><b>Luogo di nascita</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Prov</b></th><th style="font-size: 10px;"><b>Cap</b></th><th style="font-size: 10px;"><b>Indirizzo</b></th><th style="font-size: 10px;"><b>Città</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Prov</b></th><th style="font-size: 10px;"><b>Cap</b></th><th style="font-size: 10px;"><b>Sede</b></th><th style="font-size: 10px;"><b>Lavoro</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Data Assunzione</b></th><th style="font-size: 10px;"><b>Data Cessazione</b></th><th style="font-size: 10px;"><b>Titolo di studio</b></th><th style="font-size: 10px;"><b>Intestatario C/c</b></th><th style="font-size: 10px;"><b>IBAN</b></th>';
                $messaggio .= '</tr>';
              foreach($dati AS $dato){
                $messaggio .= '<tr><td nowrap style="font-size: 10px;">'.$dato['MOTIVAZIONE'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['COGNOME'].' '.$dato['NOME'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['CF'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dato['DATA_NASCITA']).'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['LUOGO_NASCITA'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['PROV_NASCITA'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['CAP_NASCITA'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['INDIRIZZO'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['LUOGO_RES'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['PROV_RES'].'</td><td style="font-size: 10px;">'.$dato['CAP_RES'].'</td><td style="font-size: 10px;">'.$dato['nomeSEDE'].'</td><td style="font-size: 10px;">'.$dato['nomeLAVORO'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dato['ASSUNZIONE']).'</td><td style="font-size: 10px;">'.$this->data_it($dato['CESSAZIONE']).'</td><td style="font-size: 10px;">'.$dato['TITOLO_STUDIO'].'</td><td style="font-size: 10px;">'.$dato['INTESTATARIO'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['IBAN'].'</td>';
                $messaggio .= '</tr>';
              }
                $messaggio .= '</table>';
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);
                
     //return $flusso;
   }


function inviaMailProroga($id_flusso)
   {
   	//echo "<br>".$id_flusso."<br />";
    $query = "SELECT a.*,si.NOME as nomeSEDE, l.NOME as nomeLAVORO, s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE as CESSAZIONE
              FROM Stato_dipendenti AS s
                   JOIN Anagrafica_dipendenti AS a ON (s.ID_DIPENDENTE=a.ID)
                   JOIN Sedi AS si ON (a.SEDE=si.ID)
                   JOIN Lavoro AS l ON (a.LAVORO=l.ID)
              WHERE
                s.FLUSSO_PROROGA = '".$id_flusso."'";
    if(!$this->executeQuery($query))
				return false;
    else
        $dati = $this->fetchAll();
	  
    //echo "<pre>";
    //print_r($dati);
    //print_r($this->getErrors());
        
	  $responsabile = $this->getUserByID($_SESSION['user']);
	  $email_sede = $this->getEmailSede($responsabile[0]['SEDE']);

	  	$a= $this->getValConf(2).", ".$this->getValConf(3).", ".$email_sede.", postmaster@i-factory.biz";
                $oggetto= stripslashes($this->getValConf(5))." - Creazione flusso per Proroga n. ".$id_flusso."/".$dati[0]['nomeSEDE'];
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                $messaggio .= 'Spett.le Studio Galeandro, Vogliate predisporre tutti i documenti utili per le proroga sotto indicate.<br>In fede<br>';
                $messaggio .= $dati[0]['nomeSEDE']." - ".date("d/m/Y H:i:s")."<br>";
                $messaggio .= '<br><strong>Responsabile</strong> '.$responsabile[0]['COGNOME']."<br>";
                $messaggio .= '<br>Flusso n. <strong>'.$id_flusso.'</strong> - del '.date("d/m/Y H:i:s");
                $messaggio .= '<br>';
                $messaggio .= '<table border=1><tr><th style="font-size: 10px;"><b>Cognome Nome</b></th><th style="font-size: 10px;"><b>C.f</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Data di Nascita</th><th style="font-size: 10px;"><b>Luogo di nascita</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Prov</b></th><th style="font-size: 10px;"><b>Cap</b></th><th style="font-size: 10px;"><b>Indirizzo</b></th><th style="font-size: 10px;"><b>Città</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Prov</b></th><th style="font-size: 10px;"><b>Cap</b></th><th style="font-size: 10px;"><b>Sede</b></th><th style="font-size: 10px;"><b>Lavoro</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Data Assunzione</b></th><th style="font-size: 10px;"><b>Data Cessazione</b></th><th style="font-size: 10px;"><b>Titolo di studio</b></th><th style="font-size: 10px;"><b>Intestatario C/c</b></th><th style="font-size: 10px;"><b>IBAN</b></th>';
                $messaggio .= '</tr>';
              foreach($dati AS $dato){
                $messaggio .= '<tr><td nowrap style="font-size: 10px;">'.$dato['COGNOME'].' '.$dato['NOME'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['CF'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dato['DATA_NASCITA']).'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['LUOGO_NASCITA'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['PROV_NASCITA'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['CAP_NASCITA'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['INDIRIZZO'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['LUOGO_RES'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['PROV_RES'].'</td><td style="font-size: 10px;">'.$dato['CAP_RES'].'</td><td style="font-size: 10px;">'.$dato['nomeSEDE'].'</td><td style="font-size: 10px;">'.$dato['nomeLAVORO'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dato['ASSUNZIONE']).'</td><td style="font-size: 10px;">'.$this->data_it($dato['CESSAZIONE']).'</td><td style="font-size: 10px;">'.$dato['TITOLO_STUDIO'].'</td><td style="font-size: 10px;">'.$dato['INTESTATARIO'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dato['IBAN'].'</td>';
                $messaggio .= '</tr>';
              }
                $messaggio .= '</table>';
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);

                
     //return $flusso;
   }


function inviaMailTrasferimento($valori)
   {
        $responsabile = $this->getUserByID($_SESSION['user']);
        $sede = $this->getSediById($responsabile[0]['SEDE']);
   	//echo "<br>".$id_flusso."<br />";
                $a= $this->getValConf(2).", ".$this->getValConf(3).", ".$email_sede.", postmaster@i-factory.biz";
                $oggetto= stripslashes($this->getValConf(5))." - Creazione flusso per Trasferimento n. ".$valori['flusso']."/".$sede[0]['NOME'];
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                $messaggio .= 'Spett.le Studio Galeandro, Vogliate predisporre tutti i documenti utili per il trasferimento di sede dei dipendenti sotto indicati.<br>In fede<br>';
                $messaggio .= '<br>Flusso n. <strong>'.$valori['flusso'].'</strong> - del '.date("d/m/Y H:i:s");
                $messaggio .= '<br>';
                $messaggio .= '<table border=1><tr><th style="font-size: 10px;"><b>Cognome Nome</b></th><th style="font-size: 10px;"><b>C.f</b></th><th style="font-size: 10px;"><b>Sede</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Data Assunzione</b></th><th style="font-size: 10px;"><b>Data Cessazione</b></th><th style="font-size: 10px;"><b>Data Trasferimento</b></th>';
                $messaggio .= '</tr>';
              foreach($valori['dipendenti'] AS $dato){
                $dipendente = $this->getDipendenteById($dato['dipID']);
                $sede = $this->getSediById($dato['sedeID']);
                $messaggio .= '<tr><td nowrap style="font-size: 10px;">'.$dipendente[0]['COGNOME'].' '.$dipendente[0]['NOME'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dipendente[0]['CF'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$sede[0]['NOME'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dipendente[0]['DATA_ASSUNZIONE']).'</td>
                               <td style="font-size: 10px;">'.$this->data_it($dipendente[0]['DATA_CESSAZIONE']).'</td><td style="font-size: 10px;">'.date("d-m-Y").'</td>';
                $messaggio .= '</tr>';
              }
                $messaggio .= '</table>';
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);
     //return $flusso;
   }

function inviaMailChangeWork($valori)
   {
        $responsabile = $this->getUserByID($_SESSION['user']);
        $sede = $this->getSediById($responsabile[0]['SEDE']);
   	//echo "<br>".$id_flusso."<br />";
	  	$a= $this->getValConf(2).", ".$this->getValConf(3).", ".$email_sede.", postmaster@i-factory.biz";
                $oggetto= stripslashes($this->getValConf(5))." - Creazione flusso per Trasformazione n. ".$valori['flusso']."/".$sede[0]['NOME'];
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                $messaggio .= 'Spett.le Studio Galeandro, Vogliate predisporre tutti i documenti utili per la trasformazione dei dipendenti sotto indicati.<br>In fede<br>';
                $messaggio .= '<br>Flusso n. <strong>'.$valori['flusso'].'</strong> - del '.date("d/m/Y H:i:s");
                $messaggio .= '<br>';
                $messaggio .= '<table border=1><tr><th style="font-size: 10px;"><b>Cognome Nome</b></th><th style="font-size: 10px;"><b>C.f</b></th><th style="font-size: 10px;"><b>Lavoro</b></th>';
                $messaggio .= '<th style="font-size: 10px;"><b>Data Assunzione</b></th><th style="font-size: 10px;"><b>Data Cessazione</b></th><th style="font-size: 10px;"><b>Data Trasformazione</b></th>';
                $messaggio .= '</tr>';
              foreach($valori['dipendenti'] AS $dato){
                $dipendente = $this->getDipendenteById($dato['dipID']);
                $lavoro = $this->getLavoroById($dato['workID']);
                $messaggio .= '<tr><td nowrap style="font-size: 10px;">'.$dipendente[0]['COGNOME'].' '.$dipendente[0]['NOME'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$dipendente[0]['CF'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$lavoro[0]['NOME'].'</td>';
                $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dipendente[0]['DATA_ASSUNZIONE']).'</td>
                               <td style="font-size: 10px;">'.$this->data_it($dipendente[0]['DATA_CESSAZIONE']).'</td><td style="font-size: 10px;">'.date("d-m-Y").'</td>';
                $messaggio .= '</tr>';
              }
                $messaggio .= '</table>';
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);
     //return $flusso;
   }

function inviaMailModIban($flussoID,$valori)
   {
   	
	  $dipendente = $this->getDipendenteById($valori['dipendente']);
	  $responsabile = $this->getUserByID($_SESSION['user']);
	  $sede = $this->getSediById($responsabile[0]['SEDE']); 
	  $email_sede = $this->getEmailSede($responsabile[0]['SEDE']);

	  	$a= $this->getValConf(2).", ".$this->getValConf(3).", ".$email_sede.", postmaster@i-factory.biz";
                $oggetto= stripslashes($this->getValConf(5))." - Creazione flusso per Modifica IBAN n. ".$flussoID."/".$sede[0]['NOME'];
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                $messaggio .= 'Spett.le Studio Galeandro, Vogliate modificare il codice IBAN del dipendente di seguito riportato.<br>In fede<br>';
                $messaggio .= $sede[0]['NOME']." - ".date("d/m/Y H:i:s")."<br>";
                $messaggio .= '<br><strong>Responsabile</strong> '.$responsabile[0]['COGNOME']."<br>";
                $messaggio .= '<br>Flusso n. <strong>'.$flussoID.'</strong> - del '.date("d/m/Y H:i:s");
                $messaggio .= '<br>'.$dipendente[0]['COGNOME'].' '.$dipendente[0]['NOME'].'<br />';
                $messaggio .= 'IBAN: <strong>'.$valori['iban'].'</strong>';
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $messaggio;
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);
                

     //return $flusso;
   }
   

function inviaMailModEmail($flussoID,$valori)
   {

	  $dipendente = $this->getDipendenteById($valori['dipendente']);
	  $responsabile = $this->getUserByID($_SESSION['user']);
	  $sede = $this->getSediById($responsabile[0]['SEDE']);
	  $email_sede = $this->getEmailSede($responsabile[0]['SEDE']);

                $a= $this->getValConf(2).", ".$this->getValConf(3).", ".$email_sede.", postmaster@i-factory.biz";
                $oggetto= stripslashes($this->getValConf(5))." - Creazione flusso per Modifica E-mail n. ".$flussoID."/".$sede[0]['NOME'];
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                $messaggio .= 'Spett.le Studio Galeandro, Vogliate modificare l\'indirizzo e-mail del dipendente di seguito riportato.<br>In fede<br>';
                $messaggio .= $sede[0]['NOME']." - ".date("d/m/Y H:i:s")."<br>";
                $messaggio .= '<br><strong>Responsabile</strong> '.$responsabile[0]['COGNOME']."<br>";
                $messaggio .= '<br>Flusso n. <strong>'.$flussoID.'</strong> - del '.date("d/m/Y H:i:s");
                $messaggio .= '<br>'.$dipendente[0]['COGNOME'].' '.$dipendente[0]['NOME'].'<br />';
                $messaggio .= 'E-MAIL: <strong>'.$valori['email'].'</strong>';
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);
     //return $flusso;
   }

   function richiestaAiuto($valori)
   {
	$responsabile = $this->getUserByID($_SESSION['user']);
	$email_sede = $this->getEmailSede($responsabile[0]['SEDE']);
   	$a= "postmaster@i-factory.biz; ".$this->getValConf(2);
                $oggetto= stripslashes($this->getValConf(5))." - Richiesta di aiuto da paghe.studiogaleandro.it";
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                $messaggio .= '<h1>Studio Galeandro - Paghe</h1>';
                $messaggio .= '<br /><br />';
                $messaggio .= '<br><strong>Responsabile</strong> '.$responsabile[0]['COGNOME']."<br>";
				$messaggio .= '<br><strong>E-mail</strong> '.$email_sede."<br>";
                $messaggio .= '<br>';
				$messaggio .= '<br><strong>Titolo</strong> '.$valori['titolo']."<br>";
				$messaggio .= '<br><strong>Messaggio</strong> '.$valori['messaggio']."<br>";				
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);

     //return $flusso;
   }
   

  function creaFlusso($flusso,$dipendenti,$valori)
   {
    //print_r($dipendenti);
    $errori = array();
    if (is_array($dipendenti)){
        for($i=0;$i<count($dipendenti);$i++){
            $query = "INSERT INTO Stato_dipendenti(FLUSSO,ID_DIPENDENTE,STATO,DATA_ASSUNZIONE,DATA_CESSAZIONE) VALUES('".$flusso."','".$dipendenti[$i]."','Assunto','".$this->data_sql($valori['data_ass_'.$dipendenti[$i]])."','".$valori['data_cessazione_'.$dipendenti[$i]]."')";
            //echo $query."<br>";
            if(!$this->executeQuery($query))
                 $errori[$i]['inserimento'] = "Errore inserimento dipendente".$dipendente[$i];
        }
     $invio_mail = $this->inviaMail($flusso);
    }
     return $errori;
   }

  function creaFlussoModIban($flusso,$valori)
   {
    $errori = array();
		$query = "UPDATE Anagrafica_dipendenti SET IBAN = '".$valori['iban']."' WHERE ID='".$valori['dipendente']."' ";
        //echo $query."<br>";
        if(!$this->executeQuery($query))
        	$errori['inserimento'] = "Errore inserimento dipendente";
     $invio_mail = $this->inviaMailModIban($flusso,$valori);
     return $errori;
   }
   
  function creaFlussoModEmail($flusso,$valori)
   {
    $errori = array();
		$query = "UPDATE Anagrafica_dipendenti SET EMAIL = '".$valori['email']."' WHERE ID='".$valori['dipendente']."' ";
        //echo $query."<br>";
        if(!$this->executeQuery($query))
        	$errori['inserimento'] = "Errore inserimento dipendente";
     $invio_mail = $this->inviaMailModEmail($flusso,$valori);
     return $errori;
   }
   
   
function creaFlussoCessazione($flusso,$dipendenti,$valori)
   {
    //print_r($dipendenti);
    $errori = array();
    if (is_array($dipendenti)){
        foreach($dipendenti AS &$dipendenti){
            $query = "UPDATE Stato_dipendenti SET FLUSSO_CESSAZIONE='".$flusso."' WHERE ID_DIPENDENTE = '".$dipendenti."'";
            if(!$this->executeQuery($query))
                 $errori[$i]['flusso_cessazione'] = "Errore inserimento flusso di cessazione";
            $query = "UPDATE Stato_dipendenti SET DATA_CESSAZIONE='".$this->data_sql($valori['data_'.$dipendenti])."' WHERE ID_DIPENDENTE = '".$dipendenti."'";
            if(!$this->executeQuery($query))
                 $errori[$i]['data_cessazione'] = "Errore inserimento data cessazione";
            $query = "UPDATE Stato_dipendenti SET MOTIVAZIONE='".$valori['motivazione_'.$dipendenti]."' WHERE ID_DIPENDENTE = '".$dipendenti."'";
            if(!$this->executeQuery($query))
                 $errori[$i]['motivazione'] = "Errore inserimento motivazione";
        }
     $invio_mail = $this->inviaMailCessazione($flusso);
    }
     return $errori;
   }

function creaFlussoProroga($flusso,$dipendenti,$valori)
   {
   	//echo "Dipendenti<pre>";
   	//print_r($dipendenti);
   	//print_r($valori);
   	$errori = array();
    if (is_array($dipendenti)){
        foreach($dipendenti AS &$dipendenti){
            $query = "UPDATE Stato_dipendenti SET FLUSSO_PROROGA='".$flusso."' WHERE ID_DIPENDENTE = '".$dipendenti."'";
            //echo $query;
            if(!$this->executeQuery($query))
                 $errori[$i]['flusso_proroga'] = "Errore inserimento flusso di proroga";
            $query = "UPDATE Stato_dipendenti SET DATA_CESSAZIONE='".$this->data_sql($valori['data_proroga_'.$dipendenti])."' WHERE ID_DIPENDENTE = '".$dipendenti."'";
            if(!$this->executeQuery($query))
                 $errori[]['data_proroga'] = "Errore inserimento data proroga";
        }
     $invio_mail = $this->inviaMailProroga($flusso);
    }
     return $errori;
   }

function creaFlussoTrasferimento($flusso,$dipendenti,$valori)
   {
   	//echo "Dipendenti<pre>";
   	//print_r($dipendenti);
   	//print_r($valori);
   	$errori = array();
    if (is_array($dipendenti)){
        foreach($dipendenti AS &$dipendenti){
            $respID = $this->getResponsabileBySedeID($valori['sede_'.$dipendenti]);
            $dips[] = array(
                'dipID' => $dipendenti,
                'sedeID' => $valori['sede_'.$dipendenti]
            );
            $query = "UPDATE Anagrafica_dipendenti SET 
                            SEDE='".$valori['sede_'.$dipendenti]."',
                            ID_RESPONSABILE='".$respID[0]['ID']."' WHERE ID= '".$dipendenti."'";
            //echo $query;
            if(!$this->executeQuery($query))
                 $errori[$i]['flusso_proroga'] = "Errore aggiornamento flusso di trasferimento";
            $query = "UPDATE Stato_dipendenti SET
                            DATA_TRA='".date("Y-m-d")."',
                            FLUSSO_TRA='".$flusso."'
                          WHERE ID_DIPENDENTE = '".$dipendenti."'";
            //echo $query;
            if(!$this->executeQuery($query))
                 $errori[$i]['flusso_proroga'] = "Errore aggiornamento flusso di trasferimento";
        }
     $valoriML = array(
         'flusso' => $flusso,
         'dipendenti' => $dips,
     );
     $invio_mail = $this->inviaMailTrasferimento($valoriML);
    }
     return $errori;
   }

function creaFlussoChangeWork($flusso,$dipendenti,$valori)
   {
   	//echo "Dipendenti<pre>";
   	//print_r($dipendenti);
   	//print_r($valori);
   	$errori = array();
    if (is_array($dipendenti)){
        foreach($dipendenti AS &$dipendenti){
            $dips[] = array(
                'dipID' => $dipendenti,
                'workID' => $valori['work_'.$dipendenti]
            );
            $query = "UPDATE Anagrafica_dipendenti SET
                            LAVORO='".$valori['work_'.$dipendenti]."'
                            WHERE ID= '".$dipendenti."'";
            //echo $query;
            if(!$this->executeQuery($query))
            $errori[$i]['flusso_proroga'] = "Errore aggiornamento flusso di trasformazione";
            $query = "UPDATE Stato_dipendenti SET
                            DATA_CHW='".date("Y-m-d")."',
                            FLUSSO_CHW = '".$flusso."'
                          WHERE ID_DIPENDENTE = '".$dipendenti."'";
            echo $query;
            if(!$this->executeQuery($query))
                 $errori[$i]['flusso_proroga'] = "Errore aggiornamento flusso di trasformazione";
        }
     $valoriML = array(
         'flusso' => $flusso,
         'dipendenti' => $dips,
     );
     $invio_mail = $this->inviaMailChangeWork($valoriML);
    }
     return $errori;
   }



 function getAssuntiByIDResponsabile($id_responsabile)
   {
	  if ($id_responsabile){
    $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO,s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE)
              WHERE a.ID_RESPONSABILE = '".$id_responsabile."' AND s.STATO='Assunto'";
	  }else{
	      $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO, s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE)
              WHERE s.STATO='Assunto'";
	  }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

 function getAssuntiView($id_responsabile){
     if ($id_responsabile){
        $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO,s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede,s.FLUSSO_PROROGA,
                    CONCAT(a.NOME, ' ',a.COGNOME) AS fullname, l.NOME AS lavoroNome
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.DATA_CESSAZIONE >= CURDATE())
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE)
                  JOIN Lavoro AS l ON (l.ID=a.LAVORO)
              WHERE a.ID_RESPONSABILE = '".$id_responsabile."' AND s.STATO='Assunto' AND s.DATA_CESSAZIONE >= CURDATE() ORDER BY a.COGNOME ASC";
    }else{
	      $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO, s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede,
                  CONCAT(a.NOME, ' ',a.COGNOME) AS fullname , l.NOME AS lavoroNome
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE)
                  JOIN Lavoro AS l ON (l.ID=a.LAVORO)
              WHERE s.STATO='Assunto' AND s.DATA_CESSAZIONE >= CURDATE() ORDER BY a.COGNOME ASC";
    }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }


 function getAssuntiViewNew($id_responsabile, $anno, $mese)
   {
    $data_prev = $anno.$mese;
    $inizio = $anno."/".$mese."/".$this->mesi[$mese-1]['start'];
    $fine = $anno."/".$mese."/".$this->mesi[$mese-1]['end'];
    if ($id_responsabile){
       $query = "SELECT a.ID,a.COGNOME,a.NOME, a.LAVORO, a.COMPENSO, s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
              WHERE a.ID_RESPONSABILE = '".$id_responsabile."' AND a.LAVORO != 3 AND
                   !(s.DATA_CESSAZIONE < '{$inizio}') AND !(s.DATA_ASSUNZIONE > '{$fine}')
                 GROUP BY a.ID
                 ORDER BY a.COGNOME ASC";
    }else{
	      $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO, s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE)
              WHERE '{$data_prev}' BETWEEN
                            CONCAT(YEAR(s.DATA_ASSUNZIONE),MONTH(s.DATA_ASSUNZIONE)) AND
                            CONCAT(YEAR(s.DATA_CESSAZIONE),MONTH(s.DATA_CESSAZIONE))";
          }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

 function getAssuntiAgentiViewNew($anno, $mese)
   {
    $data_prev = $anno.$mese;
    $inizio = $anno."/".$mese."/".$this->mesi[$mese-1]['start'];
    $fine = $anno."/".$mese."/".$this->mesi[$mese-1]['end'];
    
       $query = "SELECT a.ID,a.COGNOME,a.NOME, a.LAVORO, a.COMPENSO, s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
              WHERE a.LAVORO = 3 AND
                   !(s.DATA_CESSAZIONE < '{$inizio}') AND !(s.DATA_ASSUNZIONE > '{$fine}')
                 ORDER BY a.COGNOME ASC";
    
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

 function getAssuntiViewPresenze($id_responsabile)
   {
	  if ($id_responsabile){
    $query = "SELECT a.*
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.DATA_CESSAZIONE > CURDATE())
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE)
              WHERE a.ID_RESPONSABILE = '".$id_responsabile."' AND a.LAVORO!=3 AND a.LAVORO!=4 AND s.STATO='Assunto' ORDER BY a.COGNOME";
	  }else{
	      $query = "SELECT a.*
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE)
              WHERE AND a.LAVORO!=3 AND a.LAVORO!=4 AND s.STATO='Assunto' ORDER BY a.COGNOME";
	  }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }
   
   
 function getScadenzario()
   {
    $query = "SELECT * FROM Scadenzario ORDER BY ID";
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function getConfigurazione()
   {
    $query = "SELECT * FROM Configurazione ORDER BY NOME ASC";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function getConfigurazioneById($id)
   {
    $query = "SELECT * FROM Configurazione WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }


  function uploadConfigurazione($valori)
   {
    $errore = array();
    $query = "UPDATE Configurazione SET NOME='".$valori['nome']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['nome'] = 1;
    $query = "UPDATE Configurazione SET VALORE='".$valori['valore']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['valore'] = 1;
    return $errore;
   }

  function getValConf($id)
   {
    $query = "SELECT VALORE FROM Configurazione WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
	 		return false;
		else
	 		$appo = $this->fetchAll();
	 return $appo[0]['VALORE'];
   }


  function creaCessazione($flusso,$dipendenti,$data)
   {
    //print_r($dipendenti);
    $errori = array();
    if (is_array($dipendenti)){
        for($i=0;$i<count($dipendenti);$i++){
            $query = "UPDATE Stato_dipendenti SET DATA_CESSAZIONE='".$this->data_sql($data)."' WHERE ID_DIPENDENTE = '".$dipendenti[$i]."'";
            //echo $query."<br>";
            if(!$this->executeQuery($query))
                 $errori[$i]['inserimento'] = "Errore inserimento dipendente".$dipendente[$i];
        }
     $invio_mail = $this->inviaMail($flusso);
    }
     return $errori;
   }

  function getFlussoAssunzioni()
  {
  	$valori = array();
    
  	if ($_SESSION['type'] != 1){ 
  		$query = "SELECT f.ID_FLUSSO,f.DATA	 
    		  FROM Flusso AS f 
    		  LEFT JOIN Stato_dipendenti AS s ON (f.ID_FLUSSO=s.FLUSSO)
    		  JOIN Anagrafica_dipendenti AS a ON (s.ID_DIPENDENTE=a.ID AND a.ID_RESPONSABILE='".$_SESSION['user']."')
                  WHERE f.TIPOLOGIA='assunzione'
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
  	}else{
  		$query = "SELECT f.ID_FLUSSO,f.DATA 
    		  FROM Flusso AS f 
    		  LEFT JOIN Stato_dipendenti AS s ON (f.ID_FLUSSO=s.FLUSSO)
                  WHERE f.TIPOLOGIA='assunzione'
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
  	}
  	//echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 $flussi = $this->fetchAll();
   	
	

	
   	foreach($flussi as $key=>$flusso){
  		$valori[$key]['id_flusso'] = $flusso['ID_FLUSSO'];
  		$valori[$key]['data_flusso'] = $flusso['DATA'];
    	
  		$query = "SELECT a.COGNOME,a.NOME, s.DATA_ASSUNZIONE, si.NOME as nomeSEDE 
    		  FROM Anagrafica_dipendenti AS a 
    		  LEFT JOIN Sedi AS si ON (a.SEDE=si.ID)
    		  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.FLUSSO='".$flusso['ID_FLUSSO']."')";
    	if(!$this->executeQuery($query))
    		return false;
    	else
    		$valori[$key]['dipendenti'] = $this->fetchAll(); 
  	}
	return $valori;
  }
  
  function getFlussoProroga()
  {
  	$valori = array();
  	if ($_SESSION['type'] != 1){ 
  	$query = "SELECT f.ID_FLUSSO,f.DATA 
    		  FROM Flusso AS f 
    		  LEFT JOIN Stato_dipendenti AS s ON (f.ID_FLUSSO=s.FLUSSO_PROROGA)
    		  JOIN Anagrafica_dipendenti AS a ON (s.ID_DIPENDENTE=a.ID AND a.ID_RESPONSABILE='".$_SESSION['user']."')
                  WHERE f.TIPOLOGIA='proroga'
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
  	}else{
    $query = "SELECT f.ID_FLUSSO,f.DATA 
    		  FROM Flusso AS f 
    		  LEFT JOIN Stato_dipendenti AS s ON (f.ID_FLUSSO=s.FLUSSO_PROROGA)
                  WHERE f.TIPOLOGIA='proroga'
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
    }
  	if(!$this->executeQuery($query))
	 return false;
	else
	 $flussi = $this->fetchAll();
   
  	foreach($flussi as $key=>$flusso){
  		$valori[$key]['id_flusso'] = $flusso['ID_FLUSSO'];
  		$valori[$key]['data_flusso'] = $flusso['DATA'];
    	
  		$query = "SELECT a.COGNOME,a.NOME, s.DATA_CESSAZIONE, si.NOME as nomeSEDE  
    		  FROM Anagrafica_dipendenti AS a 
    		  LEFT JOIN Sedi AS si ON (a.SEDE=si.ID)
    		  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.FLUSSO_PROROGA='".$flusso['ID_FLUSSO']."')";
    	if(!$this->executeQuery($query))
    		return false;
    	else
    		$valori[$key]['dipendenti'] = $this->fetchAll(); 
  	}
	return $valori;
  }
  
  function getFlussoCessazione()
  {
  	$valori = array();
    if ($_SESSION['type'] != 1){ 
  	$query = "SELECT f.ID_FLUSSO,f.DATA 
    		  FROM Flusso AS f 
    		  LEFT JOIN Stato_dipendenti AS s ON (f.ID_FLUSSO=s.FLUSSO_CESSAZIONE)
    		  JOIN Anagrafica_dipendenti AS a ON (s.ID_DIPENDENTE=a.ID AND a.ID_RESPONSABILE='".$_SESSION['user']."')
                  WHERE f.TIPOLOGIA='cessazione'
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
    }else{
    $query = "SELECT f.ID_FLUSSO,f.DATA 
    		  FROM Flusso AS f 
    		  LEFT JOIN Stato_dipendenti AS s ON (f.ID_FLUSSO=s.FLUSSO_CESSAZIONE)
    		  WHERE f.TIPOLOGIA='cessazione'
                    GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
    }
    if(!$this->executeQuery($query))
	 return false;
	else
	 $flussi = $this->fetchAll();
   
  	foreach($flussi as $key=>$flusso){
  		$valori[$key]['id_flusso'] = $flusso['ID_FLUSSO'];
  		$valori[$key]['data_flusso'] = $flusso['DATA'];
    	
  		$query = "SELECT a.COGNOME,a.NOME, s.DATA_CESSAZIONE, si.NOME as nomeSEDE, s.MOTIVAZIONE AS MOTIVAZIONE 
    		  FROM Anagrafica_dipendenti AS a
    		  LEFT JOIN Sedi AS si ON (a.SEDE=si.ID)
    		  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.FLUSSO_CESSAZIONE='".$flusso['ID_FLUSSO']."')";
    	if(!$this->executeQuery($query))
    		return false;
    	else
    		$valori[$key]['dipendenti'] = $this->fetchAll(); 
  	}
	return $valori;
  }   

  function getFlussoPresenze()
  {
    $valori = array();
  	$query = "SELECT f.ID_FLUSSO,f.DATA
    		  FROM Flusso AS f
    		  WHERE f.TIPOLOGIA='invio presenze'
    		  GROUP BY f.ID_FLUSSO";
    if(!$this->executeQuery($query))
	 return false;
	else
	 $flussi = $this->fetchAll();

  	foreach($flussi as $key=>$flusso){
  		$valori[$key]['id_flusso'] = $flusso['ID_FLUSSO'];
  		$valori[$key]['data_flusso'] = $flusso['DATA'];
        }
  		
	return $valori;
  }


  function getFlussoIBAN()
  {
  	//echo $_SESSION['user'];
  	$user = $this->getUserByID($_SESSION['user']);
  	/*echo "<pre>";
  	print_r($user);
  	echo "</pre>";*/
  	$valori = array();
    if ($_SESSION['type'] != 1){ 
  		echo $query = "SELECT f.ID_FLUSSO,f.DATA, s.NOME as nomeSEDE
    		  FROM Flusso AS f
    		   LEFT JOIN Sedi AS s ON (s.ID=f.SEDE)  
    		  WHERE f.TIPOLOGIA ='modifica iban' AND f.SEDE=".$user[0]['SEDE']."
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
    }else{
    	$query = "SELECT f.ID_FLUSSO,f.DATA,  s.NOME as nomeSEDE
    		  FROM Flusso AS f 
    		   LEFT JOIN Sedi AS s ON (s.ID=f.SEDE)
    		  WHERE f.TIPOLOGIA ='modifica iban'
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
    }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 $flussi = $this->fetchAll();
   
	return $flussi;
  }   
  
  function getFlussoTrasformazione()
  {
  	//echo $_SESSION['user'];
  	$user = $this->getUserByID($_SESSION['user']);
  	/*echo "<pre>";
  	print_r($user);
  	echo "</pre>";*/
  	$valori = array();
    if ($_SESSION['type'] != 1){
  		$query = "SELECT f.ID_FLUSSO AS id_flusso,f.DATA, s.NOME as nomeSEDE
    		  FROM Flusso AS f
    		   LEFT JOIN Sedi AS s ON (s.ID=f.SEDE)
    		  WHERE f.TIPOLOGIA ='trasformazione' AND f.SEDE=".$user[0]['SEDE']."
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
    }else{
    	$query = "SELECT f.ID_FLUSSO AS id_flusso,f.DATA
    		  FROM Flusso AS f
    		   LEFT JOIN Sedi AS s ON (s.ID=f.SEDE)
    		  WHERE f.TIPOLOGIA ='trasformazione'
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
    }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 $flussi = $this->fetchAll();

  	foreach($flussi as $key=>$flusso){
  		$valori[$key]['id_flusso'] = $flusso['id_flusso'];
  		$valori[$key]['data_flusso'] = $flusso['DATA'];

  		$query = "SELECT a.COGNOME,a.NOME, s.DATA_TRA, si.NOME as nomeSEDE, l.NOME AS lavoro
    		  FROM Anagrafica_dipendenti AS a
    		  LEFT JOIN Sedi AS si ON (a.SEDE=si.ID)
                  JOIN Lavoro AS l ON (a.LAVORO=l.ID)
    		  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.FLUSSO_CHW='".$flusso['id_flusso']."')";
    	if(!$this->executeQuery($query))
    		return false;
    	else
    		$valori[$key]['dipendenti'] = $this->fetchAll();
  	}
	return $valori;
  }
  
  function getFlussoTrasferimento()
  {
  	//echo $_SESSION['user'];
  	$user = $this->getUserByID($_SESSION['user']);
  	/*echo "<pre>";
  	print_r($user);
  	echo "</pre>";*/
  	$valori = array();
    if ($_SESSION['type'] != 1){
  		$query = "SELECT f.ID_FLUSSO,f.DATA, s.NOME as nomeSEDE
    		  FROM Flusso AS f
    		   LEFT JOIN Sedi AS s ON (s.ID=f.SEDE)
    		  WHERE f.TIPOLOGIA ='trasferimento sede' AND f.SEDE=".$user[0]['SEDE']."
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
    }else{
    	$query = "SELECT f.ID_FLUSSO,f.DATA
    		  FROM Flusso AS f
    		   LEFT JOIN Sedi AS s ON (s.ID=f.SEDE)
    		  WHERE f.TIPOLOGIA ='trasferimento sede'
    		  GROUP BY f.ID_FLUSSO ORDER BY f.ID_FLUSSO DESC";
    }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 $flussi = $this->fetchAll();

        

  	foreach($flussi as $key=>$flusso){
  		$valori[$key]['id_flusso'] = $flusso['ID_FLUSSO'];
                $valori[$key]['data_flusso'] = $flusso['DATA'];

  		$query = "SELECT a.COGNOME,a.NOME, s.DATA_TRA, si.NOME as nomeSEDE
    		  FROM Anagrafica_dipendenti AS a
    		  LEFT JOIN Sedi AS si ON (a.SEDE=si.ID)
    		  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.FLUSSO_TRA='".$flusso['ID_FLUSSO']."')";
    	if(!$this->executeQuery($query))
    		return false;
    	else
    		$valori[$key]['dipendenti'] = $this->fetchAll();
  	}
	return $valori;
  }
  
  function deleteDipendente($id)
   {
    $errore = array();
    $query = "DELETE FROM Anagrafica_dipendenti WHERE ID=".$id."";
    //echo $query;
    if(!$this->executeQuery($query))
	 $errore['dipendente'] = 1;
    return $errore;
  }
  
 function addRetri($valori)
   {
    $errore = array();
    $query = "INSERT INTO Retribuzione(ID_SEDE,GIORNO,NOTTE,BONUS_PDA) VALUES ('".$valori['sede']."','".str_replace(",",".",$valori['giorno'])."','".str_replace(",",".",$valori['notte'])."','".$valori['bonus']."')";
    if(!$this->executeQuery($query))
	 $errore['retri'] = 1;
    return $errore;
   }


  function getRetribuzioni()
   {
	$query = "SELECT r.*, s.NOME AS nomeSede 
			  FROM Retribuzione AS r
				JOIN Sedi AS s ON (r.ID_SEDE=s.ID)
			  ORDER BY s.NOME ASC";

    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }
   
 function getRetriById($id)
   {
    $query = "SELECT * FROM Retribuzione WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function deleteRetri($id)
   {
    $errore = array();
    $query = "DELETE FROM Retribuzione WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
	 $errore['lavoro'] = 1;
    return $errore;
   }
   
  function uploadRetri($valori)
   {
    $errore = array();
    $query = "UPDATE Retribuzione SET ID_SEDE='".$valori['sede']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['sede'] = 1;
    $query = "UPDATE Retribuzione SET GIORNO='".str_replace(",",".",$valori['giorno'])."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['giorno'] = 1;
    $query = "UPDATE Retribuzione SET NOTTE='".str_replace(",",".",$valori['notte'])."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['notte'] = 1;
    $query = "UPDATE Retribuzione SET BONUS_PDA='".$valori['bonus']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 $errore['bonus'] = 1;
    return $errore;
   }
   
  function addPresenza($valori)
   {
     
    $contratti = $valori['contratti'] ? $valori['contratti'] : 0;
    $pda = $valori['pda'] ? $valori['pda'] : 0;
    $query = "INSERT INTO Presenze(dipendenteID,data,inizio,fine,contratti,pda, tipoOra) VALUES ('".$valori['dipendenteID']."','".$this->data_sql($valori['data'])."','".$valori['ingresso']."','".$valori['uscita']."','".$contratti."','".$pda."','".$valori['tipoORA']."')";
    if(!$this->executeQuery($query))
        return 0;
    else
    	return 1;
   }

  function addPresenzaNew($valori)
   {
   $ore_am = ($valori['ore_am']) ? $valori['ore_am'] : 0;
   $ore_pm = ($valori['ore_pm']) ? $valori['ore_pm'] : 0;
   $prova = ($valori['prova']) ? $valori['prova'] : 0;
   $app_private = ($valori['app_private']) ? $valori['app_private'] : 0;
   $app_business = ($valori['app_business']) ? $valori['app_business'] : 0;
   $pda_private = ($valori['pda_private']) ? $valori['pda_private'] : 0;
   $pda_business = ($valori['pda_business']) ? $valori['pda_business'] : 0;
   
    $query = "INSERT INTO Presenze(dipendenteID,data, ore_am, ore_pm, prova, app_private, app_business, pda_private, pda_business) VALUES
                                   ('".$valori['dipendenteID']."',
                                    '".$this->data_sql($valori['data'])."',
                                    '".$ore_am."',
                                    '".$ore_pm."',
                                    '".$prova."',
                                    '".$app_private."',
                                    '".$app_business."',
                                    '".$pda_private."',
                                    '".$pda_business."')";
    if(!$this->executeQuery($query))
        return 0;
    else
    	return 1;
   }

  function deletePresenza($id)
   {
    $query = "DELETE FROM Presenze WHERE ID='".$id."'";
    if(!$this->executeQuery($query))
		return 0;
	else
    	return 1;
   }
   
function updatePresenza($valori)
   {
    $contratti = $valori['contratti'] ? $valori['contratti'] : 0;
    $pda = $valori['pda'] ? $valori['pda'] : 0;
    $inizio = $valori['inizio'] ? "inizio = '".$valori['inizio']."', " : "";
    $query = "UPDATE Presenze SET 
                $inizio
                fine = '".$valori['uscita']."',
                contratti = '".$contratti."',
                tipoOra = '".$valori['tipoORA']."',
                pda = '".$pda."'
                WHERE ID='".$valori['id']."'";
    echo $query;
    if(!$this->executeQuery($query))
	 $valore = "Errore";
	return $valore;
   }   

function updatePresenzaNew($valori)
   {
    $ore_am = $valori['ore_am'] ? $valori['ore_am'] : 0;
    $ore_pm = $valori['ore_pm'] ? $valori['ore_pm'] : 0;
    $prova = $valori['prova'] ? $valori['prova'] : 0;
    $app_private = $valori['app_private'] ? $valori['app_private'] : 0;
    $app_business = $valori['app_business'] ? $valori['app_business'] : 0;
    $pda_private = $valori['pda_private'] ? $valori['pda_private'] : 0;
    $pda_business = $valori['pda_business'] ? $valori['pda_business'] : 0;
    $query = "UPDATE Presenze SET
                ore_am = '".$ore_am."',
                ore_pm = '".$ore_pm."',
                prova = '".$prova."',
                app_private = '".$app_private."',
                app_business = '".$app_business."',
                pda_private = '".$pda_private."',
                pda_business = '".$pda_business."'
                WHERE ID='".$valori['id']."'";
                //echo $query;
    if(!$this->executeQuery($query))
	 $valore = "Errore";
	return $valore;
   }

 function rilevaPresenzeGiornaliere($mese,$anno,$id_responsabile)
   {
   	$valori = array();
   	$giorni_mese = cal_days_in_month(CAL_GREGORIAN, $mese, $anno);
	$mese_corrente = $mese ;  
	for ($i=1;$i<=$giorni_mese;$i++){	
   	 $data = $anno."-".$mese."-".$i;
   	$query = "SELECT p.ID_DIPENDENTE FROM Presenze AS p
				JOIN Anagrafica_dipendenti AS a ON (p.ID_DIPENDENTE = a.ID AND a.ID_RESPONSABILE=".$id_responsabile.")
				WHERE p.DATA='".$data."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 $dipendenti = $this->fetchAll();
   	 foreach($dipendenti AS $dipendente){
   			$query = "SELECT ORE FROM Presenze WHERE ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND TIPO='G' AND DATA='".$data."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$data][$dipendente['ID_DIPENDENTE']]['G'] = $appo[0]['ORE'];

			$query = "SELECT ORE FROM Presenze WHERE ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND TIPO='N' AND DATA='".$data."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$data][$dipendente['ID_DIPENDENTE']]['N'] = $appo[0]['ORE'];
   				
			$query = "SELECT ORE FROM Presenze WHERE ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND TIPO='PDA' AND DATA='".$data."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$data][$dipendente['ID_DIPENDENTE']]['PDA'] = $appo[0]['ORE'];
   	 }
	}// chiusura for giorni
   	 
   	 return $valori;
   }


  function totalePresenzeByMeseAnno($dipID,$mese,$anno)
   {
    $query = "SELECT p.dipendenteID,
                    SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(CONCAT(p.data, ' ', p.fine), CONCAT(p.data,' ', p.inizio))))) AS oreTOT,
                    SUM(p.contratti) AS contrattiTOT,
                    SUM(p.pda) AS pdaTOT
              FROM Presenze AS p
                WHERE p.dipendenteID = '".$dipID."' AND
                MONTH(p.data)='".$mese."' AND YEAR(p.data)='".$anno."' GROUP BY p.tipoOra ORDER BY p.tipoOra";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function totalePresenzeByMeseAnnoNew($dipID,$mese,$anno)
   {
    $query = "SELECT
                    TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(ore_am))),'%H:%i') AS ore_am,
                    TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(ore_pm))),'%H:%i') AS ore_pm,
                    TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(prova))),'%H:%i') AS prova,
                     SUM(app_private) AS app_private,
                     SUM(app_business) AS app_business,
                     SUM(pda_private) AS pda_private,
                     SUM(pda_business) AS pda_business
              FROM Presenze 
              WHERE dipendenteID = '".$dipID."' AND MONTH(data)='".$mese."' AND YEAR(data)='".$anno."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }


  function esistezePresenza($idDipendente,$data,$tipo)
   {
    $query = "SELECT ID FROM Presenze WHERE ID_DIPENDENTE='".$idDipendente."' AND TIPO='".$tipo."' AND DATA='".$data."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 $appo = $this->fetchAll();

	 $valore = $appo[0]['ID'];
	return $valore; 
   }
   
  function esistePresenzaDIP($idDipendente,$data)
   {
    $query = "SELECT ID,
                 TIME_FORMAT(TIMEDIFF(CONCAT(data, ' ', fine), CONCAT(data,' ', inizio)), '%l:%i') AS ore,
                 TIME_FORMAT(inizio,'%H:%i') AS inizio,
                 TIME_FORMAT(fine,'%H:%i') AS fine,
                 TIME_FORMAT(inizio_notte,'%H:%i') AS inizio_notte,
                 TIME_FORMAT(fine_notte,'%H:%i') AS fine_notte,
                 TIME_FORMAT(TIMEDIFF(CONCAT(data, ' ', fine_notte), CONCAT(data,' ', inizio_notte)), '%l:%i') AS ore_notte,
                 contratti,pda
              FROM Presenze WHERE dipendenteID='".$idDipendente."' AND data='".$data."' GROUP BY data";
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

function esistePresenzaDIPNew($idDipendente,$data)
   {
    $query = "SELECT
                  TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(ore_am))),'%k:%i') AS ore_am,
                  TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(ore_pm))),'%k:%i') AS ore_pm,
                  TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(prova))),'%k:%i') AS prova
              FROM Presenze WHERE dipendenteID='".$idDipendente."' AND data='".$data."'";
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

function searchDIPFromCF($codice)
   {
    $query = "SELECT *
              FROM Anagrafica_dipendenti WHERE CF='".$codice."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }


  function getPresenzeByData($data)
   {
    $query = "SELECT p.ID,
                     p.dipendenteID,
                     p.data,
                     TIME_FORMAT(p.ore_am, '%H:%i') AS ore_am,
                     TIME_FORMAT(p.ore_pm, '%H:%i') AS ore_pm,
                     TIME_FORMAT(p.prova, '%H:%i') AS prova,
                     p.app_private,
                     p.app_business,
                     p.pda_private,
                     p.pda_business
    			FROM Presenze AS p
				JOIN Anagrafica_dipendenti AS ad ON (ad.ID=p.dipendenteID AND ad.ID_RESPONSABILE='".$_SESSION['user']."')
    			WHERE p.data='".$data."' ORDER BY ad.COGNOME";
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

 function rilevaPresenzeMensileTotali($mese,$anno,$id_responsabile)
   {
   	$valori = array();
	//echo $mese;
   	$query = "SELECT p.ID_DIPENDENTE FROM Presenze AS p
   				JOIN Anagrafica_dipendenti AS a ON (a.ID=p.ID_DIPENDENTE AND a.ID_RESPONSABILE=".$id_responsabile.") 
   				WHERE MONTH(DATA)='".$mese."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 $dipendenti = $this->fetchAll();
   	 foreach($dipendenti AS $dipendente){
   			$query = "SELECT SUM(ORE) AS ORE FROM Presenze WHERE ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND TIPO='G' AND MONTH(DATA)='".$mese."' AND YEAR(DATA)='".$anno."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$dipendente['ID_DIPENDENTE']]['G'] = $appo[0]['ORE'];

			$query = "SELECT SUM(ORE) AS ORE FROM Presenze WHERE ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND TIPO='N' AND MONTH(DATA)='".$mese."' AND YEAR(DATA)='".$anno."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$dipendente['ID_DIPENDENTE']]['N'] = $appo[0]['ORE'];
   				
			$query = "SELECT SUM(ORE) AS ORE FROM Presenze WHERE ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND TIPO='PDA' AND MONTH(DATA)='".$mese."'  AND YEAR(DATA)='".$anno."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$dipendente['ID_DIPENDENTE']]['PDA'] = $appo[0]['ORE'];
   	 }
   	 
   	 return $valori;
   }
   
 function totaliGiornalieri($mese,$anno,$id_resposanbile)
   {
   	$valori = array();
	//echo $mese;
	$giorni_mese = cal_days_in_month(CAL_GREGORIAN, $mese, $anno);
   	for($i=1;$i<=$giorni_mese;$i++){
   		$data = $anno.'-'.$mese.'-'.$i;
	 		$query = "SELECT SUM(p.ORE) AS ORE FROM Presenze AS p
	 					JOIN Anagrafica_dipendenti AS a ON (p.ID_DIPENDENTE=a.ID AND a.ID_RESPONSABILE=".$id_resposanbile.")
	 					WHERE p.TIPO='G' AND p.DATA='".$data."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$data]['G'] = $appo[0]['ORE'];

			$query = "SELECT SUM(p.ORE) AS ORE FROM Presenze AS p
						JOIN Anagrafica_dipendenti AS a ON (p.ID_DIPENDENTE=a.ID AND a.ID_RESPONSABILE=".$id_resposanbile.")
						WHERE p.TIPO='N' AND p.DATA='".$data."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$data]['N'] = $appo[0]['ORE'];
   				
			$query = "SELECT SUM(p.ORE) AS ORE FROM Presenze AS p
						JOIN Anagrafica_dipendenti AS a ON (p.ID_DIPENDENTE=a.ID AND a.ID_RESPONSABILE=".$id_resposanbile.")
						WHERE p.TIPO='PDA' AND p.DATA='".$data."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$data]['PDA'] = $appo[0]['ORE'];
   	 }
   	 
   	 return $valori;
   }

 function totaliMese($mese,$anno,$id_resposanbile)
   {
   	$valori = array();
	
	$query = "SELECT SUM(p.ORE) AS ORE FROM Presenze AS p
	 					JOIN Anagrafica_dipendenti AS a ON (p.ID_DIPENDENTE=a.ID AND a.ID_RESPONSABILE=".$id_resposanbile.")
	 					WHERE p.TIPO='G' AND MONTH(p.DATA)='".$mese."' AND YEAR(p.DATA)='".$anno."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori['G'] = $appo[0]['ORE'];

			$query = "SELECT SUM(p.ORE) AS ORE FROM Presenze AS p
						JOIN Anagrafica_dipendenti AS a ON (p.ID_DIPENDENTE=a.ID AND a.ID_RESPONSABILE=".$id_resposanbile.")
						WHERE p.TIPO='N' AND MONTH(p.DATA)='".$mese."' AND YEAR(p.DATA)='".$anno."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori['N'] = $appo[0]['ORE'];
   				
			$query = "SELECT SUM(p.ORE) AS ORE FROM Presenze AS p
						JOIN Anagrafica_dipendenti AS a ON (p.ID_DIPENDENTE=a.ID AND a.ID_RESPONSABILE=".$id_resposanbile.")
						WHERE p.TIPO='PDA' AND MONTH(p.DATA)='".$mese."' AND YEAR(p.DATA)='".$anno."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$data]['PDA'] = $appo[0]['ORE'];

		return $valori;
   }
   
   
 function getAssuntiAgentiViewPresenze($id_responsabile)
   {
	  if ($id_responsabile){
    $query = "SELECT a.*
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.DATA_CESSAZIONE > CURDATE())
              WHERE a.ID_RESPONSABILE = '".$id_responsabile."' AND a.LAVORO=3 AND s.STATO='Assunto' ORDER BY a.COGNOME";
	  }else{
	      $query = "SELECT a.*
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
              WHERE AND a.LAVORO=3 AND s.STATO='Assunto' ORDER BY a.COGNOME";
	  }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }
   
  function addCompensoAgenti($valori)
   {
    $errore = array();
    $results = array_keys($valori);
    $id_sede = $valori['sede'];
    for($i=0;$i<=(count($results)-2);$i++){
  		if ($valori[$results[$i]]){
			//echo $i.") ".$results[$i].": ".$_POST[$results[$i]]."<br>";
  			list($vuoto, $id_dipendente, $mese, $anno) = explode("_", $results[$i]);
			echo "Dipendente:".$id_dipendente."<br>";
			$compenso = $_POST[$results[$i]];
			//Controllo se devo inserire o fare l'aggiornamento
			$checkPresenza = $this->esistezaCompenso($id_dipendente,$mese,$anno);
			//echo $checkPresenza."<br>";
			if ($checkPresenza)
				$inserimento = $this->updateCompenso($checkPresenza,$compenso); 
			else	
				$inserimento = $this->insertCompenso($id_dipendente,$mese,$anno,$compenso);
  			
			if ($inserimento == "Errore") $errore[$id_dipendente] = "Errore nell'inserimento";
  		}	
	}     
	 
    return $errore;
   }
   
  function esistezaCompenso($idDipendente,$mese,$anno)
   {
    $query = "SELECT ID FROM Compenso_agenti WHERE ID_DIPENDENTE='".$idDipendente."' AND MESE='".$mese."' AND ANNO='".$anno."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 $appo = $this->fetchAll();

	 $valore = $appo[0]['ID'];
	return $valore; 
   }
   
   function updateCompenso($idrecord, $compenso)
   {
   	//echo $ore;
    $query = "UPDATE Compenso_agenti SET COMPENSO = '".$compenso."' WHERE ID='".$idrecord."'";
    //echo $query;
    if(!$this->executeQuery($query))
	 $valore = "Errore";
    //print_r($this->getErrors());
	return $valore;
   }   

  function deleteCompenso($dipendente, $mese, $anno)
   {
    $query = "DELETE FROM Compenso_agenti WHERE dipendenteID='".$dipendente."' AND mese ='".$mese."' AND anno='".$anno."' ";
    if(!$this->executeQuery($query))
	 $valore = "Errore";
    return $valore;
   }

  function insertCompenso($dipendente, $mese, $anno, $compenso)
   {
    $query = "INSERT INTO Compenso_agenti(dipendenteID,mese,anno,compenso) VALUES ('".$dipendente."','".$mese."','".$anno."','".str_replace(",",".",$compenso)."')";
    if(!$this->executeQuery($query))
	 $valore = "Errore";
    return $valore;
   }
   
  function rilevaCompenso($mese,$anno,$dipendente)
   {
   	$valori = array();
   	$query = "SELECT compenso FROM Compenso_agenti WHERE dipendenteID='".$dipendente."' AND mese='".$mese."' AND anno='".$anno."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   	 
   }
   
  function getFlussi()
   {
   	$query = "SELECT f.*, s.NOME AS nomeSEDE FROM Flusso AS f
   				LEFT JOIN Sedi AS s ON (s.ID=f.SEDE)
   			  ORDER BY f.ID_FLUSSO DESC";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function compensiSede($idutente)
   {
   	$query = "SELECT r.*
   				FROM Retribuzione AS r
   				JOIN User AS u ON (u.SEDE=r.ID_SEDE AND u.ID='".$idutente."')";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function getFlussoByID($flussoID)
   {
   	$query = "SELECT * FROM Flusso WHERE ID_FLUSSO='".$flussoID."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }


  function deleteFLussoCessazione($idflusso)
   {
	$query = "DELETE FROM Flusso WHERE ID_FLUSSO='".$idflusso."'";
    $this->executeQuery($query);
    
    $query = "UPDATE Stato_dipendenti SET FLUSSO_CESSAZIONE='0' WHERE FLUSSO_CESSAZIONE='".$idflusso."'";
    $this->executeQuery($query);
    
  	return true;
   }

   function deleteFLussoPresenze($idflusso)
   {
	$query = "DELETE FROM Flusso WHERE ID_FLUSSO='".$idflusso."'";
    $this->executeQuery($query);

  	return true;
   }

  function deleteFLussoProroga($idflusso)
   {
	$query = "DELETE FROM Flusso WHERE ID_FLUSSO='".$idflusso."'";
    $this->executeQuery($query);
    
    $query = "UPDATE Stato_dipendenti SET FLUSSO_PROROGA='0' WHERE FLUSSO_PROROGA='".$idflusso."'";
    $this->executeQuery($query);
    
  	return true;
   }

  function deleteFLusso($idflusso)
   {
	$query = "DELETE FROM Flusso WHERE ID_FLUSSO='".$idflusso."'";
    $this->executeQuery($query);
    
    $query = "UPDATE Stato_dipendenti SET FLUSSO='0' WHERE FLUSSO='".$idflusso."'";
    $this->executeQuery($query);
    
  	return true;
   }
   
  function flussoEvaso($valori)
   {
   	//print_r($valori);
    $query = "UPDATE Flusso SET EVASO='".date("Y-m-d")."' WHERE ID_FLUSSO='".$valori['flusso']."'";
    $this->executeQuery($query);
	//print_r($this->getErrors());
    $flusso = $this->getFlussoByID($valori['flusso']);
    $sede = $this->getSediById($flusso[0]['SEDE']);
    $sedeDati = $this->getSedeFromDipendenti($valori['flusso']);
    //print_r($dati);
               $a= $this->getValConf(2).", ".$this->getValConf(3).", ".$sede[0][EMAIL].", postmaster@i-factory.biz";
                $oggetto= stripslashes($this->getValConf(5)). " - Evasione flusso n. ".$valori['flusso']."/".$sede[0]['NOME'];
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                $messaggio .= 'Spett.le RESPONSABILE,<br /> ';
                $messaggio .= 'Il flusso n. '.$valori['flusso'].' &egrave; stato evaso in data '.date("d-m-Y");
                $messaggio .= '<br /><strong>Studio Galenadro</strong>';
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);
    
  	return true;
   }

 function rilevaMonitoringGiornaliere($mese,$anno,$id_responsabile)
   {
   	$valori = array();
   	$giorni_mese = cal_days_in_month(CAL_GREGORIAN, $mese, $anno);
	$mese_corrente = $mese ;  
	
	for ($i=1;$i<=$giorni_mese;$i++){	
   	 $data = $anno."-".$mese."-".$i;
   	$query = "SELECT p.ID_DIPENDENTE FROM Presenze AS p
				JOIN Anagrafica_dipendenti AS a ON (p.ID_DIPENDENTE = a.ID AND a.ID_RESPONSABILE=".$id_responsabile.")
				WHERE p.DATA='".$data."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 $dipendenti = $this->fetchAll();
   	 foreach($dipendenti AS $dipendente){
   			$query = "SELECT p.ORE + p1.ORE AS TOTALE 
   						FROM Presenze AS p,
   							 Presenze AS p1 
   						WHERE p.ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND p.TIPO='G' AND p.DATA='".$data."' AND
   							  p1.ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND p1.TIPO='G' AND p1.DATA='".$data."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$totale = $appo[0]['TOTALE'];
   				
			$query = "SELECT ORE FROM Presenze WHERE ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND TIPO='PDA' AND DATA='".$data."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$pda = $appo[0]['ORE'];

/*
   				
			$query = "SELECT ORE FROM Presenze WHERE ID_DIPENDENTE='".$dipendente['ID_DIPENDENTE']."' AND TIPO='PDA' AND DATA='".$data."'";
    		if(!$this->executeQuery($query))
	 			return false;
			else
	 			$appo = $this->fetchAll();
   				$valori[$data][$dipendente['ID_DIPENDENTE']]['PDA'] = $appo[0]['ORE'];
*/
   				if ( ($pda> 0) && ($totale > 0))		
	 				$valori[$data][$dipendente['ID_DIPENDENTE']]['valore'] = $pda/$totale;
	 			else
	 				$valori[$data][$dipendente['ID_DIPENDENTE']]['valore'] = 0;
   	 } // chiusura for dipendenti
   	 
	}// chiusura for giorni
   	 
   	 return $valori;
   }   
   
  function getSedeFromDipendenti($flusso)
   {
   	$query = "SELECT s.NOME,s.EMAIL 
   			  FROM Stato_dipendenti AS sd
   			  	JOIN Anagrafica_dipendenti AS ad ON (ad.ID=sd.ID_DIPENDENTE)
   			  	JOIN Sedi AS s ON (ad.SEDE=s.ID)
   			  WHERE (sd.FLUSSO = '".$flusso."') OR (sd.FLUSSO_CESSAZIONE = '".$flusso."') OR (sd.FLUSSO_PROROGA = '".$flusso."')  
   			    GROUP BY sd.FLUSSO LIMIT 0,1";
    //echo $query;
   	if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }   

  function getFlussiWithLimit($limit)
   {
   	$query = "SELECT f.*, s.NOME AS nomeSEDE FROM Flusso AS f
   				LEFT JOIN Sedi AS s ON (s.ID=f.SEDE)
   			  ORDER BY f.ID_FLUSSO DESC LIMIT 0, ".$limit."";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }   

 function getAssuntiAll($id_responsabile)
   {
	  if ($id_responsabile){
    $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO,s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede,s.FLUSSO_PROROGA
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE)
              WHERE a.ID_RESPONSABILE = '".$id_responsabile."' AND s.STATO='Assunto'";
	  }else{
	      $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO, s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE)
              WHERE s.STATO='Assunto'";
	  }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }   
   
 function getAssuntiViewSede($sedeID)
   {
    $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO,s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede,s.FLUSSO_PROROGA
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.DATA_CESSAZIONE >= CURDATE())
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE AND se.ID='".$sedeID."')
              WHERE s.STATO='Assunto' AND s.DATA_CESSAZIONE >= CURDATE()";
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

 function getAssuntiViewSedeNew($sedeID, $anno, $mese)
   {
     $dataProv = $anno."-".$mese."-1";
    $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO,s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede,s.FLUSSO_PROROGA
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE)
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE AND se.ID='".$sedeID."')
              WHERE a.LAVORO != 3 AND {$dataProv} BETWEEN s.DATA_ASSUNZIONE AND  s.DATA_CESSAZIONE";
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

 function getAssuntiViewSedeProroga($sedeID)
   {
    $query = "SELECT a.*,s.FLUSSO, f.DATA as dataFLUSSO,s.DATA_ASSUNZIONE AS ASSUNZIONE, s.DATA_CESSAZIONE AS CESSAZIONE, se.NOME as nomeSede,s.FLUSSO_PROROGA
              FROM Anagrafica_dipendenti AS a
                  JOIN Stato_dipendenti AS s ON (a.ID=s.ID_DIPENDENTE AND s.DATA_CESSAZIONE >= CURDATE())
                  JOIN Flusso AS f ON (s.FLUSSO=f.ID_FLUSSO)
                  JOIN Sedi as se ON (se.ID=a.SEDE AND se.ID='".$sedeID."')
              WHERE s.STATO='Assunto' AND s.DATA_CESSAZIONE >= CURDATE() AND s.FLUSSO_PROROGA>0";
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

function inviaMailCheckDocks($valori)
   {
	  $email_sede = $this->getSediById($valori['sede']);
//          echo '<pre>';
//          print_r($email_sede);
//          echo '</pre>';
          $sede = $this->getSediById($valori['sede']);

	  	$a = $this->getValConf(2).", ". $this->getValConf(3).", ".$email_sede[0]['EMAIL'].", postmaster@i-factory.biz";
                $oggetto= stripslashes($this->getValConf(5))." - Controllo documenti - Sede di ".$sede[0]['NOME'];
                $messaggio = '<html><body style="margin: 10px;"><strong>'.stripslashes($this->getValConf(5)).'</strong><br />';
                $messaggio .= '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">';
                if($valori['contratto']){
                $messaggio .= '<br>Contratto';
                $messaggio .= '<table border=1><tr><th style="font-size: 10px;"><b>Cognome Nome</b></th><th style="font-size: 10px;"><b>C.f</b></th><th style="font-size: 10px;"><b>Assunzione</b></th><th style="font-size: 10px;"><b>Cessazione</b></th>';
                $messaggio .= '</tr>';
                foreach($valori['contratto'] AS &$dato){
                    $dip = $this->getDipendenteById($dato);
                    $messaggio .= '<tr><td nowrap style="font-size: 10px;">'.$dip[0]['COGNOME'].' '.$dip[0]['NOME'].'</td>';
                    $messaggio .= '<td nowrap style="font-size: 10px;">'.$dip[0]['CF'].'</td>';
                    $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dip[0]['DATA_ASSUNZIONE']).'</td>';
                    $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dip[0]['DATA_CESSAZIONE']).'</td>';
                    $messaggio .= '</tr>';
                }
                $messaggio .= '</table>';
                }
                if($valori['proroga']){
                $messaggio .= '<br>Proroga';
                $messaggio .= '<table border=1><tr><th style="font-size: 10px;"><b>Cognome Nome</b></th><th style="font-size: 10px;"><b>C.f</b></th><th style="font-size: 10px;"><b>Assunzione</b></th><th style="font-size: 10px;"><b>Cessazione</b></th>';
                $messaggio .= '</tr>';
                foreach($valori['proroga'] AS &$dato){
                    $dip = $this->getDipendenteById($dato);
                    $messaggio .= '<tr><td nowrap style="font-size: 10px;">'.$dip[0]['COGNOME'].' '.$dip[0]['NOME'].'</td>';
                    $messaggio .= '<td nowrap style="font-size: 10px;">'.$dip['CF'].'</td>';
                    $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dip[0]['DATA_ASSUNZIONE']).'</td>';
                    $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dip[0]['DATA_CESSAZIONE']).'</td>';
                    $messaggio .= '</tr>';
                }
                $messaggio .= '</table>';
                }
                if($valori['cob']){
                $messaggio .= '<br>COB';
                $messaggio .= '<table border=1><tr><th style="font-size: 10px;"><b>Cognome Nome</b></th><th style="font-size: 10px;"><b>C.f</b></th><th style="font-size: 10px;"><b>Assunzione</b></th><th style="font-size: 10px;"><b>Cessazione</b></th>';
                $messaggio .= '</tr>';
                foreach($valori['cob'] AS &$dato){
                    $dip = $this->getDipendenteById($dato);
                    $messaggio .= '<tr><td nowrap style="font-size: 10px;">'.$dip[0]['COGNOME'].' '.$dip[0]['NOME'].'</td>';
                    $messaggio .= '<td nowrap style="font-size: 10px;">'.$dip['CF'].'</td>';
                    $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dip[0]['DATA_ASSUNZIONE']).'</td>';
                    $messaggio .= '<td nowrap style="font-size: 10px;">'.$this->data_it($dip[0]['DATA_CESSAZIONE']).'</td>';
                    $messaggio .= '</tr>';
                }
                $messaggio .= '</table>';
                }
                $messaggio .= '<br />Note:<br />'.$valori['note'].'<br /><br />';
                $messaggio .= 'Studio Galeandro<br /><br />';
                $messaggio .= '</div>';
                $messaggio .= '</body></html>';
                $intestazioni= "From:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "Reply-To:paghe@studiogaleandro.it\r\n";
                $intestazioni .= "MIME-Version: 1.0\n";
                $intestazioni .= "Content-Type: text/html; charset=\"utf-8\"\n";
                $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
                mail($a, $oggetto, $messaggio, $intestazioni);

     //return $flusso;
   }

 // Inserisce una nuova sede
 function addDocs($sedeID,$nomeFile,$titolo)
   {
    $query = "INSERT INTO documenti(sedeID,descrizione,filename,data) VALUES
                                    ('".$sedeID."',
                                     '".addslashes($titolo)."',
                                     '".$nomeFile."',
                                     '".date("Y-m-d")."')";
    if(!$this->executeQuery($query))
	 return false;
    
    return true;
   }

    function deleteDocs($ID)
   {
    $query = "DELETE FROM documenti WHERE ID='".$ID."'";
    if(!$this->executeQuery($query))
	 return false;

    return true;
   }

    function ListDocsSedeID($sedeID = null)
   {
    if($sedeID){
        $query = "SELECT d.*, s.NOME
                  FROM documenti AS d
                      JOIN Sedi AS s ON (d.sedeID=s.ID)
                  WHERE d.sedeID='".$sedeID."' ORDER BY d.descrizione ASC";
    }else{
        $query = "SELECT d.ID,
                    d.sedeID,
                    d.descrizione,
                    d.filename,
                    d.immagine,
                    DATE_FORMAT(d.data,'%d/%m/%Y') AS data,
                    s.NOME AS sede
                  FROM documenti AS d
                      JOIN Sedi AS s ON (d.sedeID=s.ID)
                  ORDER BY s.NOME, d.descrizione ASC";
    }
    //echo $query;
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

  function getMesiPresenze(){
    $query = "SELECT * FROM Presenze_blocco_mese ORDER BY anno, mese DESC";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

   function addMesiPresenze($valori){
   $sedeID = ($valori['sedeID']) ? $valori['sedeID'] : 0;
   $abilitato = ($valori['abilitato']) ? $valori['abilitato'] : 1;
   $query = "INSERT INTO Presenze_blocco_mese(sedeID, mese, anno, abilitato) VALUES
                    ('".$sedeID."', '".$valori['mese']."', '".$valori['anno']."', '1')";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return true;
   }


  function updateMesiPresenze($valori){
    $query = "UPDATE Presenze_blocco_mese SET abilitato='".$valori['abilitato']."' WHERE ID='".$valori['id']."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return $this->fetchAll();
   }

    function deleteMesiPresenze($ID)
   {
    $query = "DELETE FROM Presenze_blocco_mese WHERE ID='".$ID."'";
    if(!$this->executeQuery($query))
	 return false;

    return true;
   }

    function deleteMeseBlocco($valori)
   {
    $query = "DELETE FROM Presenze_blocco_mese WHERE
        sedeID='".$valori['sedeID']."' AND
        mese='".$valori['mese']."' AND
        anno='".$valori['anno']."'";
    if(!$this->executeQuery($query))
	 return false;

    return true;
   }



  function MeseIsBlocked($sede, $mese,$anno){
    $query = "SELECT
            IF(abilitato, 1, 0) AS blocked
            FROM Presenze_blocco_mese
            WHERE sedeID='".$sede."' AND mese='".$mese."' AND anno='".$anno."'";
    if(!$this->executeQuery($query))
	 return false;
	else
	 $appo = $this->fetchAll();
        if($appo[0]['blocked'] == 1)
            return true;
        else
            return false;
   }

   function CompensoAdd($valori){
   $abilitato = ($valori['abilitato']) ? $valori['abilitato'] : 0;
   $query = "INSERT INTO compensi(sedeID, lavoroID, inizio, fine, compenso_gg, compenso_nt, compenso_pda, compenso_app, compenso_appb, compenso_pdab, abilitato) VALUES
                    ('".$valori['sede']."', '".$valori['lavoro']."', 
                     '".$this->data_sql($valori['inizio'])."',
                     '".$this->data_sql($valori['fine'])."',
                     '".str_replace(",",".",$valori['compenso_gg'])."',
                     '".str_replace(",",".",$valori['compenso_nt'])."',
                     '".str_replace(",",".",$valori['compenso_pda'])."',
                     '".str_replace(",",".",$valori['compenso_app'])."',
                     '".str_replace(",",".",$valori['compenso_appb'])."',
                     '".str_replace(",",".",$valori['compenso_pdab'])."',
                     '".$abilitato."')";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return true;
   }

  function ListCompensi(){
    $query = "SELECT c.*, s.NOME AS sede, l.NOME AS lavoro
              FROM compensi AS c
              JOIN sedi AS s ON (s.ID = c.sedeID)
              JOIN Lavoro AS l ON (l.ID=c.lavoroID)
            ORDER BY s.NOME, l.NOME ASC";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return  $this->fetchAll();
   }

    function CompensoDelete($ID)
   {
    $query = "DELETE FROM compensi WHERE ID='".$ID."'";
    if(!$this->executeQuery($query))
	 return false;

    return true;
   }

  function ListFlussiLavorare(){
    $query = "SELECT ID_FLUSSO AS ID, CONCAT(ID_FLUSSO, '-',TIPOLOGIA) AS nome
              FROM flusso
              WHERE EVASO IS NULL
            ORDER BY ID_FLUSSO ASC";
    if(!$this->executeQuery($query))
	 return false;
	else
	 return  $this->fetchAll();
   }

  function UpdateBorsellino($ID,$valore)
   {
    $query = "UPDATE borsellino SET valore='".str_replace(",",".",$valore)."' WHERE ID='".$ID."'";
    if(!$this->executeQuery($query))
	 $errore['nome'] = 1;
    
    return $errore;
   }   
   
  function EliminaBorsellino($ID)
   {
    $query = "DELETE FROM borsellino WHERE ID='".$ID."'";
    if(!$this->executeQuery($query))
	 $errore['nome'] = 1;
    
    return $errore;
   }   
   
 function InsertBorsellino($userID,$valore)
   {
    $errore = array();
    
    $query = "INSERT INTO borsellino(userID,valore) VALUES ('".$userID."','".str_replace(",",".",$valore)."')";
    //echo $query;
    if(!$this->executeQuery($query))
	 $errore['add'] = $this->getErrors();
    return $errore;
   }   

 function addEnter($ID)
   {
    $errore = array();
    //$ofd=floor($_POST['minuti']/15)*15; 
    $query = "INSERT INTO Presenze(dipendenteID,data, inizio) VALUES ('".$ID."','".date("Y-m-d")."','".date("H:i:s")."')";
    if(!$this->executeQuery($query))
	 $errore['retri'] = 1;
    return $errore;
   }   
   
 function addExit($ID){
    $query = "UPDATE Presenze SET 
                fine='".date("H:i:s")."' WHERE dipendenteID={$ID} AND data='".date("Y-m-d")."' AND inizio IS NOT NULL";
    //echo $query;
    if(!$this->executeQuery($query))
	 $errore['retri'] = 1;
    
    $dati = $this->esistePresenzaDIP($item['ID'], date("Y-m-d"));
    $ora = $dati[0]['ore'];
    $minuti = explode(":",$ora);
    $y = count($minuti);
    if($y == 3){
        $min=floor($minuti[1]/15)*15; 
        $lav = $minuti[0].':'.$min.':00';
    }
    if($y == 2){
        $min=floor($minuti[0]/15)*15; 
        $lav = $min.':'.$minuti[1].':00';
    }

    $query = "UPDATE Presenze SET 
                ore_giorno='".$lav."' WHERE dipendenteID={$ID} AND data='".date("Y-m-d")."'";
    //echo $query;
    if(!$this->executeQuery($query))
    	 $errore['upd'] = 1;
    
    return $errore;
   }   
   
function addEnterNight($ID)
   {
    $errore = array();
    $result = $this->esistePresenzaDIP($ID, date("Y-m-d"));
    if($result[0]['ID']){
        $query = "UPDATE Presenze SET inizio_notte = '".date("H:i:s")."' WHERE dipendenteID='".$ID."' AND data='".date("Y-m-d")."'";
    }else{
        $query = "INSERT INTO Presenze(dipendenteID,data, inizio_notte) VALUES ('".$ID."','".date("Y-m-d")."','".date("H:i:s")."')";
    }    
    if(!$this->executeQuery($query))
	 $errore['retri'] = 1;
    return $errore;
   }   
   
 function addExitNight($ID){
    $query = "UPDATE Presenze SET 
                fine_notte='".date("H:i:s")."' WHERE dipendenteID={$ID} AND data='".date("Y-m-d")."' AND inizio_notte IS NOT NULL";
    //echo $query;
    if(!$this->executeQuery($query))
	 $errore['retri'] = 1;
    
    $dati = $this->esistePresenzaDIP($item['ID'], date("Y-m-d"));
    $ora = $dati[0]['ore'];
    $minuti = explode(":",$ora);
    $y = count($minuti);
    if($y == 3){
        $min=floor($minuti[1]/15)*15; 
        $lav = $minuti[0].':'.$min.':00';
    }
    if($y == 2){
        $min=floor($minuti[0]/15)*15; 
        $lav = $min.':'.$minuti[1].':00';
    }

    $query = "UPDATE Presenze SET 
                ore_notte='".$lav."' WHERE dipendenteID={$ID} AND data='".date("Y-m-d")."'";
    //echo $query;
    if(!$this->executeQuery($query))
    	 $errore['upd'] = 1;
    
    return $errore;
   }   
  
   
   
}// end class
