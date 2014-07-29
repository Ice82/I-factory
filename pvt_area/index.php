<?php
include("../commonSetting.php");

If (($_SESSION['IsUserGood'] == False) || (!isset($_SESSION['user']))) {
	header("location: ../index.php?logout=0");
}

$SETTING = new Settings();
$GE = new General();

// Mi permette di prelevare il men� di sinistra
$mod = 1500;

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
<?php include("../css/default.php")?>

<script type="text/javascript" src="../jsLibs/css.js"></script>
<script type="text/javascript" src="../jsLibs/behaviour.js"></script>
<script type="text/javascript" src="../jsLibs/jquery-1.3.2.js"></script>

<SCRIPT type="text/javascript">

$(document).ready(function(){

    // Men� - START
    $('#menu_visualizza').click(function(){
		$(this).html("<a href=\"#\" class=\"active\"><span><span>Visualizza</span></span></a>");
		$("#menu_nascondi").html("<a href=\"#\"><span><span>Nascondi</span></span></a>");
		$("#div_menu_top").show();
   	});

    $('#menu_nascondi').click(function(){
		$(this).html("<a href=\"#\" class=\"active\"><span><span>Nascondi</span></span></a>");
		$("#menu_visualizza").html("<a href=\"#\"><span><span>Visualizza</span></span></a>");
		$("#div_menu_top").hide();
   	});
    // Men� - END
  
  
});

</SCRIPT>


</head>

<body>
<?php include("header.php")?>	
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
		
			<!--[if !IE]>start page<![endif]-->
			<div id="page">
				<div class="inner">
					
					<!--[if !IE]>start section<![endif]-->
					<?php include("menu.php")?>
					<!--[if !IE]>end section<![endif]-->
					<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Home Page</h2>
							</div>
							<div class="section_content">
							<!-- h3>Subtitle will go here if needed</h3 -->
							<p>
								Benvenuti nell'area riservata del portale <?php echo $SETTING->nome_dominio?>.<br />
								Puoi navigare in questa area utilizzando il men&ugrave; in alto, e le opzioni che trovi per ogni sezione sulla sinistra! 
							</p>
							<!--[if !IE]>start forms<![endif]-->
							</div>
						</div>
					</div>
					<!--[if !IE]>end section<![endif]-->
				</div>
			</div>
			<!--[if !IE]>end page<![endif]-->
			<!--[if !IE]>start sidebar<![endif]-->
			<div id="sidebar" >
				<div class="inner">
					<?php include("menu_option.php")?>
					<!-- QUICK START --><!--[if !IE]>start section<![endif]-->
					<?php include("quick.php")?>
					<!--[if !IE]>end section<![endif]-->
					<!-- QUICK END -->
				</div>
			</div>
			<!--[if !IE]>end sidebar<![endif]-->
		
		</div>
		<!--[if !IE]>end content<![endif]-->
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	<!--[if !IE]>start footer<![endif]-->
	<?php include("footer.php")?>
	<!--[if !IE]>end footer<![endif]-->
</body>
</html>
