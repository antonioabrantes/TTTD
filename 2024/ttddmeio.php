<?php
	session_start();
	require("../../conf_plos.php");
	require("../conf_utils.php");

	/*
		$servername = "localhost";
		$username = "root";
		$password = "";
		$db = "producao";
		$link = mysqli_connect($servername, $username, $password, $db);
		if (!$link) {
		  die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully<BR>";
	*/
		
		// <i class="fa-solid fa-building-columns"></i>
		// <i class="fa-solid fa-graduation-cap"></i>

	if (empty($_REQUEST["grupo_selecionado"])) {$grupo_selecionado='';} else {$grupo_selecionado=$_REQUEST["grupo_selecionado"];}
	if (empty($_REQUEST["assunto_selecionado"])) {$assunto_selecionado='';} else {$assunto_selecionado=$_REQUEST["assunto_selecionado"];}
	if (empty($_REQUEST["grupo_selecionado_antigo"])) {$grupo_selecionado_antigo='';} else {$grupo_selecionado_antigo=$_REQUEST["grupo_selecionado_antigo"];}
	if (empty($_REQUEST["busca"])) {$busca=0;} else {$busca=$_REQUEST["busca"];}
	if (empty($_REQUEST["busca_equiv"])) {$busca_equiv=0;} else {$busca_equiv=$_REQUEST["busca_equiv"];}
	if (empty($_REQUEST["tabela"])) {$tabela=0;} else {$tabela=$_REQUEST["tabela"];}

	$contador_atual = isset($_SESSION['contador_atual']) ? $_SESSION['contador_atual'] : null ;
	if($contador_atual != true){
		$agora = date('Y-m-d H:i:s');
		$ip = get_client_ip();
		$cmd = "INSERT INTO log (id, ip, data, login) VALUES (null, '$ip', '$agora', 'ttdd')";
		$res = mysqli_query($link,$cmd);
		$cmd = "select count(*) as max from log where login='ttdd'";
		$res = mysqli_query($link,$cmd);
		if ($line=@mysqli_fetch_assoc($res)) $contador_atual = $line['max'];
		$_SESSION['contador_atual'] = $contador_atual;
	}
	
?>

<!DOCTYPE html>
<!-- saved from url=(0016)https://ufrj.br/ -->
<html class="js" lang="pt-BR" style=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>TTDD</title>
	<link rel="stylesheet" id="child-style-css" href="./css/style10.css" media="all">
	<link rel="stylesheet" id="contraste-css" href="./css/contraste.css" media="all">

    <!-- Bootstrap CSS -->

	<script src="./js/jquery.min.js.download" id="jquery-core-js"></script>
	<script src="./js/jquery-migrate.min.js.download" id="jquery-migrate-js"></script>
	<script src="./js/index.js.download" id="twentytwenty-js-js" async=""></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	</head>

	<body id="body-anchor" class="home page-template page-template-templates page-template-template-cover page-template-templatestemplate-cover-php page page-id-5 wp-custom-logo wp-embed-responsive singular overlay-header enable-search-modal has-post-thumbnail has-no-pagination not-showing-comments show-avatars template-cover footer-top-visible">


		<header id="site-header" class="header-footer-group1" role="banner">

			<div class="header-inner section-inner">

				<div class="header-navigation-wrapper">
					
				<div class="menu-bottom">
				<ul class="social-menu reset-list-style social-icons fill-children-current-color">
				<!--<li id="menu-item-112" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-112">
					<div>
					  <button class="btncontrast desktop-nav-toggle">
						<i class="fa fa-adjust" aria-hidden="true"></i>
					  </button>
					</div>
				</li>-->
				<li id="menu-item-112" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-112">

					<button class="toggle1" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">

							<!--<a href="ufrj.html" style="color:white;"><span class="toggle-text">Código de Classificação</span></a>-->
							<!--<span class="toggle-icon">
								<IMG SRC="busca.png" TITLE="Código de Classificação">
							</span>-->
							<span class="fa fa-sitemap fa-2x text-warning"></span>

					</button><!-- .nav-toggle -->

				</li>
				<li id="menu-item-112" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-112"><span class="menu-principal"><a rel="noopener" href="ttddmeio.php"><span class="screen-reader-text">Início</span><span class="fa fa-home fa-2x text-warning"></span></a></span></li>
				<!--<li id="menu-item-112" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-112"><span class="menu-principal"><a rel="noopener" href=""><span class="screen-reader-text">Índice Remissivo</span><span class="fa fa-file fa-2x text-warning"></span></a></span></li>-->
				<li id="menu-item-112" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-112"><span class="menu-principal"><a rel="noopener" href="ttddmeio.php#post-inner"><span class="screen-reader-text">Info</span><span class="fa fa-info-circle fa-2x text-warning"></span></a></span></li>
				<li id="menu-item-112" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-112"><span class="menu-principal"><a rel="noopener" href="ttddmeio.php?tabela=1"><span class="screen-reader-text">Tabela Equivalente</span><span class="fa fa-table fa-2x text-warning"></span></a></span></li>
				<li id="menu-item-112" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-112"><span class="menu-principal"><a rel="noopener" href="ttddmeio.php?busca=1"><span class="screen-reader-text">Busca</span><span class="fa fa-search fa-2x text-warning"></span></a></span></li>
				<li id="menu-item-112" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-112"><span class="menu-principal"><a rel="noopener" href="ttddmeio.php?busca_equiv=1"><span class="screen-reader-text">Busca Equivalente</span><span class="fa fa-search-plus fa-2x text-warning"></span></a></span></li>
				</ul>
				</div>
						<!-- ícones https://www.angularjswiki.com/fontawesome/interfaces/ -->

						
				</div><!-- .header-navigation-wrapper -->

			</div><!-- .header-inner -->

		</header><!-- #site-header -->

 

		
