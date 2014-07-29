<?php
include("../commonSetting.php");
include_once('../class/json.php');

$oJSON = new JSON();

if($_POST['task']=='getContratti')
 {
  	//echo $_POST['idalbergo'];
 	$contratti = $CTR->getContrattiByAlbergo($_POST['idalbergo']);
  
  if(count($contratti)>0)
   {
        $result['esito']=true;
        $result['result']=$contratti;
   }else{
   	$result['esito']=false;
   }
   //echo $result['esito'];
   echo $oJSON->encode($result);  
 }

 
if($_POST['task']=='getTipoStrutFromLocalita')
 {
  	//echo $_POST['idalbergo'];
 	$contratti = $CTR->getTipoStrutFromLocalita($_POST['idlocalita']);
  
  if(count($contratti)>0)
   {
        $result['esito']=true;
        $result['result']=$contratti;
   }else{
   	$result['esito']=false;
   }
   //echo $result['esito'];
   echo $oJSON->encode($result);  
 }

if($_POST['task']=='changeStateUser')
 {
  	//echo $_POST['idalbergo']."<br>";
  	$userID = $_POST['userID'];
  	//echo $_POST['data_partenza'];
 	$user= $UC->getUserById($userID);
  	//print_r($CTR->getErrors());
  
	$result['utente'] = $userID; 
	if ($user[0]['ABILITATO'] == 0){
 		$result['testo'] = '<span class="approved"><a href="#" id="'.$user[0]['ID'].'" class="abilitazione">Abilitato</a></span>';
 		$query = "UPDATE User SET ABILITATO=1 WHERE ID='".$userID."'";
 		$UC->executeQuery($query);
	}else{
 		$result['testo'] = '<span class="pending"><a href="#" id="'.$user[0]['ID'].'" class="abilitazione">Disabilitato</a></span>';
 		$query = "UPDATE User SET ABILITATO=0 WHERE ID='".$userID."'";
 		$UC->executeQuery($query);
	}
 	
   //echo $result['esito'];
   echo $oJSON->encode($result);  
 }

if($_POST['task']=='getSezioniModulo')
 {
  	//echo $_POST['idalbergo'];
 	$sezioni = $AD->getSezioniByModulo($_POST['modulo'],1);
  	//print_r($sezioni);
  if(count($sezioni)>0)
   {
        $result['esito']=true;
        $result['result']=$sezioni;
   }else{
   	$result['esito']=false;
   }
   //echo $result['esito'];
   echo $oJSON->encode($result);  
 }

if($_POST['task']=='getAgenziaFromCitta')
 {
  	//echo $_POST['idalbergo'];
 	$citta = $CF->getAgenzieFromCitta($_POST['idcitta']);
  	//print_r($sezioni);
  if(count($citta)>0)
   {
        $result['esito']=true;
        $result['result']=$citta;
   }else{
   	$result['esito']=false;
   }
   //echo $result['esito'];
   echo $oJSON->encode($result);  
 }

if($_POST['task']=='getComuniFromProvincia')
 {
  	//echo $_POST['idalbergo'];
 	$citta = $CF->getComuniFromProvincia($_POST['idprov']);
  	//print_r($sezioni);
  if(count($citta)>0)
   {
        $result['esito']=true;
        $result['result']=$citta;
   }else{
   	$result['esito']=false;
   }
   //echo $result['esito'];
   echo $oJSON->encode($result);  
 }

if($_POST['task']=='getProdottiFromCategoriaID')
 {
  	//echo $_POST['categoriaID'];
 	$proQRE = $PRD->getProdottoFromCategoryID($_POST['categoriaID'],1);
  	//Helper::printR($prodotti);
  if(count($proQRE)>0)
   {
        $result['esito']=true;
        $result['result']=$proQRE;
   }else{
   	$result['esito']=false;
   }
   //echo $result['esito'];
   echo $oJSON->encode($result);  
 }
 
 
 if($_POST['task']=='getColoreFromTaglia')
 {
  	//echo $_POST['categoriaID'];
 	$proQRE = $PRD->getColoriFromTagliaID($_POST['prodottoID'],$_POST['taglia']);
  	//Helper::printR($prodotti);
  if(count($proQRE)>0)
   {
        $result['esito']=true;
        $result['result']=$proQRE;
   }else{
   	$result['esito']=false;
   }
   //echo $result['esito'];
   echo $oJSON->encode($result);  
 }
 
 if($_POST['task']=='getQtaFromColoreID')
 {
  	//echo $_POST['categoriaID'];
 	$proQRE = $PRD->getMagazzinoById($_POST['id']);
  	//Helper::printR($prodotti);
  if(count($proQRE)>0)
   {
        $result['esito']=true;
        $result['result']=$proQRE[0]['qta'];
   }else{
   	$result['esito']=false;
   }
   //echo $result['esito'];
   echo $oJSON->encode($result);  
 }

 ?>