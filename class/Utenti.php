<?php

class Utenti {

private $folder = "utenti";

 public $createFolder = false; // se creare cartella in $folder
 public $createFolderType = 0; // se creare cartella in $folder
 public $uploadIMG = false;
 public $passwordMD5 = false;
 
 private $_set = "";
 private $_db = "";


    function __construct(){
        //$this->_db = new UtentiDB();
        $this->_set = new Settings();

    }
    
    function Insert($value){
        unset($value['pulsante']);
        $CM = new Comune();
        $comune = $CM->ItemByID($value['comuneID']);
        $provinciaID = $comune['provinciaID'];
        $regioneID = $comune['regioneID']; 
        $password = ($this->passwordMD5) ? md5($value['password']) : $value['password'];

        
        $field = array(
          'cognome' => addslashes($value['cognome']),  
          'nome' => addslashes($value['nome']),  
          'ragionesociale' => addslashes($value['ragionesociale']),  
          'indirizzo' => addslashes($value['indirizzo']),  
          'regioneID' => $regioneID,  
          'provinciaID' => $provinciaID,  
          'comuneID' => $comune['ID'],  
          'cap' => $value['cap'],  
          'latitudine' => $value['latitudine'],  
          'longitudine' => $value['longitudine'],  
          'data_nascita' => ($value['data_nascita']) ? Helpers::data_sql($value['data_nascita']) : '0000-00-00',  
          'telefono' => $value['telefono'],  
          'fax' => $value['fax'],  
          'cellulare' => $value['cellulare'],  
          'telefono_1' => $value['telefono_1'],  
          'sitoweb' => $value['sitoweb'],  
          'piva' => $value['piva'],  
          'cf' => $value['cf'],  
          'newsletter' => ($value['newsletter']) ? $value['newsletter'] : 0,  
          'email' => $value['email'],  
          'password' => $password,  
          'abilitato' => $value['abilitato'],  
          'type' => $value['type'],  
          'registrazione' => date("Y-m-d"),  
        );
        
        foreach($field as $key => $value){
            $fields[] = "`$key`";
            $values[] = "'".$value."'";
        }
        //Helpers::PrintR($fields);
        //Helpers::PrintR($values);
        if( (!$fields) || (!$values))
            return false;

        $insert = $this->_db->_Insert($fields, $values);

        return $insert;
    }    

    function autorizza($user,$password){
        $user = str_replace("'","",trim($user));
        $password = str_replace("'","",trim($password));
        
        if($this->passwordMD5){
                $password = md5($password);
        }
        
        $userID = $this->_db->_autorizza($user, $password);
        
        //exit();
        if(!$userID)
            return false;

        $user = $this->ItemByID($userID[0]['ID']);
        
        if(!$user)
            return false;

        $_SESSION['user']['ID'] = $user['ID'];
        $_SESSION['user']['fullname'] = $user['fullname'];
        $_SESSION['user']['type'] = $user['type'];
        $_SESSION['user']['tipologia'] = $user['typeNome'];
        $_SESSION['IsUserGood'] = true;

        return true;

    }
    
    function ItemByID($ID){
        $utente = $this->_db->_ItemByID($ID);
        if(!$utente)
            return false;

        $utente = $utente[0];

        return $utente;
    }
    
    function Update($value){
        $id = $value['id'];
        unset($value['id']);
        
        $CM = new Comune();
        $comune = $CM->ItemByID($value['comuneID']);
        $provinciaID = $comune['provinciaID'];
        $regioneID = $comune['regioneID']; 
        $password = ($this->passwordMD5) ? md5($value['password']) : $value['password'];
        
        
        $field = array(
          'cognome' => addslashes($value['cognome']),  
          'nome' => addslashes($value['nome']),  
          'ragionesociale' => addslashes($value['ragionesociale']),  
          'indirizzo' => addslashes($value['indirizzo']),  
          'regioneID' => $regioneID,  
          'provinciaID' => $provinciaID,  
          'comuneID' => $comune['ID'],  
          'cap' => $value['cap'],  
          'latitudine' => $value['latitudine'],  
          'longitudine' => $value['longitudine'],  
          'data_nascita' => ($value['data_nascita']) ? Helpers::data_sql($value['data_nascita']) : '0000-00-00',  
          'telefono' => $value['telefono'],  
          'fax' => $value['fax'],  
          'cellulare' => $value['cellulare'],  
          'telefono_1' => $value['telefono_1'],  
          'sitoweb' => $value['sitoweb'],  
          'piva' => $value['piva'],  
          'cf' => $value['cf'],  
          'newsletter' => ($value['newsletter']) ? $value['newsletter'] : 0,  
          'email' => $value['email'],  
          'password' => $password,  
          'abilitato' => $value['abilitato'],  
          'type' => $value['type'],  
          'registrazione' => date("Y-m-d"),  
        );
     
        foreach($field as $key => $value){
            $fields[] = "`$key` = '".$value."'";
        }
        //Helpers::printR($fields);
        if(!$fields)
            return false;

        $update = $this->_db->_Update($fields,$id);

        return $update;
    }    

    function GetList($type, $abilitato = false){
        $list = $this->_db->_GetList($type, $abilitato);
        if(!$list)
            return false;

        return $list;
    }

    function Search($filter){
        $list = $this->_db->_Search($filter);
        if(!$list)
            return false;

        return $list;
    }    
    
    function sendMailCustomer($valori, $ticketID = null){
            //Helpers::printR($ticket);
            $mail = new PHPMailer();
            $mail->From = "info@musiccostone.com";
            $mail->FromName = $this->_set->nome_dominio;
            $mail->Subject = "Richiesta dal web";
            // BODY MAIL
            $body = 'Dati <br />
                    Nominativo: '.$valori['nominativo'].'<br />
                    Telefono: '.$valori['telefono'].'<br />
                    Azienda: '.$valori['azienda'].'<br />
                    E-mail: '.$valori['email'].'<br />
                    Messaggio: '.$valori['messaggio'].'<br />
                    ';
            $mail->Body = $body;
            //echo $mail->Body;
            $mail->AddAddress("info@i-factory.biz", "info@i-factory.biz");
            if($mail->Send()){
                $result['result']=true;
            } else{
                    $result['result']=false;
                    $result['errors'][]='Invio FALLITO';
                    $result['errors'][]=$mail->ErrorInfo;
            }
            
            return $result;
    }

    function BuildSelect($type, $name, $value = null,$abilitato){
        $list = $this->GetList($type,$abilitato);
        //Helpers::printR($list);
        $element = '<select name="'.$name.'">';
            $element .= '<option value="">Choose...</option>';
            foreach($list AS $item){
                if($item['ID'] == $value)
                    $element .= '<option value="'.$item['ID'].'" selected>'.stripslashes($item['fullname']).'</option>';
                else
                    $element .= '<option value="'.$item['ID'].'">'.stripslashes($item['fullname']).'</option>';
            }
            $element .= '</select>';
        return $element;
    }
    
	
} //classe end