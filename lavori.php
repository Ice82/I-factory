<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include("commonSetting.php");

$CNT = new Contenuti();
$SETTING = new Settings();
$HP = new Helpers();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>i-Factory - Portfolio clienti</title>
<base href="http://<?php echo $dominio ?>/" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="fonts/fonts.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="cont">
  <?php include("header.php")?>
  <?php include("colSX.php")?>
  <div class="dx">
    <div class="seo_home">
      <h2>Clienti</h2>
    </div>
    <div class="clear"></div>
    <ul class="folio">
    <?php
    $pagina = $_REQUEST['pagina'];
    $pagina = (!$pagina?1:$pagina);
    $offset = ($pagina-1)*$SETTING->numRowsResultSearch;
    $nomePagina = "clienti";

    $filtri[] = "tipologiaID=1";
    $items = $CNT->getEventSite($filtri, $offset, $SETTING->numRowsResultSearch, "ORDER BY data DESC");
    $itemsNUM = $items['num'];
    $tot_pages = ceil($itemsNUM/$SETTING->numRowsResultSearch);

    //Helpers::printR($items);
    foreach($items['risultati'] AS $itemL){
        $path = "/clienti/".$itemL['permalink'].".html";
        echo '<li class="margin">';
        echo '<div class="desc">';
          echo '<h2>Ultimo Lavoro</h2>';
          echo '<h3><a href="'.$path.'">'.strtoupper(stripslashes($itemL['titolo'])).'</a></h3>';
          echo '<p>'.  stripslashes($itemL['descrizione']).'</p>';
          echo '<p><a href="'.stripslashes($itemL['luogo']).'" target="_blank">'.stripslashes($itemL['luogo']).'</a></p>';
        echo '</div>';
        echo '<a href="#"><img src="portfolio/shd.jpg" alt="ShoppingDONNA" title="ShoppingDONNA" /></a>';
      echo '<div class="clear"></div></li>';

    }
    ?>
    </ul>
    <div class="clear"></div>
    <ul class="paginazione">
    <?php echo $HP->paginazione($tot_pages,$filtri,$pagina,$nomePagina) ?>
    </ul>


    <!-- <ul class="paginazione">
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li class="sel"><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
    </ul> -->
    <div class="clear"></div>
  <?include("news_blog.php")?>
  </div>
  <div class="clear"></div>
  <div class="footer"><a href="#">i-factory</a> di Nicola Claudio Cellamare - P.IVA 06132490720</div>
</div>
</body>
</html>