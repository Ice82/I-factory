<?php
require_once('common.php');

if($_POST['pulsante'] == "INVIA"){
        if ( !isset($_POST['azienda']) || ($_POST['azienda'] == "")) $errori['azienda'] = ' err';
    	if ( !isset($_POST['nominativo']) || ($_POST['nominativo'] == "")) $errori['nominativo'] = ' err';
    	if ( !isset($_POST['email']) || ($_POST['email'] == "")) $errori['email'] = ' err';
        if($_POST['email']){
            if (!eregi("^[a-z0-9][_.a-z0-9-]+@([a-z0-9][0-9a-z-]+.)+([a-z]{2,4})" , $_POST['email'])) $errori['email'] = ' err';
        }
        if ( !isset($_POST['servizio']) || ($_POST['servizio'] == "")) $errori['servizio'] = 'class="err"';
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
		<style>
		.elenco li { color: #333333; font-size: 0.8em; line-height: 1.6em; list-style-type: square !important; margin-left: 15px;}
		</style>
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
                     <ul class="flexy-gird flexy-gird-one">
                        <li>
                            <div class="flexy-gird-container">
                                <article>
                                    <h1>Servizi</h1>
                                    <p>
									
Negli ultimi anni sempre più business in italia e all’estero hanno compreso l’enorme potenziale del Web e l’hanno intelligentemente sfruttato, registrando risultati eccellenti in termini di soddisfazione del cliente, fidelizzazione, profitti, quote di mercato e visibilità del brand.
<br/>
<br/>
Oggi il consumatore è avvezzo e disinteressato alla pubblicità tradizionale, è più oculato ed informato e quindi meno influenzabile con semplici slogan o jingle, è proattivo e desideroso di un servizio altamente personalizzato ed ha sempre meno risorse in termini di tempo e denaro.
<br/>  
<br/> 
Non bisogna ignorare le esigenze del mercato ma comprenderle e assecondarle e I-Factory si propone proprio di aiutare i propri clienti nel restare al passo coi tempi ed entrare a far parte di quella realtà virtuale così tanto controversa e competitiva eppure ricca di opportunità.
<br/>
<br/>
Tuttavia, il sito web è solo una piccola goccia nel deserto che ha bisogno di molti altri servizi accessori per poter ottenere i risultati sperati. Fondamentale è in questo senso il contributo di SEO, SEM, Web marketing e marketing strategico, copywriting e foto/video making professionale.
<br/>
<br/>
Qui di seguito sono descritti con maggiore dettaglio i servizi offerti dal nostro team:
<br/>
<br/>

<p><strong>Website building</strong><ul class="elenco">
<li>Siti dinamici</li>
<li>Siti e-commerce</li>
<li>Siti internet low cost</li>
<li>Siti per supporti mobile</li>
</ul></p>
<br/>
<p><strong>Web reputation</strong><ul class="elenco">
<li>SEO</li>
<li>Social Media Marketing</li>
<li>Baby sitter site</li>
<li>Facebook</li>
<li>Twitter</li>
<li>Pinterest</li>
</ul>
</p>
<br/>
<p><strong>Advanced services</strong><ul class="elenco">
<li>Formazione per le aziende</li>
<li>Copywriting, foto/video making professionale</li>
<li>App Apple o Android</li>
<li>Newsletter</li>
<li>Logo design</li>
</ul>
</p>
<br/>
<p>Questi servizi non prevedono una tariffa fissa facilmente definibile, considerando la variabilità che contraddistingue i servizi stessi. 
<br/>Bisogna prendere in considerazione diversi paramentri di calcolo come il target da colpire, la concorrenza da affrontare e le esigenze da soddisfare. 
<br/>
Attraverso una consultazione è possibile capire come costruire la vostra campagna marketing online e a quali costi. 
<br/>
<br/>
Resta comunque una certezza la convenienza della pubblicità online rispetto alle ormai obsolete, dispendiose e poco incisive forme di pubblicità tradizionali.
<br/>
<br/>
Chiedete pure senza impegno un preventivo nella sezione contatti del nostro portale.

                                    </p>
                                </article>
                            </div>
                        </li>
                    </ul>
<!--                    <div class="clr"></div>-->
<!--                    <div class="flexy-gird-container">
                            <article>
                                <form class="classic" action="<?php echo $pagina ?>" method="post">
                                <h1>Per richiedere un preventivo, compilare il modulo sottostante.</h1>
                                <p>DATI PERSONALI:</p><br />
                                <?php
                            if(count($errori)>0)
                                echo '<div class="message error"><span>Errori nella compilazione del form! Riempire i campi obbligatori.</span></div>';
                            if($_GET['snd'] == "ok")
                                echo '<div class="message done"><span>Il suo messaggio è stato inviato correttamente.</span></div>';
                            if($_GET['snd'] == "ko")
                                echo '<div class="message alert"><span>Si sono verificati degli errori durante l\'invio del messaggio.</span></div>';
                            ?>
                            <label>Azienda <em>*</em></label>
                            <input class="txt <?php echo $errori['azienda'] ?>" type="text" name="azienda" value="<?php echo $_POST['azienda'] ?>">
                            <div class="clr"></div>
                            
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
                            
                            <label>Richiedi servizio <em>*</em></label>
                            <textarea name="servizio" <?php echo $errori['servizio']?> cols="5" rows="5"></textarea>
                            <div class="clr"></div>
                            
                            <div class="checkGroup">
                                <label>&nbsp;</label>
                                <input class="check" type="checkbox" value="1" <?php if($_POST['privacy']=='1') echo 'checked="checked"'; ?> name="privacy">
                                <label class="checkLbl <?php echo $errori['privacy'] ?>">Consenso al <a href="trattamento-dati-personali.html">Trattamento dei dati personali</a>.</label>
                                
                                <div class="clr"></div><br />
                            </div>
                            <input class="sub" type="submit" name="pulsante" value="INVIA">
                            <div class="clr"></div>
                         
                    </div>-->
                   
                </section>
            </div>
            <div class="pushfooter"></div>
        </div>
        <?php include('footer.php')?>
    </body>
    
</html>
