<?php

class Lavori{

  private $cnn;
   
  function Lavori()
   {
    $cnn = new Connection();
   }
  
   
 	function addMarca($valori){
 		$permalink = Helper::permalink($valori['nome'],"dash",true);
 		$query = 'INSERT INTO Marca (nome,descrizione,abilitato,link,permalink) VALUES
					("'.addslashes($valori['nome']).'",
					 "'.addslashes($valori['descrizione']).'",
					 "'.$valori['abilitato'].'",
					 "'.$valori['link'].'",
					 "'.$permalink.'")';
    	if(!$this->executeQuery($query))
	 		return 0;
	 	else
	 		return 1;
 	}
   
	function getMarca($abilitato){
		if ($abilitato)
 			$query = 'SELECT * FROM Marca WHERE abilitato="'.$abilitato.'" ORDER BY nome ASC';
 		else
 			$query = 'SELECT * FROM Marca ORDER BY nome ASC';
 		    	if(!$this->executeQuery($query))
	 		return false;
		else
	 		return $this->fetchAll();
	}

	function getMarcaById($id){
 		$query = 'SELECT * FROM Marca WHERE ID="'.$id.'" ';
 		if(!$this->executeQuery($query))
	 		return false;
		else
	 		return $this->fetchAll();
	}

	function deleteMarca($id){
 		$query = 'DELETE FROM Marca WHERE ID="'.$id.'" ';
 		if(!$this->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	}

 	function modifyMarca($valori){
 		$permalink = Helper::permalink($valori['nome'],"dash",true);
 		$query = 'UPDATE Marca SET 
 						nome = "'.addslashes($valori['nome']).'",
 						descrizione = "'.addslashes($valori['descrizione']).'",
 						abilitato = "'.$valori['abilitato'].'",
 						link = "'.$valori['link'].'",
 						permalink = "'.$permalink.'"
						WHERE ID="'.$valori['id'].'"';
    	if(!$this->executeQuery($query))
	 		return 0;
	 	else
	 		return 1;
 	}

 	function addProdotto($valori,$valoriF){
 		global $HP;
 		$permalink = Helper::permalink($valori['nome'],"dash",true);
 		$ordine = $valori['ordine']?$valori['ordine']:0 ;
 		$query = 'INSERT INTO Prodotto (categoryID, marcaID, nome, sottotitolo,descrizione, prezzo, offerta, ordine, abilitato, inHome,vendita,permalink) VALUES(
 										"'.$valori['categoria'].'",
 										"'.$valori['marca'].'",
 										"'.addslashes($valori['nome']).'",
 										"'.addslashes($valori['sottotitolo']).'",
 										"'.addslashes($valori['descrizione']).'",
 										"'.str_replace(",",".",$valori['prezzo']).'",
 										"'.str_replace(",",".",$valori['offerta']).'",
 										"'.$ordine.'",
 										"'.$valori['abilitato'].'",
 										"'.$valori['home'].'",
 										"'.$valori['vendita'].'",
 										"'.$permalink.'")';
    	if(!$this->executeQuery($query))
	 		$errori['inserimento dati'] = "Errore ins dati";
	 	
	 	$prodottoID = $this->myPdo->lastInsertId();
    	$dir = "../prodotti/".$prodottoID;
    	mkdir($dir, 0777);
		
	 	if($valoriF['immagine']['name']){ 
    		$HP->Upload($dir, $valoriF['immagine']['name'], $valoriF['immagine']['tmp_name'],1);
	    	$query = "UPDATE Prodotto SET immagine='".$valoriF['immagine']['name']."' WHERE ID='".$prodottoID."'";
    		if(!$this->executeQuery($query))
	        	$errori['upload_immagine'] = "Errore aggiornamento immagine";
		}     	
		if ($errori)	
			return $errori;
		else
			return $prodottoID; 		
 	}
 	
