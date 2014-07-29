<?php

class Connection{
 
    function __construct(){
        $SET = new Settings();
        $dbdsn  = "mysql:host=".$SET->db_host.";port=3306;dbname=".$SET->db_name.""; // mysql
        $dbuser = $SET->db_user;
        $dbpass = $SET->db_pass;
 
        try {
            $this->myPdo = new PDO($dbdsn, $dbuser, $dbpass);
            //return $this->$myPdo;
            //echo "Connessione riuscita<br><br>";
        }catch(PDOException $e) {
            die( 'Errore di connessione: '.$e->getMessage());
        }
    }
  
    function storeErrors($error){
        $this->errori[$this->indice]=$error;
	$this->indice++;
    }
  
    function getErrors(){
        return $this->errori;
    }
  
    function closeConnection(){
        $this->myPdo = NULL;
    }
  
    function executeQuery($query){  
        $this->myPdo->exec("SET CHARACTER SET utf8"); 
	$this->myPdo->exec("SET NAMES utf8");
        $this->stPdo = $this->myPdo->prepare($query);
	if(!$this->stPdo){
            $errorinfo = $this->myPdo->errorInfo();
            $this->storeErrors($errorinfo[2]);
            return false;
        }else{	
            if(!$this->stPdo->execute()){
                $errorinfo = $this->stPdo->errorInfo();
                $this->storeErrors($errorinfo[2]);
                return false;
            }else{
                return $this->stPdo;
            }
        }	 
    }
   
    function fetchAll(){
        $rows = $this->stPdo->fetchAll();
        $this->stPdo->closeCursor();
        return $rows;
    }

    function Insert($table,$keys,$value,$view = null, $return_key = null){
        $query = "INSERT INTO {$table} (".implode(", ",$keys).") VALUES(".implode(", ",$value).")";

        if($view)
            echo $query;

        if(!$this->executeQuery($query)){
            return false;
        }else{
                return $this->myPdo->lastInsertId();
            
        }
    }
    
    function Delete($table,$key,$value,$view = null){
        $query = "DELETE FROM $table WHERE ".$key."='{$value}'";
        
        if($view)
            echo $query;

        if(!$this->executeQuery($query))
            return false;
        else
            return true;
    }
    
    function Update($table,$value,$key,$key_column,$view = null){
        
        $query = "UPDATE {$table} SET ".implode(", ",$value)." WHERE ".$key_column."='{$key}'";

        if($view)
            echo $query;
        
        if(!$this->executeQuery($query))
            return false;
        else
            return true;
    }
    
    public function _TotalRecord(){
        $query = "SELECT FOUND_ROWS() as `totRecord`;";
        $this->executeQuery($query);
        $appo = $this->fetchAll();
        return $appo[0]['totRecord'];
    }
    
}