<div class="menu-modal cover-modal header-footer-group" data-modal-target-string=".menu-modal">

	<div class="menu-modal-inner modal-inner">

		<div class="menu-wrapper section-inner">

			<div class="menu-top">

				<button class="toggle close-nav-toggle fill-children-current-color" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="true" data-set-focus=".menu-modal">
					<span class="toggle-text">Fechar menu</span>
					<svg class="svg-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><polygon fill="" fill-rule="evenodd" points="6.852 7.649 .399 1.195 1.445 .149 7.899 6.602 14.352 .149 15.399 1.195 8.945 7.649 15.399 14.102 14.352 15.149 7.899 8.695 1.445 15.149 .399 14.102"></polygon></svg>				</button><!-- .nav-toggle -->

				
	<nav class="expanded-menu" aria-label="Expanded" role="navigation">

	<ul class="modal-menu reset-list-style">
	<li id="menu-item-34" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-5 current_page_item menu-item-34"><div class="ancestor-wrapper"><a href="ttddmeio.php" aria-current="page">Página Inicial</a></div><!-- .ancestor-wrapper --></li>

	<?php
		
		$cmd = "select * from ttddnew3 where indice=0";
		$res = mysqli_query($link,$cmd);
		while ($line=@mysqli_fetch_assoc($res))
		{
			$assunto = $line['assunto'];
			$grupo = $line['grupo'];
			if (substr($grupo,0,3)=='080') continue;
			$proximo = $line['proximo'];
			if ($proximo==0)
				echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
			else
			{
				echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
				echo "<ul class='sub-menu'>";
				$cmd2 = "select * from ttddnew3 where indice=$proximo";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$assunto = $line2['assunto'];
					$grupo = $line2['grupo'];
					if (substr($grupo,0,3)=='080') continue;
					$proximo = $line2['proximo'];
					if ($proximo==0)
						echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
					else
					{
						echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
						echo "<ul class='sub-menu'>";
						$cmd3 = "select * from ttddnew3 where indice=$proximo";
						$res3 = mysqli_query($link,$cmd3);
						while ($line3=@mysqli_fetch_assoc($res3))
						{
							$assunto = $line3['assunto'];
							$grupo = $line3['grupo'];
							if (substr($grupo,0,3)=='080') continue;
							$proximo = $line3['proximo'];
							if ($proximo==0)
								echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
							else
							{
								echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
								echo "<ul class='sub-menu'>";
								$cmd4 = "select * from ttddnew3 where indice=$proximo";
								$res4 = mysqli_query($link,$cmd4);
								while ($line4=@mysqli_fetch_assoc($res4))
								{
									$assunto = $line4['assunto'];
									$grupo = $line4['grupo'];
									if (substr($grupo,0,3)=='080') continue;
									$proximo = $line4['proximo'];
									if ($proximo==0)
										echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
									else
									{
										echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
										echo "<ul class='sub-menu'>";
										$cmd5 = "select * from ttddnew3 where indice=$proximo";
										$res5 = mysqli_query($link,$cmd5);
										while ($line5=@mysqli_fetch_assoc($res5))
										{
											$assunto = $line5['assunto'];
											$grupo = $line5['grupo'];
											if (substr($grupo,0,3)=='080') continue;
											$proximo = $line5['proximo'];
											if ($proximo==0)
												echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
											else
											{
												echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
												echo "<ul class='sub-menu'>";
												$cmd6 = "select * from ttddnew3 where indice=$proximo";
												$res6 = mysqli_query($link,$cmd6);
												while ($line6=@mysqli_fetch_assoc($res6))
												{
													$assunto = $line6['assunto'];
													$grupo = $line6['grupo'];
													if (substr($grupo,0,3)=='080') continue;
													$proximo = $line6['proximo'];
													if ($proximo==0)
														echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
													else
													{
														echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
													}
												} 
												echo "</ul>";
											}
										} 
										echo "</ul>";
									}
								} 
								echo "</ul>";
							}
						} 
						echo "</ul>";
					}
				} 
				echo "</ul>";
			}
		}
	?>
					
	<li id="menu-item-2673" class="pll-parent-menu-item menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2673"><div class="ancestor-wrapper"><a href=""><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAn1BMVEUAYQAAWwAAUgAARwAAOgAALgAAIwB/voB4uni242pttG1kr2Rdq11RpFEAGAD9/Uv8/VT690U/mz83lTguki4ADQCp2lJ3d+Q+dfpkaun47zii1B9IoEhgslHOy6fZ5virw/Iubfhsc6v29iMfih+Wy3Nbg+lzm/m61vd+oNr08hZ2uDcAAQCPlLSuraIzmA8yjzKw3z8nXvcTgxM1pTDYD/UeAAAAfUlEQVR4AUWIA3oFMBCE/4mT2nbvf6biQ91n27tjAaDNi7gaFuLAIexiUDc6QKUfhKaVva5Dh/Xu3rwrqYPTzfeYVNvrRvUiUUbvO5hIVR0f8f7TYCo797+6POgOqtm9n8nGQ1qP/395v7cHw4FsQohnXhE3DOSQSETOmN8EHiUfBxs2q7sAAAAASUVORK5CYII=" alt="Português" width="16" height="11" style="width: 16px; height: 11px;"><span style="margin-left:0.3em;">Português</span></a><button class="toggle sub-menu-toggle fill-children-current-color" data-toggle-target=".menu-modal .menu-item-2673 &gt; .sub-menu" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="screen-reader-text">Mostrar submenu</span><svg class="svg-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12"><polygon fill="" fill-rule="evenodd" points="1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358" transform="translate(-1310 -358)"></polygon></svg></button></div><!-- .ancestor-wrapper -->
	<!--<ul class="sub-menu">
		<li id="menu-item-2673-en" class="lang-item lang-item-25 lang-item-en lang-item-first menu-item menu-item-type-custom menu-item-object-custom menu-item-2673-en"><div class="ancestor-wrapper"><a href="" hreflang="en-GB" lang="en-GB"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAt1BMVEWSmb66z+18msdig8La3u+tYX9IaLc7W7BagbmcUW+kqMr/q6n+//+hsNv/lIr/jIGMnNLJyOP9/fyQttT/wb3/////aWn+YWF5kNT0oqz0i4ueqtIZNJjhvt/8gn//WVr/6+rN1+o9RKZwgcMPJpX/VFT9UEn+RUX8Ozv2Ly+FGzdYZrfU1e/8LS/lQkG/mbVUX60AE231hHtcdMb0mp3qYFTFwNu3w9prcqSURGNDaaIUMX5FNW5wYt7AAAAAjklEQVR4AR3HNUJEMQCGwf+L8RR36ajR+1+CEuvRdd8kK9MNAiRQNgJmVDAt1yM6kSzYVJUsPNssAk5N7ZFKjVNFAY4co6TAOI+kyQm+LFUEBEKKzuWUNB7rSH/rSnvOulOGk+QlXTBqMIrfYX4tSe2nP3iRa/KNK7uTmWJ5a9+erZ3d+18od4ytiZdvZyuKWy8o3UpTVAAAAABJRU5ErkJggg==" alt="English" width="16" height="11" style="width: 16px; height: 11px;"><span style="margin-left:0.3em;">English</span></a></div></li>
		<li id="menu-item-2673-es" class="lang-item lang-item-29 lang-item-es menu-item menu-item-type-custom menu-item-object-custom menu-item-2673-es"><div class="ancestor-wrapper"><a href="" hreflang="es-ES" lang="es-ES"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAflBMVEX/AAD9AAD3AADxAADrAAD/eXn9bGz8YWH8WVn6UVH5SEj5Pz/3NDT0Kir9/QD+/nL+/lT18lDt4Uf6+j/39zD39yf19R3n5wDxflXsZ1Pt4Y3x8zr0wbLs1NXz8xPj4wD37t3jmkvsUU/Bz6nrykm3vJ72IiL0FBTyDAvhAABEt4UZAAAAX0lEQVR4AQXBQUrFQBBAwXqTDkYE94Jb73+qfwVRcYxVQRBRToiUfoaVpGTrtdS9SO0Z9FR9lVy/g5c99+dKl30N5uxPuviexXEc9/msC7TOkd4kHu/Dlh4itCJ8AP4B0w4Qwmm7CFQAAAAASUVORK5CYII=" alt="Español" width="16" height="11" style="width: 16px; height: 11px;"><span style="margin-left:0.3em;">Español</span></a></div></li>
		<li id="menu-item-2673-fr" class="lang-item lang-item-33 lang-item-fr menu-item menu-item-type-custom menu-item-object-custom menu-item-2673-fr"><div class="ancestor-wrapper"><a href="" hreflang="fr-FR" lang="fr-FR"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAbFBMVEVzldTg4ODS0tLxDwDtAwDjAADD0uz39/fy8vL3k4nzgna4yOixwuXu7u7s6+zn5+fyd2rvcGPtZljYAABrjNCpvOHrWkxegsqfs93NAADpUUFRd8THAABBa7wnVbERRKa8vLyxsLCoqKigoKClCvcsAAAAXklEQVR4AS3JxUEAQQAEwZo13Mk/R9w5/7UERJCIGIgj5qfRJZEpPyNfCgJTjMR1eRRnJiExFJz5Mf1PokWr/UztIjRGQ3V486u0HO55m634U6dMcf0RNPfkVCTvKjO16xHA8miowAAAAABJRU5ErkJggg==" alt="Français" width="16" height="11" style="width: 16px; height: 11px;"><span style="margin-left:0.3em;">Français</span></a></div></li>
	</ul>-->
	</li>
