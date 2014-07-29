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
                        <li style="border: 1px solid #DDD"><img src="images/slider/plantari.jpg" alt="Plantari su misura" border="0" /></li>
                    </ul>
                    <div class="clr"></div>
                    <a class="back" href="javascript:history.back()">&laquo; Torna indietro</a>
                    <div class="clr"></div>
                    <ul class="flexy-gird flexy-gird-two">
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <img class="clients-img" style="height: 100px; margin-top: -5px;" src="images/plantari.png" alt="">
                                    <p><span>Cliente:</span> Plantari su misura</p>
                                    <p><span>Tipologia:</span> Vendita plantari su misura</p>
                                    <p><span>Progetto:</span> Progettazione sito web</p>
                                    <p><span>Anno:</span> 2012</p><br />
                                    <a href="http://www.plantarisumisura.it/" title="TaxInsieme" target="_blank"><span>www.plantarisumisura.it</span></a>
                                </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                   <h2 style="border-bottom: 1px solid #B1C900;">Richieste del cliente</h2>
                                    <p>Realizzazione sito web dinamico</p>
                                    <h3>Linguaggio utilizzato</h3>
                                    <p>Database, mysql, php, html, css</p>
                                    <h3>Pannello Controllo</h3>
                                    <p>si</p>
                                    <h3>Durata Sviluppo</h3>
                                    <p>3 mesi</p>
                                </article>
                            </div>
                        </li>
                    </ul>

                    
<!--                    <div class="flexy-gird">
                        <div class="flexy-gird-cell">
                            <div class="flexy-gird-cell-container">
                                <article>
                                    <h1>Benvenuto su I-Factory</h1>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere, turpis in vehicula vulputate, nibh lectus lacinia leo, in ultrices est odio id enim. Fusce eget arcu eget nisl varius pulvinar. Nunc vehicula feugiat dolor consequat interdum. Vestibulum varius rutrum orci, vitae fringilla velit scelerisque a. Vestibulum semper pretium odio, sed consectetur ligula aliquam a. Etiam egestas malesuada semper. Fusce nec justo magna, at interdum enim. Pellentesque tortor sem, luctus ut pulvinar eget, sagittis egestas metus. Aliquam erat volutpat. Donec mauris lorem, convallis sed viverra ac, pellentesque et mi. Sed et sollicitudin arcu. Phasellus sollicitudin scelerisque leo in hendrerit. Morbi rutrum ligula feugiat libero aliquet ornare egestas nisi tincidunt.</p>
                                </article>
                            </div>
                        </div>
                        <div class="flexy-gird-cell">
                            <div class="flexy-gird-cell-container">
                                <h1><a href="#">Titolo dell'ultimo post inserto da pannello</a></h1>
                                <article>
                                    <p><img src="images/img_nd.jpg" alt="">19/04/2013 - Nunc volutpat est quis nisi feugiat eleifend vitae ac nulla. Vestibulum sagittis diam tincidunt tellus euismod fringilla. Maecenas vel porta felis. Vestibulum sodales mi vel elit ullamcorper vitae lacinia lacus mattis. Nullam vel felis non lectus rhoncus pharetra quis eu augue. Nunc quam tellus, sagittis et ornare a, lacinia eu turpis. Donec eget tellus sed dui iaculis varius vel in nibh. Donec ornare justo ac est venenatis et luctus lorem aliquam.</p>
                                    <a class="read-more right" href="#">Leggi tutto</a>
                                    <div class="clr"></div>
                                    <h2>Post recenti</h2>
                                    <ul class="more-news">
                                        <li><a href="#">Pellentesque congue hendrerit laoreet.</a></li>
                                        <li><a href="#">Vestibulum lacinia hendrerit suscipit.</a></li>
                                        <li><a href="#">Aliquam ut lacus diam.</a></li>
                                    </ul>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="clr"></div>
                    <div class="flexy-gird-fullwidth">
                        <div class="flexy-gird-cell-container">
                            <article>
                                <h1>Questa è una griglia flessibile ma con una sola colonna</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere, turpis in vehicula vulputate, nibh lectus lacinia leo, in ultrices est odio id enim. Fusce eget arcu eget nisl varius pulvinar. Nunc vehicula feugiat dolor consequat interdum. Vestibulum varius rutrum orci, vitae fringilla velit scelerisque a. Vestibulum semper pretium odio, sed consectetur ligula aliquam a. Etiam egestas malesuada semper. Fusce nec justo magna, at interdum enim. Pellentesque tortor sem, luctus ut pulvinar eget, sagittis egestas metus. Aliquam erat volutpat. Donec mauris lorem, convallis sed viverra ac, pellentesque et mi. Sed et sollicitudin arcu. Phasellus sollicitudin scelerisque leo in hendrerit. Morbi rutrum ligula feugiat libero aliquet ornare egestas nisi tincidunt.</p>
                            </article>
                        </div>
                    </div>-->
                </section>
            </div>
            <div class="pushfooter"></div>
        </div>
        <?php include('../footer.php')?>
    </body>
</html>
