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
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
        <script type="text/javascript"> 
            $(document).ready(function(){
                initialize();
            });

        function initialize() {
                var lat = "41.12168";
                var lon = "16.87355";
                var livello = "mappa"
                var myLatlng = new google.maps.LatLng(lat,lon);
                var myOptions = {
                  zoom: 15,
                  center: myLatlng,
                  mapTypeId: google.maps.MapTypeId.ROADMAP,
                  streetViewControl: true
                }
                var map = new google.maps.Map(document.getElementById(livello), myOptions);

                var marker = new google.maps.Marker({
                    position: myLatlng, 
                    map: map,
                    title:"I-Factory"
                });   
          }
        </script>
        <?php include('jsLibs/analytics.php')?>
    </head>
    <body onload="sliderSize();">
        <div id="wrapper">
            <?php include('header.php')?>
            
            <div class="container ">
                <?php include('sidebar.php')?>
                <section id="page">
                    <?php include('slider.php')?>
                    <div class="clr"></div>
                    <ul class="flexy-gird flexy-gird-two">
                        <li>
                            <div class="flexy-gird-container" style="height: 245px !important">
                            <article>
                                <h1>Contatti</h1>
                                <p>Via Cardassi, 14</p>
                                <p>70125 BARI (Italy)</p><br />
                                <p>mail info@i-factory.biz</p>
                                <p>pec info@pec.i-factory.biz</p><br />
                                <p>tel +39 080.9909564</p>
                                <p>fax +39 080.9756910</p>
                                <p>mob +39 393.9934643</p><br />
                                <p>P.IVA 06132490720</p>
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <h1>Dove siamo</h1>
                                    <div id="mappa" style="border: solid 1px #999; margin-top: 15px; height: 200px"></div>
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