</ul>
</nav>

					
					<nav class="mobile-menu" aria-label="Mobile" role="navigation">

						<ul class="modal-menu reset-list-style">

						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-5 current_page_item menu-item-34"><div class="ancestor-wrapper"><a href="ttddmeio.php" aria-current="page">Página Inicial</a></div><!-- .ancestor-wrapper --></li>
	<?php
		
		$cmd = "select * from ttddnew3 where indice=0";
		$res = mysqli_query($link,$cmd);
		while ($line=@mysqli_fetch_assoc($res))
		{
			$assunto = $line['assunto'];
			$grupo = $line['grupo'];
			if (substr($grupo,0,3)=='080') continue;
			$proximo = $line['proximo'];
			if ($proximo==0)
				echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
			else
			{
				echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
				echo "<ul class='sub-menu'>";
				$cmd2 = "select * from ttddnew3 where indice=$proximo";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$assunto = $line2['assunto'];
					$grupo = $line2['grupo'];
					if (substr($grupo,0,3)=='080') continue;
					$proximo = $line2['proximo'];
					if ($proximo==0)
						echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
					else
					{
						echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
						echo "<ul class='sub-menu'>";
						$cmd3 = "select * from ttddnew3 where indice=$proximo";
						$res3 = mysqli_query($link,$cmd3);
						while ($line3=@mysqli_fetch_assoc($res3))
						{
							$assunto = $line3['assunto'];
							$grupo = $line3['grupo'];
							if (substr($grupo,0,3)=='080') continue;
							$proximo = $line3['proximo'];
							if ($proximo==0)
								echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
							else
							{
								echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
								echo "<ul class='sub-menu'>";
								$cmd4 = "select * from ttddnew3 where indice=$proximo";
								$res4 = mysqli_query($link,$cmd4);
								while ($line4=@mysqli_fetch_assoc($res4))
								{
									$assunto = $line4['assunto'];
									$grupo = $line4['grupo'];
									if (substr($grupo,0,3)=='080') continue;
									$proximo = $line4['proximo'];
									if ($proximo==0)
										echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
									else
									{
										echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
										echo "<ul class='sub-menu'>";
										$cmd5 = "select * from ttddnew3 where indice=$proximo";
										$res5 = mysqli_query($link,$cmd5);
										while ($line5=@mysqli_fetch_assoc($res5))
										{
											$assunto = $line5['assunto'];
											$grupo = $line5['grupo'];
											if (substr($grupo,0,3)=='080') continue;
											$proximo = $line5['proximo'];
											if ($proximo==0)
												echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
											else
											{
												echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
												echo "<ul class='sub-menu'>";
												$cmd6 = "select * from ttddnew3 where indice=$proximo";
												$res6 = mysqli_query($link,$cmd6);
												while ($line6=@mysqli_fetch_assoc($res6))
												{
													$assunto = $line6['assunto'];
													$grupo = $line6['grupo'];
													if (substr($grupo,0,3)=='080') continue;
													$proximo = $line6['proximo'];
													if ($proximo==0)
														echo "<li id='menu-item-2001' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-2001'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a></div></li>";
													else
													{
														echo "<li id='menu-item-33' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-33'><div class='ancestor-wrapper'><a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo - $assunto</a><button class='toggle sub-menu-toggle fill-children-current-color' data-toggle-target='.menu-modal .menu-item-33 &gt; .sub-menu' data-toggle-type='slidetoggle' data-toggle-duration='250' aria-expanded='false'><span class='screen-reader-text'>Mostrar submenu</span><svg class='svg-icon' aria-hidden='true' role='img' focusable='false' xmlns='http://www.w3.org/2000/svg' width='20' height='12' viewBox='0 0 20 12'><polygon fill='' fill-rule='evenodd' points='1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358' transform='translate(-1310 -358)'></polygon></svg></button></div>";
													}
												} 
												echo "</ul>";
											}
										} 
										echo "</ul>";
									}
								} 
								echo "</ul>";
							}
						} 
						echo "</ul>";
					}
				} 
				echo "</ul>";
			}
		}
	?>
					
	<li id="menu-item-2673" class="pll-parent-menu-item menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2673"><div class="ancestor-wrapper"><a href=""><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAn1BMVEUAYQAAWwAAUgAARwAAOgAALgAAIwB/voB4uni242pttG1kr2Rdq11RpFEAGAD9/Uv8/VT690U/mz83lTguki4ADQCp2lJ3d+Q+dfpkaun47zii1B9IoEhgslHOy6fZ5virw/Iubfhsc6v29iMfih+Wy3Nbg+lzm/m61vd+oNr08hZ2uDcAAQCPlLSuraIzmA8yjzKw3z8nXvcTgxM1pTDYD/UeAAAAfUlEQVR4AUWIA3oFMBCE/4mT2nbvf6biQ91n27tjAaDNi7gaFuLAIexiUDc6QKUfhKaVva5Dh/Xu3rwrqYPTzfeYVNvrRvUiUUbvO5hIVR0f8f7TYCo797+6POgOqtm9n8nGQ1qP/395v7cHw4FsQohnXhE3DOSQSETOmN8EHiUfBxs2q7sAAAAASUVORK5CYII=" alt="Português" width="16" height="11" style="width: 16px; height: 11px;"><span style="margin-left:0.3em;">Português</span></a><button class="toggle sub-menu-toggle fill-children-current-color" data-toggle-target=".menu-modal .menu-item-2673 &gt; .sub-menu" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="screen-reader-text">Mostrar submenu</span><svg class="svg-icon" aria-hidden="true" role="img" focusable="false" xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12"><polygon fill="" fill-rule="evenodd" points="1319.899 365.778 1327.678 358 1329.799 360.121 1319.899 370.021 1310 360.121 1312.121 358" transform="translate(-1310 -358)"></polygon></svg></button></div><!-- .ancestor-wrapper -->
	<!--<ul class="sub-menu">
		<li id="menu-item-2673-en" class="lang-item lang-item-25 lang-item-en lang-item-first menu-item menu-item-type-custom menu-item-object-custom menu-item-2673-en"><div class="ancestor-wrapper"><a href="" hreflang="en-GB" lang="en-GB"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAt1BMVEWSmb66z+18msdig8La3u+tYX9IaLc7W7BagbmcUW+kqMr/q6n+//+hsNv/lIr/jIGMnNLJyOP9/fyQttT/wb3/////aWn+YWF5kNT0oqz0i4ueqtIZNJjhvt/8gn//WVr/6+rN1+o9RKZwgcMPJpX/VFT9UEn+RUX8Ozv2Ly+FGzdYZrfU1e/8LS/lQkG/mbVUX60AE231hHtcdMb0mp3qYFTFwNu3w9prcqSURGNDaaIUMX5FNW5wYt7AAAAAjklEQVR4AR3HNUJEMQCGwf+L8RR36ajR+1+CEuvRdd8kK9MNAiRQNgJmVDAt1yM6kSzYVJUsPNssAk5N7ZFKjVNFAY4co6TAOI+kyQm+LFUEBEKKzuWUNB7rSH/rSnvOulOGk+QlXTBqMIrfYX4tSe2nP3iRa/KNK7uTmWJ5a9+erZ3d+18od4ytiZdvZyuKWy8o3UpTVAAAAABJRU5ErkJggg==" alt="English" width="16" height="11" style="width: 16px; height: 11px;"><span style="margin-left:0.3em;">English</span></a></div></li>
		<li id="menu-item-2673-es" class="lang-item lang-item-29 lang-item-es menu-item menu-item-type-custom menu-item-object-custom menu-item-2673-es"><div class="ancestor-wrapper"><a href="" hreflang="es-ES" lang="es-ES"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAflBMVEX/AAD9AAD3AADxAADrAAD/eXn9bGz8YWH8WVn6UVH5SEj5Pz/3NDT0Kir9/QD+/nL+/lT18lDt4Uf6+j/39zD39yf19R3n5wDxflXsZ1Pt4Y3x8zr0wbLs1NXz8xPj4wD37t3jmkvsUU/Bz6nrykm3vJ72IiL0FBTyDAvhAABEt4UZAAAAX0lEQVR4AQXBQUrFQBBAwXqTDkYE94Jb73+qfwVRcYxVQRBRToiUfoaVpGTrtdS9SO0Z9FR9lVy/g5c99+dKl30N5uxPuviexXEc9/msC7TOkd4kHu/Dlh4itCJ8AP4B0w4Qwmm7CFQAAAAASUVORK5CYII=" alt="Español" width="16" height="11" style="width: 16px; height: 11px;"><span style="margin-left:0.3em;">Español</span></a></div></li>
		<li id="menu-item-2673-fr" class="lang-item lang-item-33 lang-item-fr menu-item menu-item-type-custom menu-item-object-custom menu-item-2673-fr"><div class="ancestor-wrapper"><a href="" hreflang="fr-FR" lang="fr-FR"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAbFBMVEVzldTg4ODS0tLxDwDtAwDjAADD0uz39/fy8vL3k4nzgna4yOixwuXu7u7s6+zn5+fyd2rvcGPtZljYAABrjNCpvOHrWkxegsqfs93NAADpUUFRd8THAABBa7wnVbERRKa8vLyxsLCoqKigoKClCvcsAAAAXklEQVR4AS3JxUEAQQAEwZo13Mk/R9w5/7UERJCIGIgj5qfRJZEpPyNfCgJTjMR1eRRnJiExFJz5Mf1PokWr/UztIjRGQ3V486u0HO55m634U6dMcf0RNPfkVCTvKjO16xHA8miowAAAAABJRU5ErkJggg==" alt="Français" width="16" height="11" style="width: 16px; height: 11px;"><span style="margin-left:0.3em;">Français</span></a></div></li>
	</ul>-->
	</li>
