<?php 
$totaleAlberghi = $CF->totaleAttivita(1);
//$totaleContratti = $CTR->totaleContratti(1);
?>
<div class="section" style="display: block">
						<div class="section_inner">
							<div class="title_wrapper">
								<h2>Quick Stats</h2>
							</div>
							<div class="section_content">
								<!--[if !IE]>start stats<![endif]-->
								<div class="stats">
									<!--[if !IE]>start stats odd<![endif]-->
									<div class="stats_odd">
										<dl>
											<dt><?php echo $totaleAlberghi[0]['TOTALE']?> attivit&agrave;</dt>
											<dd>nel sistema</dd>
										</dl>
										<dl>
											<dt><?php echo $totaleContratti[0]['TOTALE']?> contratti</dt>
											<dd>inseriti</dd>
										</dl>
										<!-- dl>
											<dt>18 users</dt>
											<dd>currently online</dd>
										</dl>
										<dl>
											<dt>15.2%</dt>
											<dd>increase in traffic this month</dd>
										</dl -->
									</div>
									<!--[if !IE]>end stats odd<![endif]-->
									<!--[if !IE]>start stats even<![endif]-->
									<div class="stats_even" style="display: none">
										<dl>
											<dt>82 photos</dt>
											<dd>awaiting approval</dd>
										</dl>	
										<dl>
											<dt>13 products</dt>
											<dd>awaiting approval</dd>
										</dl>
										<dl>
											<dt>1 arbitration</dt>
											<dd>in progress</dd>
										</dl>
									</div>
									<!--[if !IE]>end stats even<![endif]-->
								</div>
								<!--[if !IE]>end stats<![endif]-->
							</div>
						</div>
					</div>