	function getProdottoFromCategoryID($categoryID, $abilitato = ""){
		if ($abilitato)
 			$query = 'SELECT p.*, m.nome AS nomeMarca 
 						FROM Prodotto AS p
							LEFT JOIN Marca AS m ON (p.marcaID=m.ID)
 					  WHERE categoryID="'.$categoryID.'" AND p.abilitato="'.$abilitato.'" ORDER BY nomeMarca ASC';
 		else
 			$query = 'SELECT p.*, m.nome AS nomeMarca 
 						FROM Prodotto AS p
							LEFT JOIN Marca AS m ON (p.marcaID=m.ID)
 					  WHERE categoryID="'.$categoryID.'" ORDER BY nomeMarca ASC';
 		if(!$this->executeQuery($query))
	 		return false;
		else
	 		return $this->fetchAll();
	} 	
 	
	/*
	  preleva prodotti per categoria
	  categoryID [int]: categoria di appartenenza
	  offset [int]: da dove partire a prelevare
	  numRow [int]: numero di righe da prelevare
	  abilitato [0/1]: abilitato oppure no	 
	 */
	function getProdottiFromCategoryIDSite($categoryID, $offset, $numRow, $abilitato = ""){
		if ($abilitato == 1)
			$query = 'SELECT COUNT(ID) AS num FROM Prodotto WHERE categoryID="'.$categoryID.'" AND abilitato=1';
    	else
    		$query = 'SELECT COUNT(ID) AS num FROM Prodotto WHERE categoryID="'.$categoryID.'"';
		
    	if(!$this->executeQuery($query))
	 		return false;
		else
	 		$appo = $this->fetchAll();
	 	$dati['num'] = $appo[0]['num'];

	 	if($numRow > 0)
	 	{
	  		$limit = "LIMIT ".$offset.", ".$numRow;
	 	}		
	 	
	 	if ($abilitato == 1)
	 		$query = 'SELECT * FROM Prodotto WHERE categoryID="'.$categoryID.'" AND abilitato=1 ORDER BY nome '.$limit;
	 	else
	 		$query = 'SELECT * FROM Prodotto WHERE categoryID="'.$categoryID.'" ORDER BY nome '.$limit;

	 	if(!$this->executeQuery($query))
	 		return false;
		else
	 		$dati['risultati'] = $this->fetchAll();
	
	 	return $dati;	
	} 	

