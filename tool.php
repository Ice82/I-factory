<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include("commonSetting.php");
$SETTING = new Settings();
$UC = new User();

if ($_POST['pulsante'] == "login"){
	$user = trim($_POST['user']);
	$psw = trim($_POST['psw']);
	if (!($user)) $errori['user'] = "Nome utente mancante";
	if (!($psw)) $errori['psw'] = "Password mancante";
	
	if(count($errori)<1){
		$esiste = $UC->getUserFromAccess($user,$psw);
                Helpers::printR($esiste);
		//Helpers::printR($UC->cnn->getErrors());
		if ($esiste){
			$_SESSION['user'] = $esiste[0]['RAGSOC'];
			$_SESSION['iduser'] = $esiste[0]['ID'];
			$_SESSION['type'] = $esiste[0]['TYPE'];
			$_SESSION['nomeType'] = $esiste[0]['nomeType'];
			$_SESSION['IsUserGood'] = true;
			header("location: pvt_area/index.php");
		}else{
			//header("location: ". $SETTING->pageIndex ."?msg=1");
			echo "Pippo";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="imagetoolbar" content="no" />
<meta http-equiv="Content-Language" content="it" />
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="no-cache"> 
<meta http-equiv="Expires" content="-1"> 
<meta http-equiv="cache-Control" content="no-cache"> 
<meta name="Robots" content="All" />
<meta name="Owner" content="I-factory" /> 
<meta name="Author" content="I-factory" />  
<meta name="Copyright" content="Scenari d'Italia.it" />
<title><?php echo $SETTING->nome_dominio ?> - <?php echo $SETTING->sottotitolo ?></title>
<link media="screen" rel="stylesheet" type="text/css" href="css/login.css"  />
<!-- blue theme is default -->
<link rel="stylesheet" type="text/css" href="css/<?php echo $SETTING->filePanelAccess ?>" />
</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<div id="login_wrapper">
		
		<h1><?php echo $SETTING->nome_dominio ?><span class="ico"></span><br><span style="font-size: 18px"><?php echo $SETTING->sottotitolo ?></span></h1>
			<form action="<?php $SETTING->pageIndex ?>" method="post">
				<fieldset>
						<label>
							<strong>Login:</strong>
							<span class="input_wrapper">
								<input type="text" name="user"/>
							</span>
						</label>
						<label>
							<strong>Password:</strong>
							<span class="input_wrapper">
								<input type="password" name="psw"/>
							</span>
						</label>
						<p>
							<a href="richiedi.php" class="lost_pass"><span>Richiedi password?</span></a>
							<span class="button send_form_btn"><span><span>Login</span></span><input type="submit" name="pulsante" value="login"/></span>
						</p>
						<p>
							<a href="recupera.php" class="lost_pass"><span>Recupera password?</span></a>
							
						</p>
				</fieldset>
			</form>

<?php if ($_GET['msg'] == "1"){?>
			<div class="error">
				<div class="error_inner">
					<strong>Login fallito</strong> - Utente Inesistente
				</div>
			</div>
<?php } ?>

<?php if ($errori){?>
			<div class="error">
				<div class="error_inner">
					<strong>Login fallito</strong><br />
					&nbsp; &nbsp; &nbsp; <?php echo $errori['user']?><br />
					&nbsp; &nbsp; &nbsp; <?php echo $errori['psw']?><br />
				</div>
			</div>
<?php } ?>


<?php if ($_GET['logout'] == "1"){
	session_unset();
	session_destroy();
	?>
			<div class="error">
				<div class="error_inner">
					<strong>Logout effettuato con successo</strong><br />
				</div>
			</div>
<?php } ?>

<?php if ($_GET['logout'] == "0"){
	session_unset();
	session_destroy();
	?>
			<div class="error">
				<div class="error_inner">
					<strong>Effettua nuovamente l'accesso</strong><br />
				</div>
			</div>
<?php } ?>


		<div style="float: left">[ <a href="index.php">Home</a> ]</div>	
		<div style="float: right">[ Powered by <a href="http://www.i-factory.biz/" target="new" style="color: #fff">I-Factory</a> ]</div>
		</div>
	</div>
	<!--[if !IE]>end wrapper<![endif]-->

</body>
</html>
