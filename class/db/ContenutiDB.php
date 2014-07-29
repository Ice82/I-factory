<?php
class ContenutiDB {

 private $_cnn;
 private $table = "gs_news";

    function __construct(){
        $this->_cnn = new Connection();
    }
  
     function _Insert($keys,$value){
       $result = $this->_cnn->Insert($this->table, $keys, $value);
       
        return $result;
    }

    function _ListItem($abilitato,$offset= null, $limit= null){
        $abl = ($abilitato==1)?"WHERE c.abilitato=1 ":''; 
        if(($offset>=0) && ($limit))
            $lim = "LIMIT {$offset}, {$limit}";
        
            $query = "SELECT c.*, cat.nome AS categoriaNome
                        FROM {$this->table} AS c
                        LEFT JOIN {$this->tb_categoria} AS cat ON (c.categoriaID = cat.ID) 
                        {$abl} {$lim}";
//            echo $query;
        if(!$this->_cnn->executeQuery($query))
            return false;
        else
            return $this->_cnn->fetchAll();
    }

    function _Delete($ID){
        $query = "DELETE FROM {$this->table} WHERE ID={$ID}";
        if(!$this->_cnn->executeQuery($query))
            return false;
        else
            return true;
    }

    function _DeleteField($field,$ID){
        $query = "UPDATE {$this->table} SET {$field}=NULL WHERE ID={$ID}";
        if(!$this->_cnn->executeQuery($query))
            return false;
        else
            return true;
    }
    
    function _ItemByID($ID){
        $query = "SELECT * FROM {$this->table} WHERE (ID='{$ID}' OR permalink='{$ID}')";
        if(!$this->_cnn->executeQuery($query))
            return false;
        else
            $item = $this->_cnn->fetchAll();
        return $item[0];

    }
    
    function _Search($filter, $offset = null, $limit = null, $order = null){
        if(($offset>=0) && ($limit))
            $lim = "LIMIT {$offset}, {$limit}";
            
        if($order)
            $ord = "ORDER BY {$order}";
            
            
        $query = "SELECT SQL_CALC_FOUND_ROWS
                  *
                  FROM {$this->table}
                  WHERE ".implode(" AND ",$filter)."
                    {$ord} {$lim}";
//        echo $query;
         if(!$this->_cnn->executeQuery($query))
            return false;
        else
            $appo = $this->_cnn->fetchAll();
        
        $result['list'] = $appo;
        $result['totRecord'] = $this->_cnn->_TotalRecord();
        
        return $result;
    }
    
    function _Update($value,$key){
        $query = "UPDATE {$this->table} SET ".implode(", ",$value)." WHERE ID={$key}";
//        echo $query;
        if(!$this->_cnn->executeQuery($query))
            return false;
        else
            return true;
    }

    function _updateField($field,$ID,$nomeFile){
        $query = "UPDATE {$this->table} SET {$field}='{$nomeFile}' WHERE ID='{$ID}'";
        echo $query;
        if(!$this->_cnn->executeQuery($query))
            return false;
        else
            return true;
    }
    
    
} //classe end