</ul>
</nav>

					
			</div><!-- .menu-top -->

			</div><!-- .menu-wrapper -->

	</div><!-- .menu-modal-inner -->

</div><!-- .menu-modal -->

<main id="site-content" role="main">
<article class="post-5 page type-page status-publish has-post-thumbnail hentry" id="post-5">

	<center>
	<?php if ($busca==0 and $tabela==0 and $busca_equiv==0) { ?>
	<div class="cover-header-inner-wrapper screen-height">
	<span class='rest-post-principal-item-categoria' style="color: rgba(75, 112, 115, 80);"><h1>TTDD Meio</h1></span>
	<span class='rest-post-principal-item-categoria' style="color: rgba(0, 172, 175, 80);">Código de classificação e tabela de temporalidade e <BR>destinação de documentos relativos às atividades-meio do Poder Executivo Federal </span>
	<BR><a href='Tabela.pdf' target='_blank'><span class="fa fa-file-pdf fa-4x text-warning"></span></a>
	</div>
	<?php } ?>
	
	<div class="post-inner" id="post-inner" style="width: 75%">
	<?php
	    // http://localhost/ttdd/ttddmeio.php?grupo_selecionado=002.12#post-inner 
		if ($grupo_selecionado_antigo<>'')
		{
			$i = 0;
			$cmd = "select * from ttddnew2 where symbol1='$grupo_selecionado_antigo'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))	
			{
				$assunto1 = $line['assunto1'];
				$symbol2 = $line['symbol2'];
				$assunto2 = $line['assunto2'];
				if ($i==0)
				{
					echo "<HR><h1 id='grupo1'>Código antigo: $grupo_selecionado_antigo</h1>";
					echo "<h2 id='assunto1'>$assunto1</h2><BR>";
				}
				echo "<HR><h1 id='grupo1'>Código novo: <a href='ttddmeio.php?grupo_selecionado=$symbol2#post-inner'>$symbol2</a></h1>";
				echo "<h2 id='assunto1'>$assunto2</h2><BR>";
				$i++;
			}
		}

		if ($assunto_selecionado<>'')
		{
			echo "<h1 id='grupo1'>Resultado da busca pelo termo '$assunto_selecionado':</h1>";
			$cmd = "select * from ttddnew3 where assunto like '%$assunto_selecionado%'";
			$res = mysqli_query($link,$cmd);
			$i = 0;
			while ($line=@mysqli_fetch_assoc($res))	
			{
				$i++;
				$grupo = $line['grupo'];
				$assunto = $line['assunto'];
				echo "<HR><h1 id='grupo1'>Código: <a href='ttddmeio.php?grupo_selecionado=$grupo#post-inner'>$grupo</a></h1>";
				echo "<h2 id='assunto1'>$assunto</h2><BR>";
			}
			if ($i==0) echo "<h2 id='assunto1'>Não houve resultados</h2><BR>";
		}
		
		if ($grupo_selecionado<>"")
		{
			$assunto='';$fase_corrente="-";$fase_intermediaria="-";$destinacao="-";$observacoes="";$nota_explicativa="";
			$cmd = "select * from ttddnew3 where grupo='$grupo_selecionado'";
			$res = mysqli_query($link,$cmd);
			if ($line=@mysqli_fetch_assoc($res))
			{
				$assunto = $line['assunto'];
				$fase_corrente = $line['fase_corrente'];
				$fase_intermediaria = $line['fase_intermediaria'];
				$destinacao = $line['destinacao'];
				$observacoes = $line['observacoes'];
				$cmd = "select * from ttddnew1 where symbol='$grupo_selecionado'"; 
				$res = mysqli_query($link,$cmd);
				if ($line=@mysqli_fetch_assoc($res)) $nota_explicativa = $line['observacoes'];
				if ($fase_corrente=="-" and $fase_intermediaria=="-" and $destinacao=="-" and $observacoes=="")
				{
					echo "<h1 id='grupo1'>$grupo_selecionado</h1>";
					echo "<h1 id='assunto1'>$assunto</h1>";
					echo "<h2 id='fase_corrente1'>Não há dados de temporalidade</h2>";
					if ($nota_explicativa<>'') echo "<h4 id='nota_explicativa1'>Nota Explicativa: $nota_explicativa</h4>";
				}
				else
				{

					echo "<h1 id='grupo1'>$grupo_selecionado</h1>";
					echo "<h1 id='assunto1'>$assunto</h1>";
					echo "<h2 id='fase_corrente1'>Fase corrente: $fase_corrente</h2>";
					echo "<h2 id='fase_intermediaria1'>Fase Intermediária: $fase_intermediaria</h2>";
					echo "<h2 id='destinacao1'>Destinação: $destinacao</h2>";
					if ($observacoes<>'') echo "<h3 id='observacoes1'>Observações: $observacoes</h3>";
					if ($nota_explicativa<>'') echo "<h4 id='nota_explicativa1'>Nota Explicativa: $nota_explicativa</h4>";
				}
			}
			else
			{
				echo "<h1 id='grupo1'>$grupo_selecionado</h1>";
				echo "<h1 id='assunto1'>Grupo inexistente</h1>";
			}
		}
		else
		{
			if ($busca==0 and $tabela==0 and $busca_equiv==0 and $grupo_selecionado_antigo=='' and $assunto_selecionado=='')
			{
				echo "<h3>Guia do Usuário:</h3>
				<h4><IMG SRC='imagens/info.png' width=30 style='float:left'> Nessa página web são disponibilizados Instrumentos Técnicos de Gestão de Documentos Relativos às Atividades Meio do Executivo Federal. 
				É possível realizar a navegação pelo esquema de classificação dos documentos e acessar vários recursos de busca. <BR><BR>
				
				<IMG SRC='imagens/home.png' width=30 style='float:left'>Para visualizar a tela de entrada com as funções selecione 
				a função Casa que aparece no menu superior. <BR><BR>
				
				<IMG SRC='imagens/codigo.png' width=30 style='float:left'>O primeiro item da tela de entrada permite navegar pelo Código de Classificação. Você pode navegar 
				pelas classes, subclasses, grupos e subgrupos.<BR><BR>
				
				Para ver a temporalidade da opção desejada basta clicar no grupo selecionado para visualizar as informações de temporalidade. 
				Na tela de temporalidade o usuário dispõe na mesma tela das Notas Explicativa respectiva daquele código.<BR><BR>
				
				<IMG SRC='imagens/lupa.png' width=30 style='float:left'> Escolha a lupa do menu principal para procurar por uma classificação ou por uma palavra específica no campo Assunto da tabela 
				de temporalidade.<BR><BR>

				<IMG SRC='imagens/lupamais.png' width=30 style='float:left'>Na busca de equivalência na tela principal você pode realizar uma busca por código na tabela atual (Portaria n° 174/2024 
				do Arquivo Nacional) partindo do código antigo segundo a Resolução n° 14/2001 do Conara (revogada). <BR><BR>
				
				A Portaria AN/MGI Nº 174, de 23 de setembro de 2024 dispõe sobre a atualização do Código de Classificação e Tabela de Temporalidade e Destinação de Documentos de arquivo, 
				relativos às atividades-meio/suporte do Poder Executivo Federal. <BR><BR>
				
				<IMG SRC='imagens/equivalencia.png' width=30 style='float:left'>Na tela de entrada você dispõe de acesso a tabela de equivalência 
				completa onde ao clicar num código selecionado você será levado para a tela que mostra o código novo.</h4>"; 
				
				// 	<IMG SRC='imagens/remissivo.png' width=30 style='float:left'>Para visualização do índice remissivo basta selecionar a respectiva opção no menu superior. No índice remissivo sempre que uma palavra 
				//chave tiver a indicação à direita de uma classificação, ao clicar nesta opção você será levado à classificação selecionada. 
				//Caso não haja nenhuma classificação à direita após um tracejado, então você ao clicar nesta opção, deve ser levado ao próximo nível da 
				//hierarquia.<BR><BR>
			}
		}
		
	?>
	</div>
	
	<div id="post-inner2" style="width: 50%">
	<?php
		if ($busca==1)
		{
	?>
			<h3>Digite o código documental, por ex: 020.11</h3>
			<form class="form-inline" action="ttddmeio.php#post-inner" method="post">
				<input class="form-control mr-2" type="text" placeholder="Digite o código" name="grupo_selecionado">
				<input  class="btn btn-primary" type="submit" value="Buscar">
			</form>		
			
			<h3>Pesquisar palavra na tabela, por ex: Compra</h3>
			<form class="form-inline" action="ttddmeio.php#post-inner" method="post">
				<input class="form-control mr-2" type="text" placeholder="Digite a palavra" name="assunto_selecionado">
				<input  class="btn btn-primary" type="submit" value="Buscar palavra">
			</form>	
	<?php
		}
	?>
	</div>
	
	<div id="post-inner4" style="width: 50%">
	<?php
		if ($busca_equiv==1)
		{
	?>
			<h3>Digite o código documental antigo (Resolução nº 14/2001 do Conarq), por. ex: 010.3, e pressione o botão para obter o código atual
			<form class="form-inline" action="ttddmeio.php#post-inner" method="post">
				<input class="form-control mr-2" type="text" placeholder="Digite o código" name="grupo_selecionado_antigo">
				<input  class="btn btn-primary" type="submit" value="Buscar">
			</form>		
	<?php
		}
	?>
	</div>
	
	<div id="post-inner3" style="width: 100%;">
	<?php
		if ($tabela==1)
		{
	?>
			<h1>Tabela de Equivalência</h1>
			<h3>Resolução n. 14, de 24 de outubro de 2001, do Conarq (revogada) versus 
			Código de classificação de documentos relativos às atividades-meio do Poder Executivo Federal Portaria n. 174/2024, do AN.</h3>
			<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
				  <th>Código</th>
				  <th>Descritor</th>
				  <th>Código</th>
				  <th>Descritor</th>
				</tr>
			</thead>
       
			<tbody>
			<?php
				$cmd = "select * from ttddnew2";
				$res = mysqli_query($link,$cmd);
				while ($line=@mysqli_fetch_assoc($res))
				{
					$symbol1 = $line['symbol1'];
					$assunto1 = $line['assunto1'];
					$symbol2 = $line['symbol2'];
					$assunto2 = $line['assunto2'];
					echo "<TR onClick=".'"window.location.href='."'ttddmeio.php?grupo_selecionado=$symbol2#post-inner';".'"'."><TD style='font-size: 10px;'>$symbol1</TD><TD style='font-size: 10px;'>$assunto1</TD><TD style='font-size: 10px;'>$symbol2</TD><TD style='font-size: 10px;'>$assunto2</TD></TR>";
				}
			?>
			</tbody>
			</table>
	<?php
		}
	?>
	</div>
		
	</center>
	
	<!--
	<div class="cover-header  bg-image" style="background-image: url( https://cientistaspatentes.com.br/ttdd/imagens/ttdd1.png );">
		<div class="cover-header-inner-wrapper screen-height">
			<div class="cover-header-inner">
				<div class="cover-color-overlay color-accent opacity-80"></div>
				<header class="entry-header has-text-align-center">
					<div class="entry-header-inner section-inner medium">
						<p><img src="imagens/ttdd.png" width=400></p>
						<p>Tabelas de Temporalidade e Destinação de Documentos</p>
						<h1 class="entry-title">TTDD </h1>
					</div>
				</header>
			</div>
		</div>
	</div> -->
	
	<!--
	<div class="post-inner" id="post-inner">
		<div class="entry-content">
		<div class='wp-block-columns alignwide rest-post-principal-bloco'>
		<div class='wp-block-column rest-post-principal-item'>
		<span class='rest-post-principal-item-categoria' style="color: rgba(0, 172, 175, 80);">Código de Classificação</span>
		<h2 class='rest-post-principal-item-titulo'>Tabela de Temporalidade e Destinação de Documentos</h2>
		</div>
	</div> -->

	
