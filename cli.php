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
                                    <h1>Clienti</h1>
                                    <p>I nostri Clienti ci richiedono siti vetrina, spesso con implementazioni per l'e-commerce. In questo caso il sito web diventa un negozio vero e proprio abbattendo così notevolmente costi e spese. Ma c'è anche chi non rinuncia alla conoscenza reale dei Clienti e utilizza il sito per ampliare il proprio bacino di utenza.<br />
                                       Dunque, con I-Factory una richiesta per ogni esigenza e una soluzione per ogni richiesta.</p>
<!--                                    <p>Il team di I-Factory, oltre a lavorare in proprio, collabora con agenzie di comunicazione del territorio e non e con società nazionali ed internazionali, per la realizzazione di software interni per la gestione della team business intelligence, il customer service, la logistica, la gestione delle buste paga e il marketing.</p>-->
                                </article>
                            </div>
                        </li>
                    </ul>
                    <ul class="flexy-gird flexy-gird-three">
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/carrieri.html" title="Carrieri">
                                <img class="clients-img" src="images/carrieri.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/iguarantee.html" title="I Guarantee Group">
                                <img class="clients-img" src="images/iguarantee.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/groupon.html" title="Contact us Groupon">
                                <img class="clients-img" src="images/groupon.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/supermercato-frhome.html" title="FrHome">
                                <img class="clients-img" src="images/frhome.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/taxinsieme.html" title="TaxInsieme">
                                <img class="clients-img" src="images/taxi.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/hotelrondo.html" title="Rondò Hotel">
                                <img class="clients-img" src="images/rondo.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/epstudiodesign.html" title="Enza Porro Designer">
                                <img class="clients-img" src="images/ep.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/diamantenergy.html" title="Diamantenergy">
                                <img class="clients-img" src="images/diamantenergy.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/movingcenter.html" title="MovingCenter Autoclub">
                                <img class="clients-img" src="images/movingcenter.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/myteacup.html" title="My Tea Cup">
                                <img class="clients-img" src="images/myteacup.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/chefsrus.html" title="Chefsrus">
                                <img class="clients-img" src="images/chefrus.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                         <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/lauascezze.html" title="Bed & Breakfast La Uascézze">
                                <img class="clients-img" src="images/uascezze.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/plantarisumisura.html" title="Plantari su misura">
                                <img class="clients-img" src="images/plantari.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/legiare.html" title="Ristorante Le Giare">
                                <img class="clients-img" src="images/legiare.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/dardabere.html" title="Dardabere Cafè">
                                <img class="clients-img" src="images/dardabere.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/fratelli-bernard.html" title="F.lli Bernard">
                                <img class="clients-img" src="images/fratellibernard.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/thinksocial.html" title="Think social">
                                <img class="clients-img" src="images/thinksocial.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/abbraccio.html" title="Centro Diurno l'Abbraccio">
                                <img class="clients-img" src="images/abbraccio.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                         <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/melica.html" title="Studio Legale Melica">
                                <img class="clients-img" src="images/melica.png" alt="">
                                </a>
                            </article>
                            </div>
                        </li>
                         <li>
                            <div class="flexy-gird-container">
                            <article>
                                <a href="clienti/pantaleo-brattelli.html" title="Studio Legale Pantaleo e Brattelli">
                                <img class="clients-img" src="images/studiolegale.png" alt="">
                                </a>
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
        <?php include('footer.php')?>
    </body>
</html>