	/*
	  preleva prodotti per categoria per la pagina principale dei risultati
	  categoryID [int]: categoria padre di appartenenza
	  numRow [int]: numero di righe da prelevare
	  abilitato [0/1]: abilitato oppure no	 
	 */
	function getProdottiFromCategoryIDRand($categoryID, $numRow, $abilitato = ""){
		if ($abilitato == 1)
			$query = 'SELECT p.*  
						FROM Prodotto AS p 
							JOIN Categorie AS c ON (p.categoryID=c.ID AND c.parentID='.$categoryID.')  
							WHERE p.abilitato=1 ORDER BY RAND() LIMIT '.$numRow;
    	else
			$query = 'SELECT p.*  
						FROM Prodotto AS p 
							JOIN Categorie AS c ON (p.categoryID=c.ID AND c.parentID='.$categoryID.')  
							ORDER BY RAND() LIMIT '.$numRow;
		if(!$this->executeQuery($query))
	 		return false;
		else
	 		return $this->fetchAll();
		
	} 	
	
	
 	function deleteProdotto($id){
 		$query = 'DELETE FROM Prodotto_magazzino WHERE prodottoID="'.$id.'"';
    	$this->executeQuery($query);
 		$query = 'DELETE FROM Prodotto WHERE ID="'.$id.'"';
 		if(!$this->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	} 	
	
	function getProdottoById($id){
 		$query = 'SELECT * FROM Prodotto WHERE ID="'.$id.'"';
    	if(!$this->executeQuery($query))
	 		return false;
		else
	 		return $this->fetchAll();
	}	
	
   function modifyProdotto($valori,$valoriF)
   {
   	global $HP;
   	$permalink = Helper::permalink($valori['nome'],"dash",true);
    $errori = array();
    $prodottoID = $valori['id'];
    $query = 'UPDATE Prodotto SET 
    			categoryID="'.$valori['categoria'].'", 
    			marcaID="'.$valori['marca'].'",
    			nome="'.addslashes($valori['nome']).'",
    			sottotitolo="'.addslashes($valori['sottotitolo']).'", 
    			descrizione="'.addslashes($valori['descrizione']).'",
    			prezzo="'.str_replace(",",".",$valori['prezzo']).'",
    			offerta="'.str_replace(",",".",$valori['offerta']).'",
    			permalink="'.$permalink.'",
    			inHome="'.$valori['home'].'",
    			vendita="'.$valori['vendita'].'",
    			ordine="'.$valori['ordine'].'",
    			abilitato="'.$valori['abilitato'].'"
    			WHERE ID="'.$prodottoID.'"';
    if(!$this->executeQuery($query))
	 $errori['dati'] = 1;
	
	
	 
	if( ($valoriF['immagine']['name']) && ($valoriF['immagine']['name'] != "")){ 
		$dir = "../prodotti/".$prodottoID;
    	$HP->Upload($dir, $valoriF['immagine']['name'], $valoriF['immagine']['tmp_name'],1);
	    $query = "UPDATE Prodotto SET immagine='".$valoriF['immagine']['name']."' WHERE ID='".$prodottoID."'";
	    if(!$this->executeQuery($query)) 
	    	$array['upload_immagine'] = "Errore aggiornamento immagine";
	}  

	return $errori;
   }	

 	function addOfferta($valori,$valoriF){
 		global $HP;
 		$query = 'INSERT INTO Offerte (categoryID, titolo, sottotitolo, attivazione, scadenza, descrizione, prezzo, offerta, abilitato) VALUES(
 										"'.$valori['categoria'].'",
 										"'.addslashes($valori['titolo']).'",
 										"'.addslashes($valori['sottotitolo']).'",
 										"'.$HP->data_sql($valori['inizio']).'",
 										"'.$HP->data_sql($valori['fine']).'",
 										"'.addslashes($valori['descrizione']).'",
 										"'.str_replace(",",".",$valori['prezzo']).'",
 										"'.str_replace(",",".",$valori['offerta']).'",
 										"'.$valori['abilitato'].'")';
    	if(!$this->executeQuery($query))
	 		$errori['inserimento dati'] = "Errore ins dati";
	 	
	 	//$HP->printR($this->getErrors());
	 	
	 	$offertaID = $this->myPdo->lastInsertId();
    	$dir = "../offerte/".$offertaID;
    	mkdir($dir, 0777);
		
	 	if($valoriF['immagine']['name']){ 
    		$HP->Upload($dir, $valoriF['immagine']['name'], $valoriF['immagine']['tmp_name'],1);
	    	$query = "UPDATE Offerte SET immagine='".$valoriF['immagine']['name']."' WHERE ID='".$offertaID."'";
    		if(!$this->executeQuery($query))
	        	$errori['upload_immagine'] = "Errore aggiornamento immagine";
		}     	

		return $offertaID; 		
 	}
 	
	function getOffertaByID($offertaID){
		$dati = array();
 		$query = 'SELECT * FROM Offerte WHERE ID="'.$offertaID.'"';
    	if(!$this->executeQuery($query))
	 		return false;
		else
			$appo = $this->fetchAll();
	 		$dati['offerta'] = $appo[0];
	 	
	 	return $dati;
	} 	
   
