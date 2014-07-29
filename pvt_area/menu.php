<?php 
if (!isset($visualizza_menu)) 
	$valore_menu = "block";
else
	$valore_menu = "none";
?>


					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Men&ugrave;</h2>
								<ul class="section_menu">
								<?php 
								if (!isset($visualizza_menu)){ ?>
									<li id="menu_visualizza"><a href="#" class="active"><span><span>Visualizza</span></span></a></li>
									<li id="menu_nascondi"><a href="#"><span><span>Nascondi</span></span></a></li>
									<!-- li><a href="#"><span><span>Others</span></span></a></li -->
								<?php }else{?>
									<li id="menu_visualizza"><a href="#"><span><span>Visualizza</span></span></a></li>
									<li id="menu_nascondi"><a href="#" class="active"><span><span>Nascondi</span></span></a></li>
									<!-- li><a href="#"><span><span>Others</span></span></a></li -->
								<?php }?>
								</ul>
							</div>
							<div class="section_content" id="div_menu_top" style="display: <?php echo $valore_menu?>">
								<!--[if !IE]>start dashboard menu<![endif]-->
								<div class="dashboard_menu_wrapper">
								<ul class="dashboard_menu">
								<?php 
									$moduli = $GE->getDashoboard($_SESSION['type']);
									if ($moduli){
										foreach($moduli AS $modulo){
											echo '<li><a href="'.$modulo['PAGINA'].'" class="d2" style="background-image:url(../css/'.$modulo['IMMAGINE'].');"><span>'.stripslashes($modulo['NOME']).'</span></a></li>';
										}
									}
								?>	
									<li><a href="index.php" class="d7"><span>Homepage</span></a></li>
								</ul>
								</div>
								<!--[if !IE]>end dashboard menu<![endif]-->	
							</div>
						</div>
					</div>