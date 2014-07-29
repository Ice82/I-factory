<!--[if !IE]>start section<![endif]-->
					<div class="section">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Men&ugrave; Options</h2>
							</div>
							<div class="section_content" style="display: block">
								<!--[if !IE]>start main menu<![endif]-->
								<ul id="main_menu">
									
								<?php 
								//echo $mod;
								 $sezioni = $GE->getSezioniByModulo($mod);
								 
								 foreach($sezioni AS $sezione){	
								   echo '<li><span>'.stripslashes($sezione['NOME']).'</span>';
								   $pagine = $GE->getPagineBySezione($sezione['ID']);
								   		echo '<ul>';
								   		foreach($pagine AS $pagina){
											echo '<li><a href="'.$pagina['FILE'].'">'.stripslashes($pagina['NOME']).'</a></li>';
								   		}	
										echo '</ul>';
									echo '</li>';
								 }	
								?>
									<!-- li><a href="#" class="selected">Direct Link 1</a></li>
									<li><a href="#">Direct Link 2</a></li -->
								</ul>
								<!--[if !IE]>end main menu<![endif]-->	
							</div>
						</div>
					</div>
					<!--[if !IE]>end section<![endif]-->