<?php

class Admin{
 private $cnn;
 
 function __construct()
  {
   
   $this->cnn = new Connection();
  }
  
   
 	function addModulo($valori){
		$query = 'INSERT INTO Moduli (NOME,IMMAGINE,PAGINA,ORDINE,VISUALIZZA) VALUES("'.addslashes($valori['nome']).'","'.addslashes($valori['immagine']).'","'.addslashes($valori['pagina']).'","'.$valori['ordine'].'","'.$valori['abilitato'].'")';
    	if(!$this->cnn->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	}
   
 	function getModuli($abilitato){
		if ($abilitato)
 			$query = 'SELECT * FROM Moduli WHERE VISUALIZZA="'.$abilitato.'" ORDER BY NOME ASC';
 		else
 			$query = 'SELECT * FROM Moduli ORDER BY NOME ASC';
    	if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->cnn->fetchAll();
	}
	
 	function getModuloById($id){
 		$query = 'SELECT * FROM Moduli WHERE ID="'.$id.'"';
    	if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->cnn->fetchAll();
	}
	
   function modifyModulo($valori)
   {
    $errori = array();
    $query = 'UPDATE Moduli SET 
    				NOME="'.addslashes($valori['nome']).'",
    				IMMAGINE="'.$valori['immagine'].'",
    				PAGINA="'.$valori['pagina'].'",
    				ORDINE="'.$valori['ordine'].'",
    				VISUALIZZA="'.$valori['abilitato'].'" WHERE ID="'.$valori['id'].'"';
    if(!$this->cnn->executeQuery($query))
	 $errori['modifica'] = 1;

	return $errori;
   }	

 	function deleteModulo($id){
 		$query = 'DELETE FROM Moduli WHERE ID="'.$id.'"';
    	if(!$this->cnn->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	}

 	function addType($valori){
		$query = 'INSERT INTO Type (NOME,DESCRIZIONE,ABILITATO) VALUES("'.addslashes($valori['nome']).'","'.addslashes($valori['descr']).'","'.$valori['abilitato'].'")';
    	if(!$this->cnn->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	}
	
 	function getType($abilitato){
		if ($abilitato)
 			$query = 'SELECT * FROM Type WHERE ABILITATO="'.$abilitato.'" ORDER BY NOME ASC';
 		else
 			$query = 'SELECT * FROM Type ORDER BY NOME ASC';
    	if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->cnn->fetchAll();
	}

 	function getTypeById($id){
 		$query = 'SELECT * FROM Type WHERE ID="'.$id.'"';
    	if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->cnn->fetchAll();
	}
	
   function modifyTipologiaUtente($valori)
   {
    $errori = array();
    $query = 'UPDATE Type SET 
    				NOME="'.addslashes($valori['nome']).'",
    				DESCRIZIONE="'.addslashes($valori['descr']).'",
    				ABILITATO="'.$valori['abilitato'].'" WHERE ID="'.$valori['id'].'"';
    if(!$this->cnn->executeQuery($query))
	 $errori['modifica'] = 1;
	return $errori;
   }	

 	function deleteTipologiaUtente($id){
 		$query = 'DELETE FROM Type WHERE ID="'.$id.'"';
    	if(!$this->cnn->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	}
   
 	function addSezione($valori){
		$query = 'INSERT INTO Sezioni (NOME,ID_MODULO,ABILITATO) VALUES("'.addslashes($valori['nome']).'","'.addslashes($valori['modulo']).'","'.$valori['abilitato'].'")';
    	if(!$this->cnn->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	}

 	function getSezioni($abilitato){
		if ($abilitato)
 			$query = 'SELECT s.*, m.NOME AS MODULO 
 					  FROM Sezioni AS s
 					  	JOIN Moduli AS m ON (m.ID=s.ID_MODULO)
 					  WHERE ABILITATO="'.$abilitato.'" ORDER BY NOME ASC';
 		else
 			$query = 'SELECT s.*, m.NOME AS MODULO
 					  FROM Sezioni AS s
 					  	JOIN Moduli AS m ON (m.ID=s.ID_MODULO)
 					  ORDER BY NOME ASC';
 		if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->cnn->fetchAll();
	}

 	function getSezioniByModulo($modulo,$abilitato){
		if ($abilitato)
 			$query = 'SELECT * 
 					  FROM Sezioni 
 					  WHERE ID_MODULO="'.$modulo.'" AND ABILITATO="'.$abilitato.'" ORDER BY NOME ASC';
 		else
 			$query = 'SELECT *
 					  FROM Sezioni 
 					  WHERE ID_MODULO="'.$modulo.'" ORDER BY NOME ASC';
 		//echo $query;
 		if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->fetchAll();
	}
	
 	function getSezioneById($id){
 		$query = 'SELECT * FROM Sezioni WHERE ID="'.$id.'"';
    	if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->fetchAll();
	}

   function modifySezione($valori)
   {
    $errori = array();
    $query = 'UPDATE Sezioni SET 
    			NOME="'.addslashes($valori['nome']).'",
    			ID_MODULO="'.$valori['modulo'].'",
    			ABILITATO="'.$valori['abilitato'].'" WHERE ID="'.$valori['id'].'"';
    if(!$this->cnn->executeQuery($query))
	 $errori['modifica'] = 1;
	 return $errori;
   }	
	
 	function deleteSezione($id){
 		$query = 'DELETE FROM Sezioni WHERE ID="'.$id.'"';
    	if(!$this->cnn->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	}
 	
	function addPagina($valori){
		$query = 'INSERT INTO Pagine (ID_SEZIONE,NOME,FILE) VALUES("'.$valori['sezione'].'","'.addslashes($valori['nome']).'","'.$valori['file'].'")';
    	if(!$this->cnn->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	}
 	
	function getPagine(){
 		$query = 'SELECT p.ID,m.NOME AS MODULO, s.NOME AS SEZIONE, p.NOME 
 					FROM Pagine AS p
 						JOIN Sezioni AS s ON (p.ID_SEZIONE=s.ID) 
 						JOIN Moduli AS m ON (s.ID_MODULO=m.ID)
 					ORDER BY MODULO,SEZIONE ASC';
    	if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->cnn->fetchAll();
	}
	
	function getPaginaById($idpagina){
 		$query = 'SELECT p.ID,m.NOME AS MODULO, s.NOME AS SEZIONE, p.NOME, p.FILE 
 					FROM Pagine AS p
 						JOIN Sezioni AS s ON (p.ID_SEZIONE=s.ID) 
 						JOIN Moduli AS m ON (s.ID_MODULO=m.ID)
 					WHERE p.ID="'.$idpagina.'"';
    	if(!$this->cnn->executeQuery($query))
	 		return false;
		else
	 		return $this->cnn->fetchAll();
	}
	
 	function deletePagina($id){
 		$query = 'DELETE FROM Pagine WHERE ID="'.$id.'"';
    	if(!$this->cnn->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	}
	
   function modifyPagina($valori)
   {
    $errori = array();
    $query = 'UPDATE Pagine SET NOME="'.addslashes($valori['nome']).'",
								FILE="'.addslashes($valori['file']).'"
    					WHERE ID="'.$valori['id'].'"';
    if(!$this->cnn->executeQuery($query))
	 $errori['modifica'] = 1;

	 return $errori;
   }	
	
	
}