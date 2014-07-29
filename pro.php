<?php
include("commonSetting.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>i-Factory</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="fonts/fonts.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="cont">
  <?php include("header.php")?>
  <?php include("colSX.php")?>
  <div class="dx">
    <div class="seo_home">
      <h2>Profilo</h2>
      
      <p>I-Factory è un'azienda giovane che opera nel settore della web e software consulting.</p>
      <br />
      <p>Avvalendoci delle conoscenze e delle capacità acquisite, armonizziamo dinamismo e creatività per progettare e realizzare con unicità e in linea con la prospettiva del cliente.</p>
      <br />
      <h3>SERVIZI</h3>
      <ul class="elPunt">
        <li>Siti Web</li>
        <li>Portali web (Blog, Forum, Chat, Newsgroup)</li>
        <li>Siti di E-commerce B2B e B2C</li>
        <li>Interfaccia al web di database esistenti</li>
        <li>Sites-analysis</li>
        <li>Web Marketing</li>
        <li>SEO</li>
      </ul>

      <br />
      <h3>SERVIZI DI PUNTA</h3>
      <ul class="elPunt">
        <li>Realizzazione e Gestione di siti dinamici personalizzabili dall'utente</li>
        <li>Posizionamento motori di ricerca</li>
      </ul>

      <br />
      <h3>SKILLS</h3>
      <ul class="elPunt">
        <li>search engine</li>
        <li>programming ServerSide/ClientSide</li>
        <li>programmazione procedurale</li>
        <li>programmazione Object Oriented</li>
        <li>databases</li>
        <li>PHP/MySQL</li>
      </ul>
      <br />
      <h3>ELEGANZA, ACCESSIBILITA', PROMOZIONE</h3>
      <p>Il web non dev’essere solo una vetrina ma rapprensentare per le aziende un valido strumento e un’incredibile opportunità di espansione.Entusiasmare l'utente ma offrire una reale e precisa immagine della tua azienda e dei tuoi prodotti.</p>
      <br />
      <p><strong>Un sito accattivante e fresco in termini di grafica, ma al contempo funzionale e accessibile oggi è assolutamente necessario.</strong></p>
      <br />
      <p>Solo l'estetica non basta, un sito web efficace deve essere progettato per il futuro, fornire la massima accessibilità a tutti (anche a persone portatrici di handicap), essere visibile correttamente con tutte le risoluzioni e con i maggiori browser.</p>
      <br />
      <p>La massima cura nell'accessibilità e opzioni avanzate nella gestione tramite backoffice, unite alla ottimizzazione e il posizionamento delle pagine nei motori di ricerca (Search Engine), fanno della I-Factory un affidabile partner al tuo servizio.</p>
    </div>
    <div class="site_form">
      <h2>Richiedi una Consulenza</h2>
      <h3>Inserisci mail e l'indirizzo del sito</h3>
      <form action="">
        <label>E-mail</label>
        <input type="text" class="text" value="nome@mail.com" />
        <label>Nome dominio</label>
        <input type="text" class="text" value="www.tuosito.com" />
        <input type="submit" class="submit" value="Vai" />
      </form>
    </div>
    <div class="clear"></div>
    <hr />
    <div class="clear"></div>
    <?include("news_blog.php")?>
  </div>
  <div class="clear"></div>
  <div class="footer"><a href="#">i-factory</a> di Nicola Claudio Cellamare - P.IVA 06132490720</div>
</div>
</body>
</html>