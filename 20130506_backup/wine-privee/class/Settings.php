<?php

class Settings {
    // dati CONNESSIONE
    //var $db_host = "127.0.0.1"; //on-line
    var $db_host = "62.149.150.161";
    var $db_name = "Sql568982_1";
    var $db_user = "Sql568982";
    var $db_pass = "51f85d3a";

    var $dominio = "MyGest - DiamantEnergy.com";
    var $dominio_url = "";

    var $panel_title = "DiamantEnergy";
    var $panel_titledefault = " - Pannello di Controllo";
    var $panel_subtitle = "Gestione Statistiche &amp; more";

    var $typeAdminID= 1;
    var $emailSys = "info@diamantenergy.com";
    var $emailRef = "postmaster@i-factory.biz";
    var $emailAdmin = "postmaster@i-factory.biz";
    var $emailHelp = "supporto@i-factory.biz";
	var $helpPhone = "(+39) 393.9934643";
 
    var $pageIndex = "/admin";
    var $userOUT = "../admin?logout=0";
    var $OUT = "../admin?logout=1";
    var $logout = "../admin.html";

    var $num = "2"; //per line grigi/bianco in tabelle
    var $passLenght = 8; // lunghezza password
	//var $back = $_SERVER['HTTP_REFERER'];
	 
    var $Robots = "All";
    var $Owner = "I-factory";
    var $Author ="I-factory";
    var $Copyright = "DiamantEnergy.com";

    var $HP = "";
    var $pagina = "";
    var $numRowsPrd = 3;

    function __construct(){
        $this->HP = new Helpers();
        $this->dominio_url = $_SERVER['SERVER_NAME'];
        $this->pagina = $this->HP->getNomeFile();
    }




}