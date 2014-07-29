	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
		<!--[if !IE]>start head<![endif]-->
		<div id="head">
			<!--[if !IE]>start logo and user details<![endif]-->
			<div id="logo_user_details">
				<h1 id="logo"><a href="index.php" title="Home page Area riservata"><strong><?php echo $SETTING->nome_dominio?></strong> - <span style="font-size: 16px; color: <?php echo $SETTING->colore?>"><?php echo $SETTING->titolo_reserved_area?></span></a></h1>
				<div id="user_details">
					<!-- ul id="user_events">
						<li><a href="#">4 new events</a></li>
					</ul -->
					<ul id="user_loged">
						<li>Accesso come : <strong><?php echo $_SESSION['user']?> [ <span style="font-weight: normal"><?php echo $_SESSION['nomeType']?></span> ]</strong></li>
						<li class="last"><a href="../tool.php?logout=1">Log out</a></li>
					</ul>
				</div>
			</div>
			<!--[if !IE]>end logo and user details<![endif]-->
		</div>
		<!--[if !IE]>end head<![endif]-->
