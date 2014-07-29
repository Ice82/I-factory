<?php
include('common.php');

// Page Setting
$title_tag = "WINE PRIV&Eacute;E | Le migliori bottiglie di vino in Italia ad un prezzo mai visto.";
$meta_title = "Wine Priv&eacute;e, le migliori bottiglie di vino in Italia ad un prezzo mai visto.";
$meta_description = "";
$meta_keywords = "";

if ($_POST['email_u'] == '')
    $email_u = 'Inseisci qui il tuo indirizzo email';
if ($_POST['email_p'] == '')
    $email_p = 'Inseisci qui il tuo indirizzo email';

if($_POST['pulsante_u'] == "Iscriviti alla newsletter"){
    if ( !isset($_POST['email_u']) || ($_POST['email_u'] == "")) {
        $errori['email_u'] = '<div class="message error">Inserire un indirizzo email</div>';
        $email_u = $_POST['email_u'];
    } else if ($_POST['email_u']){
        if (!eregi("^[a-z0-9][_.a-z0-9-]+@([a-z0-9][0-9a-z-]+.)+([a-z]{2,4})" , $_POST['email_u'])) {
            $errori['email_u'] = '<div class="message error">Inserire un indirizzo email valido</div>';
            $email_u = $_POST['email_u'];
        }
    }
    
    if (count($errori)<1){
        $result = 1;
        if($result){
            header("location: ".$pagina."?snd=ok");
            exit();
        }else{
            header("location: ".$pagina."?snd=ko");
            exit();
        }
    }
}

if($_POST['pulsante_p'] == "Registrati come produttore"){
    if ( !isset($_POST['email_p']) || ($_POST['email_p'] == "")) {
        $errori['email_p'] = '<div class="message error">Inserire un indirizzo email</div>';
        $email_p = $_POST['email_p'];
    } else if ($_POST['email_p']){
        if (!eregi("^[a-z0-9][_.a-z0-9-]+@([a-z0-9][0-9a-z-]+.)+([a-z]{2,4})" , $_POST['email_p'])) {
            $errori['email_p'] = '<div class="message error">Inserire un indirizzo email valido</div>';
            $email_p = $_POST['email_p'];
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="http://<?php echo $dominio ?>wine-privee/" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title_tag ?></title>
        
        <meta name="title" content="<?php echo $meta_title ?>" />
        <meta name="description" content="<?php echo $meta_description ?>" />
        <meta name="keywords" content="<?php echo $meta_keywords ?>" />
        
        <link rel="stylesheet" type="text/css" href="css/landing.css" />
        <?php include('jsLibs/scripts.php'); ?>
        <script type="text/javascript">
            $(document).ready(function(){
		window.onload = function () {
                    FullScreenBackground('#bgimg');
                }
                $(window).resize(function() {
                    FullScreenBackground('#bgimg');
                });
            });
            
            function FullScreenBackground(theItem){
                var winWidth=$(window).width();
                var winHeight=$(window).height();
                var imageWidth=$(theItem).width();
                var imageHeight=$(theItem).height();
                var picHeight = imageHeight / imageWidth;
                var picWidth = imageWidth / imageHeight;
                if ((winHeight / winWidth) < picHeight) {
                    $(theItem).css("width",winWidth);
                    $(theItem).css("height",picHeight*winWidth);
                }else {
                    $(theItem).css("height",winHeight);
                    $(theItem).css("width",picWidth*winHeight);
                };
                $(theItem).css("margin-left",winWidth / 2 - $(theItem).width() / 2);
                $(theItem).css("margin-top",winHeight / 2 - $(theItem).height() / 2);
            }
        </script>
    </head>

    <body>
        <div id="wrapper">
            <div id="header">
                <h1><a href="landing.html">Wine Priv&eacute;e </a></h1>
            </div>
            <div id="page">
                <blockquote>Grande &egrave; la fortuna di colui che possiede una buona bottiglia,<br />un buon libro, un buon amico.<br /><span>- Moli&egrave;re -</span></blockquote>
                <div class="box utente">
                    <h2>Asseconda la tua passione</h2>
                    <p><em>Il <strong>miglior vino</strong> a casa tua<br />ad un <strong>prezzo mini</strong>.</em></p>
                    <?php
                    echo $errori['email_u'];
                    
                    if($_GET['snd'] == "ok")
                        echo '<div class="message done">Grazie per esserti regirstrato.</div>';
                    if($_GET['snd'] == "ko")
                        echo '<div class="message error">Si sono verificati degli errori.</div>';
                    ?>
                    <form action="<?php echo $pagina ?>" method="post">
                        <input class="txt" type="text" name="email_u" value="<?php echo $email_u ?>" onfocus="if (this.value == 'Inseisci qui il tuo indirizzo email') {this.value=''}" onblur="if (this.value == '') {this.value='Inseisci qui il tuo indirizzo email'}" />
                        <input class="sub" type="submit" name="pulsante_u" value="Iscriviti alla newsletter" />
                    </form>
                </div>
                <div class="box produttore">
                    <h2>L'arte della produzione</h2>
                    <p><em>Presenta le tue <strong>migliori annate</strong><br />su Wine Priv&eacute;e</em></p>
                    <?php echo $errori['email_p'] ?>
                    <form action="<?php echo $pagina ?>" method="post">
                        <input class="txt" type="text" name="email_p" value="<?php echo $email_p ?>" onfocus="if (this.value == 'Inseisci qui il tuo indirizzo email') {this.value=''}" onblur="if (this.value == '') {this.value='Inseisci qui il tuo indirizzo email'}" />
                        <input class="sub" type="submit" name="pulsante_p" value="Registrati come produttore" />
                    </form>
                </div>
                <div class="clr"></div>
            </div>
            <div class="pushfooter"></div>
            <div id="bg"><img id="bgimg" src="images/lnd/bg.jpg" width="1366" height="768" alt="wine priv&eacute;e, le migliori bottiglie di vino in Italia ad un prezzo mai visto." /></div>
        </div>
        <div id="footer">
            <p>WINE PRIV&Eacute;E &copy; 2013 | <a href="chi-siamo.html">ABOUT US</a> | <a href="contatti.html">CONTACTS</a> | <a href="privacy.html">PRIVACY</a>
                <span class="credits"><a href="http://www.thinksocial.it/" target="_blank">ThinkSocial</a></span></p>
        </div>       
    </body>
</html>