<?php
class Contenuti {
    
    private $_db = "";
    public $folderImage = "images/blue";
    public $folder = "../contenuti/";

    function __construct(){
        $this->_db = new ContenutiDB();
    }

    function Insert($value,$valoriF){
        foreach($value as $key => $value){
            $fields[] = "`$key`";
            $values[] = "'".$value."'";
        }
        //Helpers::PrintR($fields);
        //Helpers::PrintR($values);
        if( (!$fields) || (!$values))
            return false;
        $insert = $this->_db->_Insert($fields, $values);
        $dir = $this->folder.$insert."/";
        mkdir($dir, 0777);
        chmod($dir, 0777);
         
        
        if($valoriF['immagine']['name']){
            $HP = new Helpers();
            $errori = $HP->Upload($dir, $valoriF['immagine']['name'], $valoriF['immagine']['tmp_name'], 1, false, false);
            if(is_array($errori))
                return $errori;
            $resultIMG = $this->updateField('immagine',$insert,$errori);
            if(!$resultIMG)
                return $errori;
        }

        if($valoriF['allegato']['name']){
            $HP = new Helpers();
            $errori = $HP->Upload($dir, $valoriF['allegato']['name'], $valoriF['allegato']['tmp_name'], 1, false, false);
            if(is_array($errori))
                return $errori;
            $resultIMG = $this->updateField('allegato',$insert,$errori);
            if(!$resultIMG)
                return $errori;
        }
        return $insert;
    } 

    function updateField($field,$ID,$nomeFile){
        $result = $this->_db->_updateField($field,$ID,$nomeFile);
        if(!$result)
            return false;

        return $result;
    }

    function ListItem($abilitato,$offset= null, $limit= null){
        $list = $this->_db->_ListItem($abilitato,$offset,$limit);
        if(!$list)
            return false;
       
        
        return $list;
    }

    function Delete($ID){
        $result = $this->_db->_Delete($ID);
        if(!$result)
            return false;

        return $result;
    }
    
    function DeleteField($field,$ID){
        $result = $this->_db->_DeleteField($field,$ID);
        if(!$result)
            return false;

        return $result;
    }

    function ItemByID($ID){
        $item = $this->_db->_ItemByID($ID);
        if(!$item)
            return false;
        

        return $item;
    }
    
    function Search($filter, $lingua= null, $offset= null, $limit= null, $order= null){
        $list = $this->_db->_Search($filter, $offset, $limit, $order);
        if($list['totRecord']==0)
            return false;
        
        switch($_SESSION['lingua']){
            case 'it':
                foreach($list['list'] AS $x=>$item){
                    $result[$x]['ID'] = $item['ID'];
                    $result[$x]['categoriaID'] = stripslashes($item['categoriaID']);
                    $result[$x]['permalink'] = $item['permalink'];
                    $result[$x]['titolo'] = stripslashes($item['titolo']);
                    $result[$x]['sottotitolo'] = stripslashes($item['sottotitolo']);
                    $result[$x]['descrizione'] = stripslashes(strip_tags($item['descrizione'],'<br><strong><p><em><u><b>'));
                    $result[$x]['title'] = stripslashes($item['title']);
                    $result[$x]['description'] = stripslashes($item['description']);
                    $result[$x]['keywords'] = stripslashes($item['keywords']);
                    $result[$x]['data'] = Helpers::data_it($item['data']);
                    $result[$x]['ora_inserimento'] = $item['ora_inserimento'];
                    $result[$x]['ordine'] = $item['ordine'];
                    $result[$x]['inHome'] = $item['inHome'];
                    $result[$x]['immagine'] = $item['immagine'];
                    $result[$x]['abilitato'] = $item['abilitato'];
                    
                }
             break;
            case 'en':
                foreach($list['list'] AS $x=>$item){
                     $result[$x]['ID'] = $item['ID'];
                    $result[$x]['categoriaID'] = stripslashes($item['categoriaID']);
                    $result[$x]['titolo_en'] = stripslashes($item['titolo_en']);
                    $result[$x]['sottotitolo_en'] = stripslashes($item['sottotitolo_en']);
                    $result[$x]['descrizione_en'] = stripslashes(strip_tags($item['descrizione_en'],'<br><strong><p><em><u><b>'));
                    $result[$x]['title_en'] = stripslashes($item['title_en']);
                    $result[$x]['description_en'] = stripslashes($item['description_en']);
                    $result[$x]['keywords_en'] = stripslashes($item['keywords_en']);
                    $result[$x]['data_inserimento'] = $item['data_inserimento'];
                    $result[$x]['ora_inserimento'] = $item['ora_inserimento'];
                    $result[$x]['ordine'] = $item['ordine'];
                    $result[$x]['inHome'] = $item['inHome'];
                    $result[$x]['abilitato'] = $item['abilitato'];
                }
             break;
        }
//        Helpers::printR($list['list']);
        $result['list'] = $result;
        $result['totRecord'] = $list['totRecord'];
        return $result;
    }
    
    function Update($value,$valoriF){
        $id = $value['id'];
        unset($value['id']);
        foreach($value as $key => $value){
            $fields[] = "`$key` = '".$value."'";
        }
        //Helpers::printR($fields);
        if(!$fields)
            return false;

        $update = $this->_db->_Update($fields,$id);

        if($valoriF['immagine']['name']){
            $dir = $this->folder.$id;
            $HP = new Helpers();
            $errori = $HP->Upload($dir, $valoriF['immagine']['name'], $valoriF['immagine']['tmp_name'], 1, false, false);

            if(is_array($errori))
                return $errori;
            $resultIMG = $this->updateField('immagine',$id,$errori);
            if(!$resultIMG)
                return $errori;
        }
        if($valoriF['allegato']['name']){
            $dir = $this->folder.$id;
            $HP = new Helpers();
            $errori = $HP->Upload($dir, $valoriF['allegato']['name'], $valoriF['allegato']['tmp_name'], 1, false, false);

            if(is_array($errori))
                return $errori;
            $resultIMG = $this->updateField('allegato',$id,$errori);
            if(!$resultIMG)
                return $errori;
        }
        return $update;
    }

    function BuildSelect($name, $value = null){
        $list = $this->ListItem(1);

        $element = '<select name="'.$name.'">';
            $element .= '<option value="">Scegli...</option>';
            foreach($list AS $item){
                if($item['ID'] == $value)
                    $element .= '<option value="'.$item['ID'].'" selected>'.stripslashes($item['categoriaNome']).'</option>';
                else
                    $element .= '<option value="'.$item['ID'].'">'.stripslashes($item['categoriaNome']).'</option>';
            }
            $element .= '</select>';
        return $element;
    }
    
    function BuildCheckbox($name, $value = null){
        $list = $this->GetList(1);
        
            foreach($list AS $item){
                if($item['ID'] == $value)
                        $element .= '<div class="block-checkbox"><input type="checkbox" name="'.$name.'[]" id="'.$name.'" class="checkbox" value="'.$item['ID'].'" checked /><label class="lbl-checkbox">'.$item['nome'].'</label></div>';
                    else
                        $element .= '<div class="block-checkbox"><input type="checkbox" name="'.$name.'[]" id="'.$name.'" class="checkbox" value="'.$item['ID'].'" /><label class="lbl-checkbox">'.$item['nome'].'</label></div>';
            }
            $element .= '</select>';
        return $element;
    }

} 
