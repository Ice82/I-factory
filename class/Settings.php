<?php

class Settings
{
	// dati CONNESSIONE
	var $db_host = "62.149.150.83"; //on-line
	//var $db_host = "localhost";
	var $db_name = "Sql221371_4";
	var $db_user = "Sql221371";
	var $db_pass = "1f291182";
	
	var $nome_dominio = "I-factory";
	var $sottotitolo = "Web Agency";
	var $titolo_reserved_area = "Area riservata";
	var $colore = "#09647A";
	
	
	var $emailSys = "postmaster@i-factory.biz";
	var $emailRef = "postmaster@i-factory.biz";
	var $emailWebmaster = "postmaster@i-factory.biz";
	
	var $pageIndex = "tool.php";
	
	var $filePanelAccess = "login.css";
	var $filePanel = "admin.css";
	
	var $numRowsResultSearch = 3;
	
	
	// method declaration
    public function displayVar() {
        echo $this->var;
    }
}