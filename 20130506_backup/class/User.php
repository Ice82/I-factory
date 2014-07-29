<?php
include_once('class.phpmailer.php');

class User{


function __construct()
  {


    
  }
  
   
	function sendMailUtitly($valori){
		$mail = new PHPMailer(); 
		$mail->From = $valori['send_mail'];
		$mail->FromName = $valori['send_name'];
		$mail->Subject = $valori['send_subject'];
		//$mail->Body = "Testo del messaggio"; 
		$body = $mail->getFile("mail/mail.php");
		$body = eregi_replace("[\]",'',$body);
                $body = eregi_replace("{titolo}",$valori['titolo'],$body);
		$body = eregi_replace("{testo}",$valori['testo'],$body);
        	$mail->Body = $body;
                /*echo "<pre>";
                print_r($mail->Body);
                echo "</pre>";*/
		$mail->AddAddress($valori['send_mailTO']);
		if($mail->Send()){ 
                    $result['result']=true;
		} else{
			$result['result']=false;
			$result['errors'][]='Invio FALLITO';
			$result['errors'][]=$mail->ErrorInfo; 
		}
		$mail->ClearAddresses();
		$mail->AddAddress("postmaster@i-factory.biz", "postmaster@i-factory.biz");
  		$mail->Send();
  		$mail->ClearAddresses();
  		return $result;
	}

	
	
} //classe end