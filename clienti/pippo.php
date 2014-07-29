<?php
require_once('../common.php');

/* Setting SEO */
$title_tag = "I-factory | Internet Solutions";

$meta_title = "";
$meta_description = "";
$meta_keywords = "";
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <base href="http://<?php echo $dominio ?>">
        <title><?php echo $title_tag ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="<?php echo $meta_title ?>">
        <meta name="description" content="<?php echo $meta_description ?>">
        <meta name="keywords" content="<?php echo $meta_keywords ?>">
        <meta name="author" content="I-factory | Internet Solutions | www.i-factory.biz">
        
        <link href="css/style.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
        
        <style>
           span {color: #0073B7}
           a {font-size: 0.8em; color: #0073B7 }
           a:hover {color: #0073B7}
        </style>
        
        <?php include('../ico/icon.php')?>
        <?php include('../jsLibs/scripts.php')?>
        <?php include('../jsLibs/analytics.php')?>
    </head>
    
    <body>
        <div id="wrapper">
            <?php include('../header.php')?>
            
            <div class="container ">
                <?php include('../sidebar.php')?>
                <section id="page">
                    <ul class="flexy-gird flexy-gird-one" id="top-image">
                        <li style="border: 1px solid #DDD"><img src="images/slider/frhome.jpg" alt="FrHome" border="0" /></li>
                    </ul>
                    <div class="clr"></div>
                    <a class="back" href="javascript:history.back()">&laquo; Torna indietro</a>
                    <div class="clr"></div>
                    <ul class="flexy-gird flexy-gird-two">
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <img class="clients-img" style="height: 100px" src="images/frhome.png" alt="">
                                    <p><span>Cliente:</span> FrHome</p>
                                    <p><span>Tipologia:</span> E-commerce</p>
                                    <p><span>Progetto:</span> Sviluppo sito e-commerce</p>
                                    <p><span>Anno:</span> 2013</p><br />
                                    <a href="http://www.frhome.it/" title="FrHome" target="_blank"><span>www.frhome.it</span></a>
                                </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <h2 style="border-bottom: 1px solid #B1C900;">Richieste del cliente</h2>
                                    <p>Costruzione di un portale di e-commerce basato sul modello di spesa online</p>
                                    <h3>Linguaggio utilizzato</h3>
                                    <p>Database, mysql, php, ajax, html, css</p>
                                    <h3>Pannello Controllo</h3>
                                    <p>si</p>
                                    <h3>Durata Sviluppo</h3>
                                    <p>4 mesi</p>
                                </article>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>
            <div class="pushfooter"></div>
        </div>
        <?php include('../footer.php')?>
    </body>
</html>
