<?php
ini_set('session.cache_limiter', 'private');
//session_start($session_name);

include("class/class.phpmailer.php");

$emails = array(
  'giuliomario@groupon.com',
  'viviana.tanzarella@groupon.it',
  'elisa.andali@groupon.it',
  'donato.dileo@groupon.it',  
  'diego.lettieri@groupon.it',
  'nicolo.clementi@groupon.it',  
  'mattia.fantin@groupon.it',  
  'miriam.loiacono@movingcenter.info',
  'flaviano.margiotta@movingcenter.info',
  'fabio.manzulli@movingcenter.info',
  'giuseppe.ferrari@movingcenter.info',
  'info@iguarantee.it',
  'mb@larancia.eu',  
  'nc@larancia.eu',  
  'gl@larancia.eu',  
  'mf@larancia.eu',    
  'alessandro@quarantastudio.com',    
  'amacchia@notariato.it',
  'alessandro@quarantastudio.com',       
  'dott.giovanni@studiogaleandro.it',
  'alberto@melica.it',
  'grupposaigisrl@hotmail.com',
  'mauro.carrieri@carrieri.it',
  'roberto.carrieri@carrieri.it',
  'direzione@rondohotel.it',
  'congressi@rondohotel.it'  
);


            //Helpers::printR($ticket);
            //echo $dipID;
            //$valori = $this->getDipendenteById($dipID);
            $mail = new PHPMailer();
            $mail->From = "info@i-factory.biz";
            $mail->FromName = 'I-factory';
            
            $mail->Subject = "I-factory vi augura un sereno Natale";
            
            //$pathfile="../cessazione_pdf/".$valori['pdfcess'];
            
            
            // BODY MAIL
            //$azienda = $this->getAziendaByDipendenteID($dipID);
            
            
            $body = $mail->getFile("nl/auguri.html");
            //$body = eregi_replace("[\]",'',$body);
            //$body = eregi_replace("{NOME}",$valori['nome'],$body);
            //$body = eregi_replace("{COGNOME}",$valori['cognome'],$body);
            //$body = eregi_replace("{AZIENDA}",$azienda[0]['NOME'],$body);
            
            /*$body = eregi_replace("{NASCITA}",Helpers::data_it($valori['data_nascita']),$body);
            $body = eregi_replace("{TELEFONO}",$valori['telefono'],$body);
            $body = eregi_replace("{CELLULARE}",$valori['cellulare'],$body);
            $body = eregi_replace("{FAX}",$valori['fax'],$body);
            $body = eregi_replace("{RAGIONESOCIALE}",$valori['ragionesociale'],$body);
            $body = eregi_replace("{CF}",$valori['cf'],$body);
            $body = eregi_replace("{IVA}",$valori['piva'],$body);
            $body = eregi_replace("{INDIRIZZO}",$valori['indirizzo'],$body);
            $body = eregi_replace("{COMUNE}",$valori['comuneNome'],$body);
            $body = eregi_replace("{CAP}",$valori['cap'],$body);
            $body = eregi_replace("{EMAIL}",$valori['email'],$body);
            $body = eregi_replace("{PSW}",$valori['password'],$body);
            $body = eregi_replace("{NEWSLETTER}",($valori['newsletter']) ? 'SI': 'NO',$body);
            */
            $mail->Body = $body;
            
            //echo $mail->Body;
            foreach($emails AS &$email){
                $mail->AddAddress($email, $email);//$valori['EMAIL']
                $mail->Send();
                $mail->ClearAllRecipients();
            }   
            //$mail->AddCC("power-network@pec.it","power-network@pec.it");
            
            //$this->printR($mail);
            
           

    

