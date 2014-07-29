<?php
require_once('common.php');

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
        <!--<base href="http://<?php echo $dominio ?>">-->
        <title><?php echo $title_tag ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="title" content="<?php echo $meta_title ?>">
        <meta name="description" content="<?php echo $meta_description ?>">
        <meta name="keywords" content="<?php echo $meta_keywords ?>">
        <meta name="author" content="I-factory | Internet Solutions | www.i-factory.biz">
        
        <link href="css/style.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
        <?php include('ico/icon.php')?>
        <?php include('jsLibs/scripts.php')?>
        <?php include('jsLibs/analytics.php')?>
    </head>
    
    <body onload="sliderSize()">
        <div id="wrapper">
            <?php include('header.php')?>
            
            <div class="container ">
                <?php include('sidebar.php')?>
                <section id="page">
                    <?php include('slider.php')?>
                    <div class="clr"></div>
                    <ul class="flexy-gird flexy-gird-one">
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <h1>Profilo</h1>
                                    <p>I-Factory nasce l’8 marzo del 2004  dall’idea imprenditoriale di un giovane barese laureato in informatica e con esperienza ormai decennale in programmazione ad oggetti, php, apache, database, jquery, siti e-commerce per B2B e B2C, il quale ha successivamente deciso di farsi affiancare da due esperti in web design e web marketing, con particolare attenzione a SEO e SEM. 
<br/>									
<br/>In quanto attività in forte espansione, I-factory si avvale anche di consulenze esterne che gli consentono di perfezionarsi e aggiornarsi quotidianamente, rendendo così un servizio altamente personalizzato e professionale al cliente.
<br/>
<br/>L’idea su cui verte il nostro business non vuol essere di pura consulenza informatica, ma partendo da essa si articola poi in molteplici servizi che vanno dal customized website building alla formulazione di strategie di Web Marketing per accompagnare il cliente passo dopo passo verso un vantaggio competitivo duraturo nel suo mercato di riferimento.
<br/>
<br/>A ciò si aggiunge anche quel ramo aziendale rappresentato dalla mera formazione per il conseguimento dell’ECDL, per l’apprendimento e la scrittura del linguaggio HTML  e per la comprensione dei principi di Search Engine Optimization oggi fondamentali per chi vuole contrastare i grandi colossi aziendali in Rete con moderate risorse finanziarie.


									 
				
									</p>
                                </article>
                            </div>
                        </li>
                    </ul>
                    
<!--                    <ul class="flexy-gird flexy-gird-two">
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <h1>Benvenuto su I-Factory</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere, turpis in vehicula vulputate, nibh lectus lacinia leo, in ultrices est odio id enim. Fusce eget arcu eget nisl varius pulvinar. Nunc vehicula feugiat dolor consequat interdum. Vestibulum varius rutrum orci, vitae fringilla velit scelerisque a. Vestibulum semper pretium odio, sed consectetur ligula aliquam a. Etiam egestas malesuada semper. Fusce nec justo magna, at interdum enim. Pellentesque tortor sem, luctus ut pulvinar eget, sagittis egestas metus. Aliquam erat volutpat. Donec mauris lorem, convallis sed viverra ac, pellentesque et mi. Sed et sollicitudin arcu. Phasellus sollicitudin scelerisque leo in hendrerit. Morbi rutrum ligula feugiat libero aliquet ornare egestas nisi tincidunt.</p>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <h1><a href="#">Titolo dell'ultimo post inserto da pannello</a></h1>
                                    <p><img src="images/img_nd.jpg" alt="">19/04/2013 - Nunc volutpat est quis nisi feugiat eleifend vitae ac nulla. Vestibulum sagittis diam tincidunt tellus euismod fringilla. Maecenas vel porta felis. Vestibulum sodales mi vel elit ullamcorper vitae lacinia lacus mattis. Nullam vel felis non lectus rhoncus pharetra quis eu augue. Nunc quam tellus, sagittis et ornare a, lacinia eu turpis. Donec eget tellus sed dui iaculis varius vel in nibh.</p>
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
                        </li>   
                    </ul>-->
                    
<!--                    <ul class="flexy-gird flexy-gird-three">
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <img class="clients-img" src="images/logo_ifactory.png" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere, turpis in vehicula vulputate, nibh lectus lacinia leo, in ultrices est odio id enim.</p>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <img class="clients-img" src="images/logo_ifactory.png" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere, turpis in vehicula vulputate, nibh lectus lacinia leo, in ultrices est odio id enim.</p>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <img class="clients-img" src="images/logo_ifactory.png" alt="">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere, turpis in vehicula vulputate, nibh lectus lacinia leo, in ultrices est odio id enim.</p>
                            </article>
                            </div>
                        </li>   
                    </ul>-->
                    
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
        <?php include('footer.php')?>
    </body>
</html>
