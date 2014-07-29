<?php
require_once('common.php');

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$CNT = new Contenuti();
$notizie_num = 10;

$pag = $_GET['pagina'];
$pag = (!$pag?1:$pag);
$offset = ($pag-1)*$notizie_num;


/* Setting SEO */
$title_tag = "Blog | I-factory | Internet Solutions";

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
                    
                    <?php 
                    $filter[] = "factory=1";
                    $order = "data DESC";
                    $list = $CNT->Search($filter, $lingua, $offset, $notizie_num, $order);
                    $tot_pages = ceil($list['totRecord']/$notizie_num);
                    //Helpers::printR($list);
                    if($list['totRecord']>0){
                        echo '<ul class="flexy-gird flexy-gird-two">';
                        foreach($list['list'] AS $item){
                            $path = "/blog/".$item['permalink'].".html";
                            $pathImage = ($item['immagine'])?'http://www.thinksocial.it/news/'.$item['ID'].'/'.$item['immagine']:'/images/img_nd.jpg';                    
                            $descrizioneSmall = Helpers::TroncaTesto($item['descrizione'],200,false,true);
                            echo '<li>
                                <div class="flexy-gird-container">
                                    <article>
                                    <h1><a href="'.$path.'">'.$item['titolo'].'</a></h1>
                                    <p>
                                        <img src="'.$pathImage.'" alt="'.$item['titolo'].'">
                                        <span class="blue">'.$item['data'].'</span><br>
                                        '.$descrizioneSmall.'
                                    </p>
                                    <a class="read-more right" href="'.$path.'">Leggi tutto &raquo;</a>
                                    <div class="clr"></div>
                                    </article>
                                </div>
                            </li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                    <!--
                    <ul class="flexy-gird flexy-gird-one">
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <h2>Post recenti</h2>
                                    <ul class="more-news">
                                        <li><a href="#">Pellentesque congue hendrerit laoreet.</a></li>
                                        <li><a href="#">Vestibulum lacinia hendrerit suscipit.</a></li>
                                        <li><a href="#">Aliquam ut lacus diam.</a></li>
                                    </ul>
                                </article>
                            </div>
                        </li>   
                    </ul>
                    -->
                    
                    <div class="clr"></div>
                    <div class="page_counter">Pagina <strong><?php echo $pag?></strong> di <?php echo ($tot_pages==0)?1:$tot_pages?></div>
                    <ul class="paginazione">
                        <?php 
                        $HP = new Helpers();
                        echo $HP->paginazione($tot_pages,"", $pagina,"blog");
                        ?>
                    </ul>
                    <div class="clr"></div>
 
                </section>
            </div>
            <div class="pushfooter"></div>
        </div>
        <?php include('footer.php')?>
    </body>
</html>