 	function addProdottoOfferta($valori){
 		$query = 'INSERT INTO Offerte_prodotti (offertaID, prodottoID, qta) VALUES(
 										"'.$valori['offerta'].'",
 										"'.$valori['prodotto'].'",
 										"'.$valori['quantita'].'")';
    	if(!$this->executeQuery($query))
	 		return 0;
	 	else
	 		return 1;
 	}

	function getProdottoFromOffertaID($offertaID){
 		$query = 'SELECT p.*, m.nome AS nomeMARCA, op.qta AS qta, op.ID AS idPrd 
 					FROM Offerte_prodotti AS op
 					JOIN Prodotto AS p ON (op.prodottoID=p.ID)
 					JOIN Marca AS m ON (m.ID=p.marcaID) 
 					WHERE op.offertaID="'.$offertaID.'" ORDER BY nomeMARCA ASC';
    	if(!$this->executeQuery($query))
	 		return false;
		else
			return $this->fetchAll();
	} 	

 	function deletePrdOfferta($id){
 		$query = 'DELETE FROM Offerte_prodotti WHERE ID="'.$id.'"';
    	if(!$this->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	} 	

	function getOffertaFromCategoryID($categoriaID,$abilitato){
 			if ($abilitato)
 			$query = 'SELECT * FROM Offerte WHERE categoryID="'.$categoriaID.'" AND abilitato="'.$abilitato.'" ORDER BY titolo ASC';
 		else
 			$query = 'SELECT * FROM Offerte WHERE categoryID="'.$categoriaID.'" ORDER BY titolo ASC';
    	if(!$this->executeQuery($query))
	 		return false;
		else
			return $this->fetchAll();
	} 

   function modifyOfferta($valori,$valoriF)
   {
   	global $HP;
    $errori = array();
    $offertaID = $valori['id'];
    $query = 'UPDATE Offerte SET 
    			categoryID="'.$valori['categoria'].'", 
    			titolo="'.addslashes($valori['titolo']).'",
    			sottotitolo="'.addslashes($valori['sottotitolo']).'",
    			attivazione="'.$HP->data_sql($valori['inizio']).'", 
    			scadenza="'.$HP->data_sql($valori['fine']).'",
    			descrizione="'.addslashes($valori['descrizione']).'",
    			prezzo="'.str_replace(",",".",$valori['prezzo']).'",
    			offerta="'.str_replace(",",".",$valori['offerta']).'",
    			abilitato="'.$valori['abilitato'].'"
    			WHERE ID="'.$offertaID.'"';
    if(!$this->executeQuery($query))
	 $errori['dati'] = 1;
	
	
	 
	if( ($valoriF['immagine']['name']) && ($valoriF['immagine']['name'] != "")){ 
		$dir = "../offerte/".$offertaID;
    	$HP->Upload($dir, $valoriF['immagine']['name'], $valoriF['immagine']['tmp_name'],1);
	    $query = "UPDATE Offerte SET immagine='".$valoriF['immagine']['name']."' WHERE ID='".$offertaID."'";
	    if(!$this->executeQuery($query)) 
	    	$array['upload_immagine'] = "Errore aggiornamento immagine";
	}  

	return $offertaID;
   }

	function getProdottoFromOfferta($prodottoID){
		$query = 'SELECT f.ID, f.titolo
					FROM Offerte AS f
					JOIN Offerte_prodotti AS op ON (op.offertaID=f.ID) 
						WHERE (f.attivazione >= DATE_SUB(CURDATE(),INTERVAL 5 DAY)) AND (f.scadenza >= CURDATE()) AND op.prodottoID="'.$prodottoID.'" 
						ORDER BY f.titolo';
		//echo $query;
	 	if(!$this->executeQuery($query))
	 		return false;
		else
	 		return $this->fetchAll();
	}

	
	function getTaglie(){
		$query = 'SELECT * FROM Taglie ORDER BY ID ASC';
    	if(!$this->executeQuery($query))
	 		return false;
		else
			return $this->fetchAll();
	} 	
	
	function getListMagazzino($productID){
		$query = 'SELECT pm.*, t.nome AS taglia 
				  FROM Prodotto_magazzino as pm 
				  JOIN Taglie AS t ON (t.ID=pm.tagliaID)
				  WHERE pm.prodottoID='.$productID.'
				  ORDER BY pm.ID ASC';
    	//echo $query;
		if(!$this->executeQuery($query))
	 		return false;
		else
			return $this->fetchAll();
	} 	
	
 	function addMagazzino($valori){
 		$query = 'INSERT INTO Prodotto_magazzino (prodottoID,tagliaID,colore,qta) VALUES
					("'.$valori['prodotto'].'",
					 "'.$valori['taglia'].'",
					 "'.addslashes($valori['colore']).'",
					 "'.$valori['qta'].'")';
    	if(!$this->executeQuery($query))
	 		return 0;
	 	else
	 		return 1;
 	}
 	
	function getMagazzinoById($magazzinoID){
 		$query = 'SELECT * FROM Prodotto_magazzino WHERE ID="'.$magazzinoID.'"';
    	//echo $query;
 		if(!$this->executeQuery($query))
	 		return false;
		else
			return $this->fetchAll();
	}  	
	
 	function deleteMagazzino($id){
 		$query = 'DELETE FROM Prodotto_magazzino WHERE ID="'.$id.'"';
    	if(!$this->executeQuery($query))
	 		return 0;
		else
	 		return 1;
	} 		
 	
	function modifyMagazzino($valori){
 		$permalink = Helper::permalink($valori['nome'],"dash",true);
 		$query = 'UPDATE Prodotto_magazzino SET 
 						tagliaID = "'.$valori['taglia'].'",
 						colore = "'.addslashes($valori['colore']).'",
 						qta = "'.$valori['qta'].'"
						WHERE ID="'.$valori['id'].'"';
    	if(!$this->executeQuery($query))
	 		return 0;
	 	else
	 		return 1;
 	}	
 	
	function getProductSite($filtri, $offset, $numRow, $order){
		$query = 'SELECT COUNT(p.ID) AS num 
					FROM Prodotto AS p
					JOIN Categorie AS c ON (c.ID=p.categoryID)
					WHERE '.implode(" AND ",$filtri);
		//echo $query."<br /><br />";
    	if(!$this->executeQuery($query))
	 		return false;
		else
	 		$appo = $this->fetchAll();
	 		$dati['num'] = $appo[0]['num'];

	 	if($numRow > 0)
	 	{
	  		$limit = "LIMIT ".$offset.", ".$numRow;
	 	}		
	 	
	 	$query = 'SELECT p.*, c.permalink AS categoria
	 				FROM Prodotto AS p
	 				JOIN Categorie AS c ON (c.ID=p.categoryID)
	 				WHERE '.implode(" AND ",$filtri).' '.$order.' '.$limit;
	 	//echo $query;
	 	if(!$this->executeQuery($query))
	 		return false;
		else
	 		$dati['risultati'] = $this->fetchAll();
	
	 	return $dati;	
	}


	function sendInfo($valori){
                $datiProdotto = $this->getProdottoById($valori['oggettoID']);
		global $SETTING;
		$mail = new PHPMailer();
		$mail->From = "info@myteacup.it";
		$mail->FromName = "MyTeaCup.it";
		$mail->Subject = "Richiesta di Acquisto :: MyTeaCup";
		//$mail->Body = "Testo del messaggio";
		$body = $mail->getFile("mail/richiestaAcquisto.php");
                $body = eregi_replace("[\]",'',$body);
                $body = eregi_replace("{prodotto}",stripslashes($datiProdotto[0]['nome']),$body);
		$body = eregi_replace("{nome}",stripslashes($valori['nome']),$body);
		$body = eregi_replace("{email}",stripslashes($valori['email']),$body);
                $body = eregi_replace("{informazione}",stripslashes($valori['info']),$body);
  		$mail->Body = $body;
		//$mail->AddAddress($utente[0]['EMAIL']);
		$mail->AddAddress($SETTING->emailSys, $SETTING->emailSys);
		if($mail->Send()){
                    $result['result']=true;
		} else{
                    $result['result']=false;
                    $result['errors'][]='Invio FALLITO';
                    $result['errors'][]=$mail->ErrorInfo;
		}
		$mail->ClearAddresses();
		$mail->AddAddress($SETTING->emailWebmaster, $SETTING->emailWebmaster);
  		$mail->Send();
  		return $result;
        }
        
	function getTaglieFromProdottoID($prodottoID){
 		$query = 'SELECT t.ID, t.nome  
 					 FROM Prodotto_magazzino as pm
 					 JOIN Taglie AS t ON (pm.tagliaID=t.ID)
 					 WHERE prodottoID="'.$prodottoID.'" GROUP BY t.ID ORDER BY t.ordine';
    	//echo $query;
 		if(!$this->executeQuery($query))
	 		return false;
		else
			return $this->fetchAll();
	} 
	
	function getColoriFromTagliaID($prodottoID,$tagliaID){
 		$query = 'SELECT ID,colore FROM Prodotto_magazzino WHERE prodottoID="'.$prodottoID.'" AND tagliaID="'.$tagliaID.'" ORDER BY colore';
    	//echo $query;
 		if(!$this->executeQuery($query))
	 		return false;
		else
			return $this->fetchAll();
	} 
	
 	function addOrdine($valori){
 		$query = 'INSERT INTO Ordine (userID, data, time, trasporto, totale, nome, cognome, indirizzo, citta, provincia, note, statoID, pagamento) VALUES
					("'.$_SESSION['userID'].'",
					 "'.date("Y-m-d").'",
					 "'.date("H:m:s").'",
					 "'.$valori['trasporto'].'",
					 "'.$valori['totale'].'",
					 "'.addslashes($valori['nome']).'",
					 "'.addslashes($valori['cognome']).'",
					 "'.addslashes($valori['indirizzo']).'",
					 "'.addslashes($valori['citta']).'",
					 "'.addslashes($valori['provincia']).'",
					 "'.addslashes($valori['note']).'", "1",
					 "'.$valori['pagamento'].'")';
    	if(!$this->executeQuery($query))
	 		$errori['inserimento'] = "errori";
	 		
		$prodottoID = $this->myPdo->lastInsertId();
		if ($prodottoID)
			return $prodottoID;
		else
			return $errori;
		
 	}

 	function addProdottiOrdine($ordineID, $valori){
 		foreach($valori AS $key=>&$item){
			$magazzinoPRD = $this->getMagazzinoById($key);
			$prodotto = $this->getProdottoById($magazzinoPRD[0]['prodottoID']);
			$prezzoPRD = ($prodotto[0]['offerta']>0)?$prodotto[0]['offerta'] : $prodotto[0]['prezzo'];
			$qta = $item;
			$costo = ($prezzoPRD * $qta);
			$totale = $totale + $costo; 
 			
			$query = 'INSERT INTO Ordine_prodotti (ordineID, prodottoID, qta, price) VALUES
					("'.$ordineID.'",
					 "'.$magazzinoPRD[0]['prodottoID'].'",
					 "'.$qta.'",
					 "'.$prezzoPRD.'")';
    		if(!$this->executeQuery($query))
	 			$errori['inserimento'] = $magazzinoPRD[0]['prodottoID'];
 		}	
		if(count($errori)<1)
			return 1;
		else
			return $errori;	
 	}

	function getOrdineByID($ordineID){
 		$query = 'SELECT * FROM Ordine WHERE ID="'.$ordineID.'"';
 		if(!$this->executeQuery($query))
	 		return false;
		else
			return $this->fetchAll();
	}  	

	function getProdottiByOrdineID($ordineID){
 		$query = 'SELECT * FROM Ordine_prodotti WHERE ordineID="'.$ordineID.'"';
 		if(!$this->executeQuery($query))
	 		return false;
		else
			return $this->fetchAll();
	}  	
	
	
	function inviaMailOrdine($ordineID){
		global $SETTING,$UC,$HP;
		$ordine = $this->getOrdineByID($ordineID);
		$ordinePRD = $this->getProdottiByOrdineID($ordineID);
		$utente = $UC->getUserById($ordine[0]['userID']);
		$mail = new PHPMailer();
		$mail->From = "info@myteacup.it";
		$mail->FromName = "MyTeaCup.it";
		$mail->Subject = "Ordine di acquisto :: MyTeaCup";
		//$mail->Body = "Testo del messaggio";
		$body = $mail->getFile("mail/ordine.php");
		
		$body = eregi_replace("[\]",'',$body);
        $body = eregi_replace("{ordine}",$ordine[0]['ID'],$body);
        $body = eregi_replace("{utente}",stripslashes($utente[0]['NOME']). " ".stripslashes($utente[0]['COGNOME']),$body);
		$body = eregi_replace("{ora}",$ordine[0]['time'],$body);
		$body = eregi_replace("{data}",$HP->data_it($ordine[0]['data']),$body);
        
		$cliCGN = $ordine[0]['cognome'] ? stripslashes($ordine[0]['cognome']) : stripslashes($utente[0]['COGNOME']);
		$nmCGN = $ordine[0]['nome'] ? stripslashes($ordine[0]['nome']) : stripslashes($utente[0]['NOME']); 
		$cliente = $cliCGN. " ".$nmCGN; 
		$indirizzo = $ordine[0]['indirizzo'] ? stripslashes($ordine[0]['indirizzo']) : stripslashes($utente[0]['INDIRIZZO']);
		$citta = $ordine[0]['citta'] ? stripslashes($ordine[0]['citta']) : stripslashes($utente[0]['CITTA']);
		$provincia = $ordine[0]['provincia'] ? stripslashes($ordine[0]['provincia']) : stripslashes($utente[0]['PROVINCIA']);
		$pagamento = ($ordine[0]['pagamento'] == 1) ? "Carta di Credito" : "Bonifico Bancario";
		
		
		$body = eregi_replace("{cliente}", $cliente,$body);
		$body = eregi_replace("{indirizzo}", $indirizzo,$body);
		$body = eregi_replace("{citta}", $citta,$body);
		$body = eregi_replace("{provincia}", $provincia,$body);
		$body = eregi_replace("{note}", stripslashes($ordine[0]['note']),$body);
		
		if ($ordinePRD){
  			foreach($ordinePRD AS $item){
  				$prd = $this->getProdottoById($item['prodottoID']);
  				$prdMAIL .= stripslashes($prd[0]['nome'])." [qta: ".$item['qta']."] ".str_replace(".",",",$item['price'])."<br />";
  			}	  			
  		}else{
  			$prdMAIL = "";
  		}
		$body = eregi_replace("{prodotti}",$prdMAIL,$body);
		$body = eregi_replace("{pagamento}",$pagamento,$body);
		$body = eregi_replace("{trasporto}",str_replace(".",",",$ordine[0]['trasporto']),$body);
		$body = eregi_replace("{totale}",str_replace(".",",",$ordine[0]['totale']),$body);
		$mail->Body = $body;
		$mail->AddAddress($SETTING->emailSys, $SETTING->emailSys);
		if($mail->Send()){
                    $result['result']=true;
		} else{
                    $result['result']=false;
                    $result['errors'][]='Invio FALLITO';
                    $result['errors'][]=$mail->ErrorInfo;
		}
		$mail->ClearAddresses();
		$mail->AddAddress($SETTING->emailWebmaster, $SETTING->emailWebmaster);
  		$mail->Send();
		$mail->ClearAddresses();
		$mail->AddAddress($utente[0]['EMAIL'], $utente[0]['EMAIL']);
  		$mail->Send();
  		return $result;
        }

 	
}// end class