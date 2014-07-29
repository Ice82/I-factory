<?php
include_once('class.phpmailer.php');

class General{
 
 private $cnn;
 
 function __construct()
  {
    $this->cnn = new Connection();
   
  }
  
   
 	function getDashoboard($idtype){
 			if ($idtype != 1){
 				$query = 'SELECT m.* 
 					FROM Moduli AS m
 					JOIN Permessi_modulo AS pm ON (m.ID=pm.ID_MODULO AND pm.ID_TYPE="'.$idtype.'")
 					ORDER BY m.ORDINE ASC';
 			}else{
 				$query = 'SELECT * FROM Moduli ORDER BY ORDINE ASC';
 			}
 			//echo $query;
 			if(!$this->cnn->executeQuery($query))
	 			return false;
			else
	 			return $this->cnn->fetchAll();
	}
   
 	function getSezioniByModulo($modulo){
		$query = 'SELECT * FROM Sezioni WHERE ID_MODULO="'.$modulo.'" ORDER BY NOME ASC';
    	if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->cnn->fetchAll();
	}
	
 	function getPagineBySezione($sezione){
		$query = 'SELECT * FROM Pagine WHERE ID_SEZIONE="'.$sezione.'" ORDER BY NOME ASC';
    	if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->cnn->fetchAll();
	}

 	/*
 	 $parentID [int] => identificativo della macrocategoria
 	 $qta [int] => quanti sottocateorie deve stampare
 	 $abilitato [0/1] => abilitato o meno
 	 
 	 output => stampa il numero di link richiesti con l'href 
 	 */
	function getSubCatFromParentID($parentID,$qta,$abilitato){
		global $RE;
		if ($abilitato)
 			$query = 'SELECT ID,nome FROM Categorie WHERE parentID="'.$parentID.'" AND abilitato="1" ORDER BY ordine,nome ASC LIMIT 0,'.$qta;
 		else
 			$query = 'SELECT ID,nome FROM Categorie WHERE parentID="'.$parentID.'" ORDER BY ordine,nome ASC LIMIT 0,'.$qta;
 		if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		$valori = $this->cnn->fetchAll();
	 		
	 	if ($valori){
	 		foreach($valori AS $key=>$valore){
	 			if ($key == 0)
	 				echo '<a href="'.$RE->rewrite("risultati.php?categoriaID=".$parentID."&amp;subCat=".$valore['ID']."").'">'.stripslashes($valore['nome']).'</a> ';
	 			else
	 				echo ' - <a href="'.$RE->rewrite("risultati.php?categoriaID=".$parentID."&amp;subCat=".$valore['ID']."").'">'.stripslashes($valore['nome']).'</a>';
	 		}		
		}
	}	



} //end class