</article><!-- .post -->

</main><!-- #site-content -->


	<div class="footer-nav-widgets-wrapper header-footer-group">


	</div><!-- .footer-nav-widgets-wrapper -->


			<footer id="site-footer" role="contentinfo" class="header-footer-group">

				<div class="section-inner">
					<div class="top-footer-wrapper">
						<div class="footer-left">
							<div class="img-wrapper">
								<a href="">	</a>
							</div>
							<p>
								Rio de Janeiro, RJ <br>
								<?php echo "<font size=1>Acessos: $contador_atual</font>";?>
							</p>
						</div>

						<div class="footer-right">
							<p>Desenvolvido por: </p>
							<div class="footer-logos-bottom">
								<div class="img-wrapper">
									Antonio Carlos Souza de Abrantes <BR> Paula Cotrim de Abrantes (contatottdd@gmail.com)
								</div>
							</div>
							
						</div>
					</div>
					
				</div>

				<div class="section-inner">

					<div class="footer-credits">

						<p class="footer-copyright">&copy;
							2022							<a href="">Todos os direitos reservados</a>
						</p><!-- .footer-copyright -->

					</div><!-- .footer-credits -->

					<a class="to-the-top" href="#body-anchor">
						<span class="to-the-top-long">
							Ir para o topo <span class="arrow" aria-hidden="true">&uarr;</span>						</span><!-- .to-the-top-long -->
						<span class="to-the-top-short">
							Subir <span class="arrow" aria-hidden="true">&uarr;</span>						</span><!-- .to-the-top-short -->
					</a><!-- .to-the-top -->

				</div><!-- .section-inner -->

			</footer><!-- #site-footer -->

<script src="./js/index.js(1).download" id="contact-form-7-js"></script>
<script src="./js/socialmedia.js.download" id="socialmediascript-js"></script>
<script src="./js/acessibility.js.download" id="acessibity-js"></script>
<script src="./js/toogle-menu.js.download" id="toogle-menu-js"></script>

</body></html>