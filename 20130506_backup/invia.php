<?
 $a="postmaster@i-factory.biz";
 $oggetto="I-Factory.biz :: Richiesta da sito web";
 $messaggio = "<HTML><HEAD><TITLE>Richiesta dal sito web</TITLE></HEAD><BODY>";
 $messaggio .= "I-factory.biz";
 $messaggio .= "<P>Cognome Nome: <b>".$_POST['cognome']."</b>";
 $messaggio .= "<P>Indirizzo: <b>".$_POST['indirizzo']."</b>";
 $messaggio .= "<P>Citta: <b>".$_POST['citta']."</b>";
 $messaggio .= "<P>E-mail: <b>".$_POST['email']."</b>";
 $messaggio .= "<P>Telefono: <b>".$_POST['telefono']."</b>";
 $messaggio .= "<P>Dominio: <b>".$_POST['website']."</b>";
 $messaggio .= "<P>Informazioni: <b>".$_POST['messaggio']."</b>";
 $messaggio .= "<P>Consenso: <b>".$_POST['consenso']."</b>";
 $messaggio .= "<P>Distinti saluti";
 $intestazioni= "From:info@i-factory.biz\r\n";
 $intestazioni .= "Reply-To:postmaster@i-factory.biz\r\n";
 $intestazioni .= "MIME-Version: 1.0\n";
 $intestazioni .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
 $intestazioni .= "Content-Transfer-Encoding: 7bit\n\n";
 mail($a, $oggetto, $messaggio, $intestazioni);
 header("location: contatti.php?ctr=1");

?>