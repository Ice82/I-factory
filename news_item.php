<?php
include('common.php');

$CNT = new Contenuti();

$blogID = $_GET['id'];
$blog = $CNT->ItemByID($blogID);
$pathImage = ($blog['immagine'])?'http://www.thinksocial.it/news/'.$blog['ID'].'/'.$blog['immagine']:'images/img_nd.jpg';
$pathAllegato = ($blog['immagine'])?'http://www.thinksocial.it/news/'.$blog['ID'].'/'.$blog['allegato']:'';
//Helpers::printR($blog);
/* Setting SEO */
$title_tag = "".stripslashes($blog['titolo'])." | I-factory | Internet Solutions";

$meta_title = stripslashes($blog['title']);
$meta_description = stripslashes($blog['description']);
$meta_keywords = stripslashes($blog['keywords']);
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
                    <?php include('slider.php');?>
                    <div class="clr"></div>
                    <ul class="flexy-gird flexy-gird-one">
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <h1><?php echo stripslashes($blog['titolo'])?></h1>
                                    <p><img src="<?php echo $pathImage?>" alt="<?php echo stripslashes($blog['titolo'])?>">
                                        <a href="<?php echo $_SERVER['HTTP_REFERER']?>" class="right back">&laquo; Torna Indietro</a>
                                        <span class="blue"><?php echo Helpers::data_it($blog['data'])?></span><br><br>
                                        <?php echo stripslashes(strip_tags($blog['descrizione'],'<br><a><u><p><b><strong><i><em>'));
                                              //echo stripslashes($blog['descrizione']);
                                        ?>
                                        
                                    </p>
                                    <div class="clr"></div>
                                </article>
                            </div>
                        </li>
                    </ul>
                </section>
            </div>
            <div class="pushfooter"></div>
        </div>
        <?php include('footer.php')?>
    </body>
</html>
