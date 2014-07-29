<?php
require_once('common.php');

if($_POST['pulsante'] == "INVIA"){
    	if ( !isset($_POST['nominativo']) || ($_POST['nominativo'] == "")) $errori['nominativo'] = ' err';
    	if ( !isset($_POST['email']) || ($_POST['email'] == "")) $errori['email'] = ' err';
        if($_POST['email']){
            if (!eregi("^[a-z0-9][_.a-z0-9-]+@([a-z0-9][0-9a-z-]+.)+([a-z]{2,4})" , $_POST['email'])) $errori['email'] = ' err';
        }
        if ( !isset($_POST['messaggio']) || ($_POST['messaggio'] == "")) $errori['messaggio'] = 'class="err"';
        if ( $_POST['privacy'] != "1") $errori['privacy'] = ' errlbl';
        if(count($errori)<1){
            $UT = new Utenti();
            $result = $UT->sendMailCustomer($_POST);
            
            if($result){
                header("location: ".$p."?snd=ok");
                exit();
            }else{
                header("location: ".$p."?snd=ko");
                exit();
            }
        }
}

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
       <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
           $(document).ready(function(){
                initialize(41.12168,16.87355,15);
            });
            
            function initialize(lat,lan,zoom) {
                var mapOptions = {
                    zoom: zoom,
                    center: new google.maps.LatLng(lat,lan),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false
                }
                
                var map = new google.maps.Map(document.getElementById("mappa"),mapOptions);
                setMarkers(map, beaches);
            }
            
            var beaches = [
                ['Sede Operativa', 41.12168, 16.87355, 1],
                ['Sede Commerciale', 41.862242, 12.563699, 2]
            ];
            
            function setMarkers(map, locations) {
                var image = {
                    url: 'http://<?php echo $dominio?>/images/marker_m.png',
                    size: new google.maps.Size(20, 32),
                    origin: new google.maps.Point(0,0),
                    anchor: new google.maps.Point(0, 32)
                };
                
                for (var i = 0; i < locations.length; i++) {
                    var beach = locations[i];
                    var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        icon: image,
                        title: beach[0],
                        zIndex: beach[3]
                    });
                }
            }
           
           $(document).ready(function(){
                initialize();
            });
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
                            <div class="flexy-gird-container">
                            <article>
                                <form class="classic" action="<?php echo $pagina ?>" method="post">
                                <h1>Per qualsiasi informazione, richiesta o preventivo, compila il modulo sottostante.</h1>
                                <p>DATI PERSONALI:</p><br />
                                <?php
                            if(count($errori)>0)
                                echo '<div class="message error"><span>Errori nella compilazione del form! Riempire i campi obbligatori.</span></div>';
                            if($_GET['snd'] == "ok")
                                echo '<div class="message done"><span>Il suo messaggio è stato inviato correttamente.</span></div>';
                            if($_GET['snd'] == "ko")
                                echo '<div class="message alert"><span>Si sono verificati degli errori durante l\'invio del messaggio.</span></div>';
                            ?>
                            <label>Nome & Cognome <em>*</em></label>
                            <input class="txt <?php echo $errori['nominativo'] ?>" type="text" name="nominativo" value="<?php echo $_POST['nominativo'] ?>">
                            <div class="clr"></div>
                            
                             <label>Telefono</label>
                            <input class="txt" type="text" name="telefono" value="<?php echo $_POST['telefono'] ?>">
                            <div class="clr"></div>
                            
                            <label>Azienda</label>
                            <input class="txt" type="text" name="azienda" value="<?php echo $_POST['azienda'] ?>">
                            <div class="clr"></div>
                            
                            <label>Email <em>*</em></label>
                            <input class="txt <?php echo $errori['email'] ?>" type="text" name="email" value="<?php echo $_POST['email'] ?>">
                            <div class="clr"></div>
                            
                            <label>Messaggio <em>*</em></label>
                            <textarea name="messaggio" <?php echo $errori['messaggio']?> cols="5" rows="5"></textarea>
                            <div class="clr"></div>
                            
                            <div class="checkGroup">
                                <label>&nbsp;</label>
                                <input class="check" type="checkbox" value="1" <?php if($_POST['privacy']=='1') echo 'checked="checked"'; ?> name="privacy">
                                <label class="checkLbl <?php echo $errori['privacy'] ?>">Consenso al <a href="trattamento-dati-personali.html">Trattamento dei dati personali</a>.</label>
                                
                                <div class="clr"></div><br />
                            </div>
                            <input class="sub" type="submit" name="pulsante" value="INVIA">
                            <div class="clr"></div>
                        </form>    
                            </article>
                            </div>
                        </li>
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <h1>Dove siamo</h1>
                                    <div id="mappa" style="border: solid 1px #999; margin-top: 15px; height: 200px"></div>
                                    <div class="clr"></div>
                                    <br />
                                    <h1>Contatti</h1>
                                <p>
                                    <a class="mapMarker" href="javascript:initialize(41.12168,16.87355,15);" title="Mostra sulla mappa">
                                <img src="images/marker_link.png" alt="Mappa">
                                <span>Sede Operativa</span><br />
                                    </a>
                                    Via Cardassi, 14<br />
                                    70123 BARI (Italy)</p><br />
                                <p>
                                    <a class="mapMarker" href="javascript:initialize(41.862242,12.563699,15);" title="Mostra sulla mappa">
                                <img src="images/marker_link.png" alt="Mappa">
                                <span>Sede Commerciale</span><br />
                                </a>
                                    Via Lucio Mummio, 31<br />
                                    00175 Roma (Italy)</p><br />
                                <p>mail info@i-factory.biz</p>
                                <p>pec info@pec.i-factory.biz</p><br />
                                <p>tel +39 080.5240790</p>
                                <p>fax +39 080.9756910</p>
                                <p>mob +39 393.9934643</p><br />
                                <p>P.IVA 07541790726</p>
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
