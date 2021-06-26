
<HTML><HEAD><TITLE>TTDD</TITLE>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</HEAD>

<BODY bgcolor=#fdf1e3 leftMargin=20 marginheight="0" marginwidth="0" >

    <BR>
    <TABLE>
        <TR><TD colspan=2><B>1) Geracao de Notas explicativas: codclass.xml </B></TD></TR>
        <TR><TD width=50></TD><TD>Crie tabela ttddnew1</TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=1'>Ler notas explicativas codclass.csv e carrega dados na tabela ttddnew1</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=13'>Ler dados na tabela ttddnew1 e gerar codclass.xml</a></TD></TR>
    </TABLE>

    <BR>    
    <TABLE>
        <TR><TD colspan=2><B>2) Geracao de Tabela de Equivalencia: codequi.htm e codequi.xml </B></TD></TR>
        <TR><TD width=50></TD><TD>Crie tabela ttddnew2</TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=2'>Ler tabela de equivalencia codequi.csv e carrega dados na tabela ttddnew2</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=3'>Ler dados na tabela ttddnew2 e gerar codequi.htm</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=14'>Ler dados na tabela ttddnew2 e gerar codequi.xml</a></TD></TR>
    </TABLE>

    <BR>
    <TABLE>
        <TR><TD colspan=2><B>3) Geracao de Notas Explicativas: onosmatico.xml </B></TD></TR>
        <TR><TD width=50></TD><TD>Crie tabela ttddnew4</TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=10'>Ler notas explicativas onosmaequi.csv e carrega dados na tabela ttddnew4</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=11'>Gera os indices em ttddnew4</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=12'>Ler dados na tabela ttddnew4 e gerar onosmatico.xml (versao Android)</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=109'>Ler dados na tabela ttddnew4 e gerar onosmatico2.xml (versao ios)</a></TD></TR>
        <TR><TD width=50></TD><TD>Ajuste onosmatico.java private String[] descricao</TD></TR>
    </TABLE>

    <BR>
    <TABLE>
        <TR><TD colspan=2><B>4) Geracao de Esquema de Classificacao: kind.xml e kinds.xml </B></TD></TR>
        <TR><TD width=50></TD><TD>Crie tabela ttddnew3</TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=4'>Ler esquema de codesche.csv e carrega dados na tabela ttddnew3</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=5'>Testa se os campos de symbol das tabelas ttddnew2 e ttdnew3 numerico pois as vezes o OCR le zero como letra O</TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=6'>Atualiza campo symbol com novo simbolo que reflete hierarquia</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=7&section=0&start=1'>Calcule indice e proximo para cada secao. Voce deve ajustar ver indice final e ajuste para depois ttdd.php?action=110&op=7&section=1&start=final </a></TD></TR>    
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=8&section=0'>Ler ttddnew3 e gera kindS.xml p/ android (subclasses)</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=8&section=1'>Ler ttddnew3 e gera kind.xml p/ android (todos grupos)</a></TD>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=8&section=2'>Ler ttddnew3 e gera kindSios.xml p/ ios (subclasses)</a></TD></TR>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=8&section=3'>Ler ttddnew3 e gera kindios.xml p/ ios (todos grupos)</a></TD>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=9&section=1'>Ler ttddnew3 e gera lista para array simbolosValidos em Pesquisa.java</a></TD>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=9&section=2'>Ler ttddnew3 e gera lista symbol1 para PesquisaEquiv.java</a></TD>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=9&section=3'>Ler ttddnew3 e gera lista symbol2 para PesquisaEquiv.java</a></TD>
        <TR><TD width=50></TD><TD><a href='ttdd.php?action=110&op=9&section=4'>Ler ttddnew3 e gera lista segundo numeração interna do aplicativo</a></TD>
    </TABLE>
        
<?php

    if (empty($_REQUEST["section"])) {$section=0;} else {$section=$_REQUEST["section"];}
    if (empty($_REQUEST["start"])) {$start=1;} else {$start=$_REQUEST["start"];}
	if (empty($_REQUEST["op"])) {$op=1;} else {$op=$_REQUEST["op"];}
	if (empty($_REQUEST["action"])) {$action=0;} else {$action=$_REQUEST["action"];}

    $link = mysqli_connect("localhost","root","","producao");
    
	if ($action==110)
	{
/****
http://siga.arquivonacional.gov.br/images/codigos_tabelas/Portaria_47_CCD_TTD_poder_executivo_federal_2020_instrumento.pdf
preparação do XML com o trechos explicativos:
1) acertar o TXT
2) renomear para codclass.CSV
3) detectar algum ; faltante visualizando o CSV no Excel
4) criar tabela ttddnew1 http://localhost/ttdd.php?action=110&op=1
5) criar codclass.XML http://localhost/ttdd.php?action=110&op=13

preparação do XML com o tabela de equivalência:
1) acertar o TXT
2) renomear para codequi.CSV
3) detectar algum ; faltante visualizando o CSV no Excel
4) criar tabela ttddnew2 http://localhost/ttdd.php?action=110&op=2
5) cria html com tabela de equivalência: http://localhost/ttdd.php?action=110&op=3
6) criar codequi.XML http://localhost/ttdd.php?action=110&op=14

preparação do XML do esquema:
1) acertar o TXT
2) renomear para codsche.CSV
3) detectar algum ; faltante visualizando o CSV no Excel
4) criar tabela ttddnew3 http://localhost/ttdd.php?action=110&op=4
5) testa se os campos de symbol da tabela ttddnew2 e ttdnew3 é numérico: http://localhost/ttdd.php?action=110&op=5
6) renomear symbol para grupo e criar campo symbol,CHAR 255
7) atualiza campo symbol com novo simbolo que reflete hierarquia: http://localhost/ttdd.php?action=110&op=6
8) criar campos INT indice e proximo
9) http://localhost/ttdd.php?action=110&op=7 para cada secao (ajustar manualmente com secao=0 veja qual o indice max e ajuste para depois secao=1)
10) temos que gerar dois xml: kind.xml com todos grupos, e kindS.xml somente com as subclasses http://localhost/ttdd.php?action=110&op=8
11) gerar lista de simbolos validos de ttdnew3 e gravar no array simbolosValidos em Pesquisa.java http://localhost/ttdd.php?action=110&op=9
"000","000","001","002","002","002.01","002.1","002.11","002.12","002.2","003","003","003.01","003.1","003.2","003.3","004","004.1","004.11","004.12","004.2","004.21","004.22","005","005.1","005.2","010","010","010.01","011","012","013","013.1","013.2","014","014.1","014.2","014.3","014.4","015","015.1","015.2","015.3","015.31","015.32","015.33","016","016.1","016.2","016.3","016.4","016.5","017","017.1","017.2","018","019","019.1","019.11","019.111","019.112","019.113","019.12","019.2","020","020","020","020.01","020.02","020.021","020.022","020.03","020.031","020.032","020.033","020.1","020.11","020.12","020.13","020.14","020.2","021","021.1","021.2","021.3","021.4","021.5","022","022.1","022.2","022.21","022.22","022.3","022.4","022.5","022.6","022.61","022.62","022.63","022.7","023","023.1","023.11","023.12","023.13","023.14","023.15","023.151","023.152","023.153","023.154","023.155","023.156","023.157","023.16","023.161","023.162","023.163","023.164","023.165","023.166","023.167","023.17","023.171","023.172","023.173","023.174","023.175","023.18","023.181","023.182","023.183","023.184","023.185","023.186","023.19","023.191","023.2","023.3","023.4","023.5","023.6","023.7","023.71","023.72","023.73","023.9","023.91","023.92","023.93","024","024","024.01","024.1","024.11","024.12","024.13","024.2","024.3","024.31","024.32","024.33","024.4","024.5","024.51","024.52","025","025.1","025.11","025.12","025.13","025.14","025.2","025.21","025.22","025.3","025.31","025.311","025.312","025.32","026","026","026.01","026.02","026.1","026.2","026.3","026.4","026.5","026.51","026.52","026.53","026.54","026.6","026.61","026.62","026.9","026.91","027","027.1","027.2","027.3","028","028.1","028.11","028.12","028.2","028.21","028.22","028.23","029","029.1","029.11","029.12","029.2","029.21","029.22","029.23","029.24","029.3","029.4","029.5","029.6","030","030","030.01","030.02","030.03","031","031.1","031.11","031.12","031.2","031.21","031.22","031.3","031.31","031.32","031.4","031.41","031.42","031.5","032","032","032.01","032.1","032.2","032.3","032.4","033","033.1","033.11","033.12","033.2","033.21","033.22","033.3","033.31","033.32","033.4","033.41","033.42","033.5","033.51","033.52","033.6","034","035","036","036","036.01","036.1","036.2","039","039.1","039.11","039.12","039.2","040","040","040.01","041","041.1","041.11","041.12","041.13","041.2","041.21","041.22","041.23","041.3","041.31","041.32","041.4","041.5","041.51","041.52","041.53","041.6","041.61","041.62","042","042.1","042.11","042.12","042.13","042.2","042.21","042.22","042.23","042.3","042.31","042.32","042.4","042.5","042.51","042.52","042.53","042.6","042.7","042.71","042.72","043","043.1","043.2","043.3","043.4","043.5","043.6","043.61","043.62","043.7","044","044.1","044.2","044.3","044.4","044.5","044.6","045","045","045.01","045.1","045.11","045.12","045.13","045.2","045.21","045.22","045.23","045.24","045.3","045.31","045.32","045.33","045.4","045.5","045.6","045.7","046","046.1","046.11","046.12","046.13","046.2","046.3","046.4","047","047","047.01","047.1","047.2","047.3","049","049.1","049.11","049.12","050","050","050.01","050.02","050.03","051","051.1","051.2","051.3","051.4","052","052.1","052.2","052.21","052.211","052.212","052.213","052.22","052.221","052.222","052.23","052.24","052.25","052.251","052.252","053","053","053.01","053.1","053.2","053.3","053.4","054","054.1","054.2","059","059.1","059.2","059.3","059.4","059.5","060","060","060.01","061","061","061.01","061.011","061.012","061.1","061.2","061.3","061.4","061.5","061.51","061.52","061.521","061.522","061.523","062","062.1","062.11","062.12","062.13","062.2","062.21","062.22","062.3","062.4","062.41","062.42","063","063.1","063.2","063.3","064","064","064.01","064.1","064.2","064.3","064.31","064.32","064.4","065","065.1","065.2","065.3","066","066.1","066.2","066.3","066.31","066.32","066.4","066.41","066.42","066.9","066.91","067","069","069.1","069.11","069.12","069.2","069.3","070","070","070.01","071","071.1","071.2","071.3","071.4","071.5","072","073","073.1","073.2","073.3","073.31","073.32","073.33","073.4","080","080.1","080.2","080.21","080.21","080.21","080.21","080.21","080.22","080.3","080.3","080.3","081","081.1","081.1","081.1","081.2","081.2","081.3","081.3","081.4","081.4","081.5","081.5","081.9","082","082.1","082.1","082.2","082.21","082.31","082.22","082.22","082.23","082.23","082.24","082.24","082.3","082.3","082.4","082.4","082.5","082.51","082.51","082.52","082.52","082.53","082.53","082.54","082.54","082.55","082.55","082.6","082.6","082.7","082.7","082.9","083","083","083.1","083.11","083.11","083.12","083.12","083.13","083.13","083.14","083.14","083.2","083.2","083.3","083.3","083.3","083.9","083.9","084","084.1","084.1","084.2","084.2","084.3","084.31","084.31","084.32","084.32","085","085.1","085.1","085.1","085.2","085.2","085.3","085.3","085.4","085.4","085.5","085.5","085.6","085.61","085.61","085.611","085.611","085.612","085.612","085.619","085.619","085.62","085.62","085.621","085.621","085.629","085.629","085.63","085.631","085.631","085.632","085.632","086","086.1","086.11","086.111","086.111","086.112","086.112","086.12","086.121","086.121","086.122","086.122","086.13","086.13","086.14","086.14","086.2","086.21","086.211","086.211","086.212","086.212","086.213","086.213","087","087.1","087.11","087.11","087.11","087.12","087.12","087.2","087.2","087.3","087.3","087.4","087.4","087.5","087.5","087.5","088","089","089.1","089.1","089.2","089.2","089.3","089.3","089.4","089.4","090","900","910","910","910.01","911","912","913","914","915","916","917","918","919","919.1","920","920","920.01","921","922","990","991","992"
12) gerar lista a partir de ttddnew2 com symbol1 e symbol2 PesquisaEquiv.java
symbol2
"000","011","015.1","015.2","001","010","012","013.1","013.2","005.1","005.2","061.011","061.012","019.1","019.112","019.111","019.12","019.113","019","991","020","010.01","020.01","020.2","023.18","023.186","020.033","020.031","020.11","020.12","020.13","020.14","021","021.2","021.1","021.3","021.4","021.5","024","024.1","024.11","024.12","024.13","024.2","024.3","024.31","024.32","024.33","024.4","-","020.02","020.021","020.022","023.12","022.2","022.1","022.7","022.21","022.3","022.4","022.5","022.22","023","023.11","023.1","026.1","023.13","023.14","023.191","023.15","023.151","023.152","023.153","023.154","023.155","023.156","023.157","023.16","023.161","023.162","023.163","023.164","023.165","023.166","023.167","023.17","023.171","023.172","023.173","023.174","023.175","023.181","023.182","023.183","023.184","026.2","023.185","023.2","023.3","026.4","023.4","023.7","023.71","023.72","023.73","023.91","023.92","023.93","023.5","023.6","027","027.1","027.2","026","026.01","026.3","026.91","026.51","026.52","026.53","026.54","026.02","026.61","026.62","026.9","025.11","025.14","025.31","025.32","025.311","025.312","025.22","029","029.12","029.11","028","028.11","028.12","028.2","028.23","028.21","028.22","029.3","029.4","029.5","004.21","004.22","020.032","030","030.01","030.02","030.03","069.2","031","031.11","031.1","031.41","031.5","031.21","031.12","031.22","031.42","034","032","032.01","032.1","033.6","032.2","032.3","033","033.11","033.12","033.21","033.22","033.51","033.52","035","036","036.1","036.2","039","040","040.01","043.1","045.1","045.11","045.12","045.13","049.1","043.2","041","041.11","041.51","041.21","041.61","042.6","042","042.11","042.51","042.21","042.4","043.3","043.4","045.3","045.32","045.31","045.2","045.21","045.22","045.23","045.24","041.1","041.12","041.62","041.22","041.52","044.1","044.2","042.12","042.22","042.52","045.5","044.3","044.6","044.4","044.5","041.13","041.23","041.4","041.53","042.13","042.23","042.53","042.72","045.6","045.7","047.01","047.1","047.2","047.3","049","045.4","046.2","045.01","046.11","046.12","046.13","046.3","046.4","043.6","043.61","043.62","043.7","050","054.1","054.2","051","051.1","051.2","051.4","051.3","052","052.1","052.2","052.211","052.212","052.213","052.221","052.222","052.24","052.251","052.252","053","053.1","053.2","053.3","052.23","059","059.2","060","069.3","065.1","065.2","065.3","062","060.01","062.1","062.11","062.12","062.13","062.21","062.22","063.1","063.2","062.3","061","061.3","061.1","061.4","061.51","061.52","061.521","061.522","061.523","062.41","062.42","064.31","064.32","064.01","064.1","064.2","064.4","066","066.1","066.2","067","069","070","071.1","071.2","071.3","071.4","073.32","073.31","073.33","071.5","073.4","004.11","004.12","900","910.01","911","912","913","914","915","916","917","918","919.1","920.01","921","922","990","992"
symbol1
"000","001","002","003","004","010","010.1","010.2","010.3","011","012","012.1","012.11","012.12","012.2","012.3","019","019.01","020","020.1","020.2","020.3","020.31","020.4","020.5","021","021.1","021.2","022","022.1","022.11","022.12","022.121","022.122","022.2","022.21","022.22","022.221","022.222","022.9","023","023.01","023.02","023.03","023.1","023.11","023.12","023.13","023.14","023.15","024","024.1","024.11","024.111","024.112","024.119","024.12","024.121","024.122","024.123","024.124","024.13","024.131","024.132","024.133","024.134","024.135","024.136","024.137","024.139","024.14","024.141","024.142","024.143","024.144","024.145","024.149","024.15","024.151","024.152","024.153","024.154","024.155","024.156","024.2","024.3","024.4","024.5","024.51","024.52","024.59","024.9","024.91","024.92","025","025.1","025.11","025.12","026","026.01","026.1","026.11","026.12","026.13","026.131","026.132","026.19","026.191","026.192","026.193","026.194","026.195","026.2","026.21","026.22","026.23","029","029.1","029.11","029.2","029.21","029.22","029.221","029.222","029.3","029.31","029.4","029.5","029.6","029.7","030","030.1","031","032","033","033.1","033.11","033.12","033.13","033.2","033.21","033.22","033.23","034","034.01","034.1","034.2","034.3","034.4","034.5","035","035.1","035.2","036","036.1","036.2","037","037.1","037.2","039","040","041","041.01","041.011","041.012","041.013","041.02","041.1","041.11","041.12","041.13","041.14","041.15","041.2","041.21","041.22","041.23","041.24","041.3","041.4","041.41","041.42","041.5","041.51","041.52","041.53","041.54","041.59","042","042.1","042.11","042.12","042.13","042.2","042.3","042.31","042.32","042.4","042.5","042.9","042.91","042.911","042.912","042.913","043","044","049","049.1","049.11","049.12","049.13","049.14","049.15","049.2","049.21","049.22","049.3","050","050.1","051","051.1","051.11","051.12","051.13","051.14","051.2","051.21","051.22","051.23","052","052.1","052.2","052.21","052.22","053","054","055","055.01","055.1","055.2","056","057","059","059.1","060","060.1","060.2","060.3","061","061.1","061.2","062","062.01","062.1","062.11","062.12","062.13","062.2","062.3","062.4","062.5","063","063.01","063.1","063.2","063.3","063.4","063.5","063.51","063.6","063.61","063.62","063.63","064","065","066","066.1","066.2","066.3","067","067.1","067.2","067.21","067.22","067.3","069","070","071","071.1","071.11","071.12","071.2","071.3","071.9","072","072.1","073","073.1","074","074.1","074.2","074.3","075","079","090","091","900","910","920","930","940","990","991","992","993","994","995","996"
13) ajuste as classes iniciais em MainActivity.class e GruposPesquisa.class e private int[] array_proximo = {1,175};

preparação do XML do indice de assuntos
1) acertar o onosmaequi.CSV
2) ler TXT http://localhost/ttdd.php?action=110&op=10
3) conferir tabela ttddnew4 e acertar erros no TXT
5) gera indices http://localhost/ttdd.php?action=110&op=11
6) gerar onosmaequi.XML http://localhost/ttdd.php?action=110&op=12
7) ajuste onosmatico.java


*/

		if ($op==1) // http://localhost/ttdd.php?action=110&op=1
		{

			// CREATE TABLE `producao`.`ttddnew1` (`id` INT NOT NULL ,`symbol` CHAR( 10 ) NOT NULL ,`kind` CHAR( 1 ) NOT NULL ,`assunto` TEXT NOT NULL ,`fase_corrente` CHAR( 255 ) NOT NULL ,`fase_intermediaria` CHAR( 255 ) NOT NULL ,`destinacao` CHAR( 255 ) NOT NULL ,`observacoes` TEXT NOT NULL ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
			$fname="codclass.csv";

			@ $fpr = fopen($fname,"r");
			if (!$fpr)
				echo "Não foi identificado o arquivo texto $fname";
			else
			{
				$total = 1;
				while (!feof($fpr))
				{
					$texto= trim(fgets($fpr));
					list($symbol,$assunto,$observacoes) = explode(';',$texto);
					$symbol = trim($symbol);
					$assunto = utf8_encode(trim($assunto));
					$observacoes = utf8_encode(trim($observacoes));
					$cmd = "INSERT INTO ttddnew1 (id,symbol,kind,assunto,fase_corrente,fase_intermediaria,destinacao,observacoes) VALUES ('$total','$symbol','','$assunto','','','','$observacoes');";
					$total++;
				    $res = mysqli_query($link,$cmd);
					echo "$cmd<BR>";
				}
				fclose($fpr);
			}
			echo "<BR><BR>Fim de processamento: $total";
			exit();

			// CREATE TABLE `producao`.`ttddf3` (`id` INT NOT NULL ,`symbol` CHAR( 10 ) NOT NULL ,`assunto` TEXT NOT NULL ,`observacoes` TEXT NOT NULL ) ENGINE = InnoDB
			$fname="codclass3.csv";

			@ $fpr = fopen($fname,"r");
			if (!$fpr)
				echo "Não foi identificado o arquivo texto $fname";
			else
			{
				$total = 1;
				while (!feof($fpr))
				{
					$texto= trim(fgets($fpr));
					list($symbol,$observacoes) = explode(';',$texto);
					$symbol = trim($symbol);
					$observacoes = trim($observacoes);
					$cmd = "INSERT INTO ttddf3 (id,symbol,assunto,observacoes) VALUES ('$total','$symbol',' ','$observacoes');";
					$total++;
					$res = mysqli_query($link,$cmd);
					echo "$cmd<BR>";
				}
				fclose($fpr);
			}
			echo "<BR><BR>Fim de processamento: $total";
			exit();

		}

		if ($op==2) // http://localhost/ttdd.php?action=110&op=2
		{

			// CREATE TABLE `producao`.`ttddnew2` (`id` INT NOT NULL ,`symbol1` CHAR( 10 ) NOT NULL ,`assunto1` TEXT NOT NULL ,`symbol2` CHAR( 10 ) NOT NULL ,`assunto2` TEXT NOT NULL  ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
			$fname="codequi.csv";

			@ $fpr = fopen($fname,"r");
			if (!$fpr)
				echo "Não foi identificado o arquivo texto $fname";
			else
			{
				$total = 1;
				while (!feof($fpr))
				{
					$texto= trim(fgets($fpr));
					list($symbol1,$assunto1,$symbol2,$assunto2) = explode(';',$texto);
					$symbol1 = trim($symbol1);
					$assunto1 = utf8_encode(trim($assunto1));
					$symbol2 = trim($symbol2);
					$assunto2 = utf8_encode(trim($assunto2));
					$cmd = "INSERT INTO ttddnew2 (id,symbol1,assunto1,symbol2,assunto2) VALUES ('$total','$symbol1','$assunto1','$symbol2','$assunto2');";
					$total++;
					$res = mysqli_query($link,$cmd);
					echo "$cmd<BR>";
				}
				fclose($fpr);
			}
			echo "<BR><BR>Fim de processamento: $total";
			exit();
		}

		if ($op==3){ // http://localhost/ttdd.php?action=110&op=3
			$fname = "codequi.htm";
			@$fpw = fopen($fname,"w");
			if (!$fpw)
			{
				echo "Não foi identificado o arquivo texto $fname";
				exit();
			}
			else
			{
				$cmd = "<HTML>\n<HEAD>\n<TITLE>TTDD</TITLE>\n</HEAD>\n<BODY>\n";
				fwrite($fpw,$cmd);
				$cmd = "<TABLE><TR><TH with=10%>Origem</TH><TH with=30%>Assunto</TH><TH with=10%>Destino</TH><TH with=30%>Assunto</TH></TR>\n";
				fwrite($fpw,$cmd);
				$symbol1 = '';
				$cmd = "select * from ttddnew2 where 1 order by id asc";
                $res = mysqli_query($link,$cmd);
                while ($line=@mysqli_fetch_assoc($res))
				{
					$symbol1_anterior = $symbol1;
					$symbol1 = trim($line['symbol1']);
					$assunto1 = trim($line['assunto1']);
					$symbol2 = trim($line['symbol2']);
					$assunto2 = trim($line['assunto2']);
					if ($symbol1==$symbol1_anterior)
						$cmd = "<TR><TD></TD><TD></TD><TD>$symbol2</TD><TD>$assunto2</TD></TR>";
					else
						$cmd = "<TR><TD>$symbol1</TD><TD>$assunto1</TD><TD>$symbol2</TD><TD>$assunto2</TD></TR>";

					fwrite($fpw,$cmd."\n");
				}
				$cmd = "</TABLE>\n</BODY>\n</HTML>";
				fwrite($fpw,$cmd);
				fclose($fpw);
			}
			echo "<BR><BR>Fim de processamento";
			exit();
		}

		if ($op==4) // http://localhost/ttdd.php?action=110&op=4
		{

			// CREATE TABLE `producao`.`ttddnew3` (`id` INT NOT NULL ,`symbol` VARCHAR( 8 ) NOT NULL ,`grupo` VARCHAR( 255 ) NOT NULL, `kind` CHAR( 1 ) NOT NULL ,`assunto` TEXT NOT NULL ,`fase_corrente` CHAR( 255 ) NOT NULL ,`fase_intermediaria` CHAR( 255 ) NOT NULL ,`destinacao` CHAR( 255 ) NOT NULL ,`observacoes` TEXT NOT NULL, `indice` INT NOT NULL, `proximo` INT NOT NULL ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
			$fname="codsche.csv";

			@ $fpr = fopen($fname,"r");
			if (!$fpr)
				echo "Não foi identificado o arquivo texto $fname";
			else
			{
				$total = 1;
				while (!feof($fpr))
				{
					$texto= trim(fgets($fpr));
					list($symbol,$kind,$assunto,$fase_corrente,$fase_intermediaria,$destinacao,$observacoes) = explode(';',$texto);
					$symbol = trim($symbol);
					$kind = trim($kind);
					$assunto = utf8_encode(trim($assunto));
					$fase_corrente = utf8_encode(trim($fase_corrente));
					$fase_intermediaria = utf8_encode(trim($fase_intermediaria));
					$destinacao = utf8_encode(trim($destinacao));
					$observacoes = utf8_encode(trim($observacoes));
					$cmd = "INSERT INTO ttddnew3 (id,symbol,grupo,kind,assunto,fase_corrente,fase_intermediaria,destinacao,observacoes,indice,proximo) VALUES ('$total','$symbol','$symbol','$kind','$assunto','$fase_corrente','$fase_intermediaria','$destinacao','$observacoes',0,0);";
					$total++;
					$res = mysqli_query($link,$cmd);
					echo "$cmd<BR>";
				}
				fclose($fpr);
			}
			echo "<BR><BR>Fim de processamento: $total";
			exit();
		}

		if ($op==5) // http://localhost/ttdd.php?action=110&op=5
		{
			// SELECT * FROM ttddnew3 WHERE 1 and symbol not in (select symbol from ttddnew1 where 1)
			// SELECT * FROM ttddnew1 WHERE 1 and symbol not in (select symbol from ttddnew3 where 1)
			// ttddnew1 = lista todos os simbolos e texto explicativo para cada um
			// ttddnew3 = esquema de navegação com todos os simbolos

			$cmd = "select * from ttddnew2 where 1 order by id asc";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = trim($line['symbol1']);
				if (!is_numeric($symbol) && $symbol<>'-')
				{
					echo "ttddnew2 symbol1: $symbol<BR>";
				}
				$symbol = trim($line['symbol2']);
				if (!is_numeric($symbol) && $symbol<>'-')
				{
					echo "ttddnew2 symbol2: $symbol<BR>";
				}
			}

			$cmd = "select * from ttddnew3 where 1 order by id asc";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = trim($line['symbol']);
				if (!is_numeric($symbol) && $symbol<>'-')
				{
					echo "ttddnew3: $symbol<BR>";
				}
			}

			echo "Fim de processamento";
			exit();
		}

		if ($op==6) // http://localhost/ttdd.php?action=110&op=6
		{
			$count_c = 0;
			$count_s = 0;
			$count_g = 0;
			$count_z = 0;
			$count_m = 0;
			$count_n = 0;
			$kind = "";
			$cmd = "select * from ttddnew3 where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line['id'];
				$symbol = $line['symbol'];
				$kind_anterior = $kind;
				$kind = trim($line['kind']);

				if ($kind=='n')
				{
					if ($kind_anterior=='m')
						$count_n=1;
					else
						$count_n++;

					$symbol="$count_c.$count_s.$count_g.$count_z.$count_m.$count_n";

				}


				if ($kind=='m')
				{
					if ($kind_anterior=='z')
						$count_m=1;
					else
						$count_m++;

					$symbol="$count_c.$count_s.$count_g.$count_z.$count_m";

				}

				if ($kind=='z')
				{
					if ($kind_anterior=='g')
						$count_z=1;
					else
						$count_z++;

					$symbol="$count_c.$count_s.$count_g.$count_z";

				}

				if ($kind=='g')
				{
					if ($kind_anterior=='s')
						$count_g=1;
					else
						$count_g++;

					$symbol="$count_c.$count_s.$count_g";

				}

				if ($kind=='s')
				{
					if ($kind_anterior=='c')
						$count_s=1;
					else
						$count_s++;

					$symbol="$count_c.$count_s";

				}

				if ($kind=='c')
				{
					if ($kind_anterior=='')
						$count_c=0;
					else
						$count_c++;

					$symbol="$count_c";

				}


				$cmd2 = "update ttddnew3 set symbol='$symbol' where id=$id";
				$res2 = mysqli_query($link,$cmd2);
				echo "$cmd2;<BR>";
			}
			echo "Fim de processamento";
			exit();
		}

		if ($op==7)
		{
			////$section = '1';
			////$cmd = "update ttdd set indice=0, proximo=0 where 1";
			////echo "$cmd<BR>";
			////$res = mysqli_query($link,$cmd);
			////if ($section=='0') $start = 1;
			////if ($section=='1') $start = 98;

			//$section = '0';
			//$section = '1';
			//if ($section=='0') $start = 1; // rode section=0 e veja que o indice vai de 1 a 174
			//if ($section=='1') $start = 175;

			$total = 0;
			$indice = $start;
			$cmd = "";
			$cmd = "update ttddnew3 set indice=0, proximo=$indice where symbol like '$section%' and kind='c'";
			echo "$cmd<BR>";
			$res = mysqli_query($link,$cmd);

			$cmd = "update ttddnew3 set indice=$indice where symbol like '$section%' and kind='s'";
			echo "$cmd<BR>";
			$res = mysqli_query($link,$cmd);

			$indice=$indice+1;
			$cmd = "select * from ttddnew3 where symbol like '$section%' and kind='s'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				//$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddnew3 where kind='g' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddnew3 set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddnew3 set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddnew3 where symbol like '$section%' and kind='g'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				//$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddnew3 where kind='z' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddnew3 set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddnew3 set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddnew3 where symbol like '$section%' and kind='z'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				//$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddnew3 where kind='m' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddnew3 set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddnew3 set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddnew3 where symbol like '$section%' and kind='m'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				//$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddnew3 where kind='n' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddnew3 set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddnew3 set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}


			echo "Fim do processamento: $indice";
			exit();
		}

		if ($op==8)
		{
			$fname="kindS.xml";
			if ($section==1) $fname="kind.xml";
			if ($section==2) $fname="KindSios.xml";
			if ($section==3) $fname="Kindios.xml";

			@ $fpw = fopen($fname,"w");
			$texto = '<?xml version="1.0" encoding="UTF-8"?>';
			fputs($fpw,$texto."\n");
			$texto = '<ROOT>';
			fputs($fpw,$texto."\n");

			$cmd = "select * from ttddnew3 where kind='s'";
			if ($section==1) $cmd = "select * from ttddnew3 where 1";
			if ($section==2) $cmd = "select * from ttddnew3 where kind='s'";
			if ($section==3) $cmd = "select * from ttddnew3 where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line['id'];
				$grupo = $line['grupo'];
				$kind = trim($line['kind']);
				$assunto = $line['assunto'];
				$fase_corrente = $line['fase_corrente'];
				if ($fase_corrente=="") $fase_corrente=" ";
				$fase_intermediaria = $line['fase_intermediaria'];
				if ($fase_intermediaria=="") $fase_intermediaria=" ";
				$destinacao = $line['destinacao'];
				if ($destinacao=="") $destinacao=" ";
				$observacoes = $line['observacoes'];
				if ($observacoes=="") $observacoes=" ";
				$indice = trim($line['indice']);
				$proximo = trim($line['proximo']);

//				$explica = ' ';
//				$cmd2 = "select * from ttddnew1 where symbol='$grupo'";
//				$res2 = mysqli_query($link,$cmd2);
//				if ($line2=@mysqli_fetch_assoc($res2)) $explica = $line2['observacoes'];

                if ($section==0 or $section==1) // Android
                {
                    $texto = '    <row>';
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='id'>$id</field>";
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='grupo'>$grupo</field>";
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='kind'>$kind</field>";
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='assunto'>$assunto</field>";
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='fase_corrente'>$fase_corrente</field>";
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='fase_intermediaria'>$fase_intermediaria</field>";
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='destinacao'>$destinacao</field>";
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='observacoes'>$observacoes</field>";
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='indice'>$indice</field>";
                    fputs($fpw,$texto."\n");
                    $texto = "        <field name='proximo'>$proximo</field>";
                    fputs($fpw,$texto."\n");
    //				$texto = "        <field name='explica'>$explica</field>";
    //				fputs($fpw,$texto."\n");
                    $texto = '    </row>';
                    fputs($fpw,$texto."\n");
                }

                if ($section==2 or $section==3) // ios
                {
                    $texto = '	<row>';
                    fputs($fpw,$texto."\n");
                    $texto = "		<id>$id</id>";
                    fputs($fpw,$texto."\n");
                    $texto = "		<grupo>$grupo</grupo>";
                    fputs($fpw,$texto."\n");
                    $texto = "		<kind>$kind</kind>";
                    fputs($fpw,$texto."\n");
                    $texto = "		<assunto>$assunto</assunto>";
                    fputs($fpw,$texto."\n");
                    $texto = "		<fase_corrente>$fase_corrente</fase_corrente>";
                    fputs($fpw,$texto."\n");
                    $texto = "		<fase_intermediaria>$fase_intermediaria</fase_intermediaria>";
                    fputs($fpw,$texto."\n");
                    $texto = "		<destinacao>$destinacao</destinacao>";
                    fputs($fpw,$texto."\n");
                    $texto = "		<observacoes>$observacoes</observacoes>";
                    fputs($fpw,$texto."\n");
                    $texto = "		<indice>$indice</indice>";
                    fputs($fpw,$texto."\n");
                    $texto = "		<proximo>$proximo</proximo>";
                    fputs($fpw,$texto."\n");
                    $texto = '	</row>';
                    fputs($fpw,$texto."\n");
                }

			}
			$texto = '</ROOT>';
			fputs($fpw,$texto."\n");
			echo "Fim de processamento: <a href='kindI.xml'>Clique aqui para kindS.xml</a><BR><BR>";
			exit();
		}

		if ($op==9)
		{

			echo "Iniciando...<BR>";
            if ($section==1)
            {
                $cmd = "select distinct(symbol1) from ttddnew2 where 1";
                $res = mysqli_query($link,$cmd);
                while ($line=@mysqli_fetch_assoc($res))
                {
                    $symbol1 = $line["symbol1"];
                    echo '"'.$symbol1.'"'.",";

                }
                echo "Fim processamento";
                exit();
            }

            if ($section==2)
            {
                $cmd = "select distinct(symbol2) from ttddnew2 where 1";
                $res = mysqli_query($link,$cmd);
                while ($line=@mysqli_fetch_assoc($res))
                {
                    $symbol2 = $line["symbol2"];
                    echo '"'.$symbol2.'"'.",";

                }
                echo "Fim processamento";
                exit();
            }

            if ($section==3)
            {
                $cmd = "select * from ttddnew3 where 1";
                $res = mysqli_query($link,$cmd);
                while ($line=@mysqli_fetch_assoc($res))
                {
                    $id = $line["id"];
                    $grupo = $line["grupo"];
                    $kind = $line["kind"];
                    $assunto = $line["assunto"];
                    echo '"'.$grupo.'"'.",";

                }
                echo "Fim processamento";
                exit();
            }

            if ($section==4)
            {
                $cmd = "select * from ttddnew3 where 1";
                $res = mysqli_query($link,$cmd);
                while ($line=@mysqli_fetch_assoc($res))
                {
                    $id = $line["id"];
                    $symbol = $line["symbol"];
                    $kind = $line["kind"];
                    $assunto = $line["assunto"];
                    if ($kind=='c') echo "<B>$symbol</B> $assunto<BR><BR>";
                    if ($kind=='s') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
                    if ($kind=='g') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
                    if ($kind=='z') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
                    if ($kind=='m') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
                    if ($kind=='n') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
                }
                echo "Fim processamento";
                exit();
            }
		}

		if ($op==10) // http://localhost/ttdd.php?action=110&op=10
		{

			// CREATE TABLE `producao`.`ttddnew4` (`id` INT NOT NULL ,`symbol` CHAR( 7 ) NOT NULL ,`grupo` CHAR( 7 ) NOT NULL, `kind` CHAR( 1 ) NOT NULL ,`assunto` TEXT NOT NULL,`subassunto` TEXT NOT NULL,`indice` INT(11) NOT NULL,proximo INT(11) ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
            $total=0;
			$fname="onosmaequi.csv";
			@ $fpr = fopen($fname,"r");
			if (!$fpr)
				echo "Não foi identificado o arquivo texto $fname";
			else
			{
				$id = 1;$j=0;$k=0;
				while (!feof($fpr))
				{
                    $total++;
					$texto= trim(fgets($fpr));
					if (substr($texto,0,1)=='c') //c;1.;ABASTECIMENTO DE VEICULOS - AGUA
					{
						$texto = substr($texto,1);
						list($kind,$symbol,$assunto) = explode(';',$texto);
						$assunto = utf8_encode(trim($assunto));
						$subassunto= '';$grupo='';$kind='c';
						$cmd = "INSERT INTO ttddnew4 (id,symbol,grupo,kind,assunto,subassunto) VALUES ('$id','$symbol','$grupo','$kind','$assunto','$subassunto');";
						$id++;
						$res = mysqli_query($link,$cmd);
						echo "$cmd<BR>";
					}
					elseif (substr($texto,0,1)=='.') // .desinfestação;066.1
					{
						$kind_anterior = $kind;
						$kind=1;
						if (substr($texto,1,1)=='.') $kind=2;

						if ($kind_anterior==1 && $kind==2) $k=0;

						$texto = substr($texto,1);
						list($assunto,$grupo) = explode(';',$texto);
						$assunto = utf8_encode(trim($assunto));
						$grupo = trim($grupo);
						if ($kind==1)
						{
							$j=$j+1;
							$symbol = $maingroup.".".$j.".";
						}
						else
						{
							$k=$k+1;
							$symbol = $maingroup.".".$j.".".$k.".";
							$assunto = substr($assunto,1);
						}

						$subassunto= '';
						$cmd = "INSERT INTO ttddnew4 (id,symbol,grupo,kind,assunto,subassunto) VALUES ('$id','$symbol','$grupo','$kind','$assunto','$subassunto');";
						$id++;
						$res = mysqli_query($link,$cmd);
						echo "$cmd<BR>";
					}
					else // 1.1;ABASTECIMENTO DE VEICULOS;042.4 ou 1.11;@;004
					{
						$kind = 0;
						list($symbol,$assunto,$grupo) = explode(';',$texto);
						$assunto = utf8_encode(trim($assunto)); // Acesso a  documentação arquivistica Ver POLITICA DE ACESSO A DOCUMENTACAO ARQUIVISTICA
						$subassunto = '';
						$pos = strpos($assunto,' Ver ');
						if ($pos !== false)
						{
							$subassunto=substr($assunto,$pos+5); // POLITICA DE ACESSO A DOCUMENTACAO ARQUIVISTICA
							$assunto=substr($assunto,0,$pos); // Acesso a  documentação arquivistica
						}
						$grupo = trim($grupo);
						$maingroup = $symbol;
						$symbol = $symbol.".";
						$j=0;$k=0;
						if ($assunto=='@') $assunto=' ';
						$cmd = "INSERT INTO ttddnew4 (id,symbol,grupo,kind,assunto,subassunto) VALUES ('$id','$symbol','$grupo','$kind','$assunto','$subassunto');";
						$id++;
						$res = mysqli_query($link,$cmd);
						echo "$cmd<BR>";
					}


				}
				fclose($fpr);
			}
			echo "<BR><BR>Fim de processamento: $total";
			exit();
		}

		if ($op==11)
		{
			$start = 1;

			$total = 0;
			$indice = $start;
			$cmd = "update ttddnew4 set indice=0 where kind='c'";
			echo "$cmd<BR>";
			$res = mysqli_query($link,$cmd);

			$indice=$indice+1;
			$cmd = "select * from ttddnew4 where kind='c'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);

				$gravou = 0;
				$cmd2 = "select * from ttddnew4 where kind='0' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddnew4 set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddnew4 set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddnew4 where kind='0'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);

				$gravou = 0;
				$cmd2 = "select * from ttddnew4 where kind='1' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddnew4 set indice=$indice where symbol='$symbol1' and kind='1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddnew4 set proximo=$indice where symbol='$symbol' and kind='0'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddnew4 where kind='1'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddnew4 where kind='2' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddnew4 set indice=$indice where symbol='$symbol1' and kind='2'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddnew4 set proximo=$indice where symbol='$symbol' and kind='1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			echo "Fim do processamento: $total";
			exit();
		}

		if ($op==12)
		{
			$fname="onosmaequi.xml";
			$fname="onosmatico.xml";

			@ $fpw = fopen($fname,"w");
			$texto = '<?xml version="1.0" encoding="UTF-8"?>';
			fputs($fpw,$texto."\n");
			$texto = '<ROOT>';
			fputs($fpw,$texto."\n");

            $assunto="";
			$cmd = "select * from ttddnew4 where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line['id'];
				$grupo = $line['grupo'];
				if ($grupo=="") $grupo=" ";
				$kind = trim($line['kind']);
				$assunto_anterior=$assunto;
				$assunto = trim($line['assunto']);
				if ($assunto=="") $assunto=$assunto_anterior;
				$subassunto = $line['subassunto'];
				if ($subassunto=="") $subassunto=" ";
				$indice = trim($line['indice']);
				$proximo = trim($line['proximo']);

				$texto = '<row>';
				fputs($fpw,$texto."\n");
				$texto = "<field name='id'>$id</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='grupo'>$grupo</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='kind'>$kind</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='assunto'>$assunto</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='subassunto'>$subassunto</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='indice'>$indice</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='proximo'>$proximo</field>";
				fputs($fpw,$texto."\n");
				$texto = '</row>';
				fputs($fpw,$texto."\n");
			}
			$texto = '</ROOT>';
			fputs($fpw,$texto."\n");
			echo "Fim de processamento: <a href='onosmatico.xml'>Clique aqui para onosmatico.xml</a><BR><BR>";
			exit();
		}

		if ($op==13) // http://localhost/ttdd.php?action=110&op=13
		{
			$fname="codclass.xml";
			//$fname="codclass3.xml";

			@ $fpw = fopen($fname,"w");
			$texto = '<?xml version="1.0" encoding="UTF-8"?>';
			fputs($fpw,$texto."\n");
			$texto = '<ROOT>';
			fputs($fpw,$texto."\n");

			$cmd = "select * from ttddnew1 where 1";
			//$cmd = "select * from ttddf3 where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line['id'];
				$symbol = $line['symbol'];
				$assunto = $line['assunto'];
				if ($assunto=="") $assunto=" ";
				$observacoes = $line['observacoes'];
				if ($observacoes=="") $observacoes=" ";

				$texto = '    <row>';
				fputs($fpw,$texto."\n");
				$texto = "        <field name='id'>$id</field>"; // versão para android
				fputs($fpw,$texto."\n");
				$texto = "        <field name='symbol'>$symbol</field>";
				fputs($fpw,$texto."\n");
				$texto = "        <field name='assunto'>$assunto</field>";
				fputs($fpw,$texto."\n");
				$texto = "        <field name='observacoes'>$observacoes</field>";
				fputs($fpw,$texto."\n");
				$texto = '    </row>';
				fputs($fpw,$texto."\n");


/*				$texto = '	<row>';
				fputs($fpw,$texto."\n");
				$texto = "		<id>$id</id>"; // versão para ios
				fputs($fpw,$texto."\n");
				$texto = "		<symbol>$symbol</symbol>";
				fputs($fpw,$texto."\n");
				$texto = "		<assunto>$assunto</assunto>";
				fputs($fpw,$texto."\n");
				$texto = "		<observacoes>$observacoes</observacoes>";
				fputs($fpw,$texto."\n");
				$texto = '	</row>';
				fputs($fpw,$texto."\n"); */

			}
			$texto = '</ROOT>';
			fputs($fpw,$texto."\n");
			echo "Fim de processamento: <a href='codclass.xml'>Clique aqui para codclass.xml</a><BR><BR>";
			exit();
		}

		if ($op==14) // http://localhost/ttdd.php?action=110&op=14
		{
			$fname="codequi.xml";

			@ $fpw = fopen($fname,"w");
			$texto = '<?xml version="1.0" encoding="UTF-8"?>';
			fputs($fpw,$texto."\n");
			$texto = '<ROOT>';
			fputs($fpw,$texto."\n");

			$cmd = "select * from ttddnew2 where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line['id'];
				$symbol1 = $line['symbol1'];
				$assunto1 = $line['assunto1'];
				if ($assunto1=="") $assunto1=" ";
				$symbol2 = $line['symbol2'];
				$assunto2 = $line['assunto2'];
				if ($assunto2=="") $assunto2=" ";

				$texto = '    <row>';
				fputs($fpw,$texto."\n");
				$texto = "        <field name='id'>$id</field>";
				fputs($fpw,$texto."\n");
				$texto = "        <field name='symbol1'>$symbol1</field>";
				fputs($fpw,$texto."\n");
				$texto = "        <field name='assunto1'>$assunto1</field>";
				fputs($fpw,$texto."\n");
				$texto = "        <field name='symbol2'>$symbol2</field>";
				fputs($fpw,$texto."\n");
				$texto = "        <field name='assunto2'>$assunto2</field>";
				fputs($fpw,$texto."\n");
				$texto = '    </row>';
				fputs($fpw,$texto."\n");

/*
				$texto = '	<row>';
				fputs($fpw,$texto."\n");
				$texto = "		<id>$id</id>";
				fputs($fpw,$texto."\n");
				$texto = "		<symbol>$symbol</grupo>";
				fputs($fpw,$texto."\n");
				$texto = "		<assunto>$assunto</assunto>";
				fputs($fpw,$texto."\n");
				$texto = "		<observacoes>$observacoes</observacoes>";
				fputs($fpw,$texto."\n");
				$texto = '	</row>';
				fputs($fpw,$texto."\n");
*/
			}
			$texto = '</ROOT>';
			fputs($fpw,$texto."\n");
			echo "Fim de processamento: <a href='codequi.xml'>Clique aqui para codequi.xml</a><BR><BR>";
			exit();
		}


		echo "Fim de processamento";
		exit();
	}

	if ($action==109)
	{
		$fname="kindS.xml";
	    $filename = 'kindS2.xml';
		$fname="kind.xml";
	    $filename = 'kind2.xml';
		$fname="codequi.xml";
	    $filename = 'codequi2.xml';
		$fname="codclass.xml";
	    $filename = 'codclass2.xml';
		$fname="onosmatico.xml";
	    $filename = 'onosmatico2.xml';

	    @ $fpw = fopen($filename, "w");
		@ $fpr = fopen($fname,"r");
		if (!$fpr)
			echo "Não foi identificado o arquivo texto $fname";
		else
		{
			$id = 1;
			while (!feof($fpr))
			{
				$texto= fgets($fpr); // <field name='id'>3</field>
				$texto = str_replace("field name=","",$texto);
				$texto = str_replace("'","",$texto);
				echo "texto =".trim($texto)."=<BR>";
				if (substr(trim($texto),0,4)=='<id>') $texto = str_replace("</field>","</id>",$texto);
				if (substr(trim($texto),0,4)=='<gru') $texto = str_replace("</field>","</grupo>",$texto);
				if (substr(trim($texto),0,4)=='<kin') $texto = str_replace("</field>","</kind>",$texto);
				if (substr(trim($texto),0,9)=='<assunto>') $texto = str_replace("</field>","</assunto>",$texto);
				if (substr(trim($texto),0,4)=='<sub') $texto = str_replace("</field>","</subassunto>",$texto);
				if (substr(trim($texto),0,4)=='<ind') $texto = str_replace("</field>","</indice>",$texto);
				if (substr(trim($texto),0,4)=='<pro') $texto = str_replace("</field>","</proximo>",$texto);
				if (substr(trim($texto),0,7)=='<fase_c') $texto = str_replace("</field>","</fase_corrente>",$texto);
				if (substr(trim($texto),0,7)=='<fase_i') $texto = str_replace("</field>","</fase_intermediaria>",$texto);
				if (substr(trim($texto),0,7)=='<destin') $texto = str_replace("</field>","</destinacao>",$texto);
				if (substr(trim($texto),0,7)=='<observ') $texto = str_replace("</field>","</observacoes>",$texto);
				if (substr(trim($texto),0,10)=='<assunto1>') $texto = str_replace("</field>","</assunto1>",$texto);
				if (substr(trim($texto),0,10)=='<assunto2>') $texto = str_replace("</field>","</assunto2>",$texto);
				if (substr(trim($texto),0,9)=='<symbol1>') $texto = str_replace("</field>","</symbol1>",$texto);
				if (substr(trim($texto),0,9)=='<symbol2>') $texto = str_replace("</field>","</symbol2>",$texto);
				if (substr(trim($texto),0,8)=='<symbol>') $texto = str_replace("</field>","</symbol>",$texto);
				echo "$texto<BR>";
				fputs($fpw,$texto);
			}
			fclose($fpr);
			fclose($fpw);
		}
		echo "Fim de processamento";
		exit();
	}


	if ($action==106)
	{

/*****

    <item android:id="@+id/item_inicio"
        android:title="@string/item_inicio"
        android:orderInCategory="100"
        app:showAsAction="always"
        android:icon="@drawable/ic_home"/>

    <item android:id="@+id/item_onosmatico"
        android:title="@string/item_onosmatico"
        android:orderInCategory="200"
        app:showAsAction="always"
        android:icon="@drawable/ic_action_font_bigger"/>

        Para o Indice de assuntos foi utilizado o material produzido pela Comissão Permanente de Arquivo - CPArq da Universidade Federal da Bahia
        organizado por Aurora Freixo e Lidia Maria Batista Brandão Toutain de julho de 2014 e disponibilizado em https://proad.ufba.br/sites/proad.ufba.br/files/manual_de_aplicacao_e_utilizacao_ufba.pdf

mWebView = (WebView) findViewById(R.id.webview);
mWebView.setWebChromeClient(new WebChromeClient());
mWebView.getSettings().setJavaScriptEnabled(true);
mWebView.getSettings().setDomStorageEnabled(true);
mWebView.getSettings().setLoadWithOverviewMode(true);
mWebView.getSettings().setUseWideViewPort(true);
mWebView.getSettings().setSupportMultipleWindows(true);
mWebView.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);
mWebView.setHorizontalScrollBarEnabled(false);
mWebView.setScrollBarStyle(WebView.SCROLLBARS_OUTSIDE_OVERLAY);
mWebView.getSettings().setAllowFileAccessFromFileURLs(true);
mWebView.getSettings().setAllowUniversalAccessFromFileURLs(true);
mWebView.addJavascriptInterface(this, "android");
if (savedInstanceState != null) {
    mWebView.restoreState(savedInstanceState);
} else {
    mWebView.loadUrl("file:///android_asset/site/index.html");
}

preparação do XML do esquema:
1) acertar o TXT
2) renomear para CSV
3) detectar algum ; faltante visualizando o CSV no Excel
4) http://localhost/ttdd.php?action=106&op=2
5) renomear symbol para grupo e criar campo symbol,CHAR 255
6) http://localhost/ttdd.php?action=106&op=6
7) criar campos INT indice e proximo
8) http://localhost/ttdd.php?action=106&op=1 para cada secao (ajustar manualmente)
9) http://localhost/ttdd.php?action=106&op=3
10) gerar lista de simbolos validos e gravar no array simbolosValidos em Pesquisa.java http://localhost/ttdd.php?action=106&op=5
11) ajuste as classes iniciais em MainActivity.class e GruposPesquisa.class

preparação do XML do Indice de assuntos
1) acertar o TXT
2) ler no WORD e detectar erros ortograficos, acertar campos de ttddfim2
3) ler TXT http://localhost/ttdd.php?action=106&op=8
4) conferir tabela ttddfim2 e acertar erros no TXT
5) gera indices http://localhost/ttdd.php?action=106&op=10
6) gerar XML http://localhost/ttdd.php?action=106&op=9
7) ajuste onosmatico.java

BuscaPalavra.java use
   String assunto1 = eliminar_acentos(assunto);
   assunto1 = assunto1.toUpperCase();
   int firstIndex = assunto1.indexOf(grupo_buscado);

MainActivity.java
        listView.setLongClickable(true);
        listView.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener() {
            @Override
            public boolean onItemLongClick(AdapterView<?> av, View v, int pos, long id) {
                Toast.makeText(MainActivity.this, "Não hÃ¡ dados de temporalidade", Toast.LENGTH_LONG).show();
                return true;
            }
        });


*/
		if ($op==10)
		{
			$start = 1;

			$total = 0;
			$indice = $start;
			$cmd = "update ttddfim2 set indice=0 where kind='c'";
			echo "$cmd<BR>";
			$res = mysqli_query($link,$cmd);

			$indice=$indice+1;
			$cmd = "select * from ttddfim2 where kind='c'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);

				$gravou = 0;
				$cmd2 = "select * from ttddfim2 where kind='0' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddfim2 set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddfim2 set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddfim2 where kind='0'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);

				$gravou = 0;
				$cmd2 = "select * from ttddfim2 where kind='1' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddfim2 set indice=$indice where symbol='$symbol1' and kind='1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddfim2 set proximo=$indice where symbol='$symbol' and kind='0'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddfim2 where kind='1'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddfim2 where kind='2' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddfim2 set indice=$indice where symbol='$symbol1' and kind='2'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddfim2 set proximo=$indice where symbol='$symbol' and kind='1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			echo "Fim do processamento: $total";
			exit();
		}

		if ($op==9)
		{
			$fname="onosmatico.xml";
			//$fname="onosmafim.xml";

			@ $fpw = fopen($fname,"w");
			$texto = '<?xml version="1.0" encoding="UTF-8"?>';
			fputs($fpw,$texto."\n");
			$texto = '<ROOT>';
			fputs($fpw,$texto."\n");

			$cmd = "select * from ttdd where kind='s'";
			//$cmd = "select * from ttddfim2 where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line['id'];
				$grupo = $line['grupo'];
				if ($grupo=="") $grupo=" ";
				$kind = trim($line['kind']);
				$assunto_anterior=$assunto;
				$assunto = trim($line['assunto']);
				if ($assunto=="") $assunto=$assunto_anterior;
				$subassunto = $line['subassunto'];
				if ($subassunto=="") $subassunto=" ";
				$indice = trim($line['indice']);
				$proximo = trim($line['proximo']);

				$texto = '<row>';
				fputs($fpw,$texto."\n");
				$texto = "<field name='id'>$id</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='grupo'>$grupo</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='kind'>$kind</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='assunto'>$assunto</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='subassunto'>$subassunto</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='indice'>$indice</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='proximo'>$proximo</field>";
				fputs($fpw,$texto."\n");
				$texto = '</row>';
				fputs($fpw,$texto."\n");
			}
			$texto = '</ROOT>';
			fputs($fpw,$texto."\n");
			echo "Fim de processamento: <a href='onosmafim.xml'>Clique aqui para onosmatico.xml</a><BR><BR>";
			exit();
		}

		if ($op==8)
		{

			// CREATE TABLE `producao`.`ttddfim2` (`id` INT NOT NULL ,`symbol` CHAR( 7 ) NOT NULL ,`kind` CHAR( 1 ) NOT NULL ,`assunto` TEXT NOT NULL ) ENGINE = InnoDB
			$fname="onosma1.txt";
			$fname="onosmafim.txt";
			@ $fpr = fopen($fname,"r");
			if (!$fpr)
				echo "Não foi identificado o arquivo texto $fname";
			else
			{
				$id = 1;$j=0;$k=0;
				while (!feof($fpr))
				{
					$texto= trim(fgets($fpr));
					if (substr($texto,0,1)=='c') //c;1.;ABASTECIMENTO DE VEICULOS - AGUA
					{
						$texto = substr($texto,1);
						list($kind,$symbol,$assunto) = explode(';',$texto);
						$assunto = trim($assunto);
						$grupo = trim($grupo);
						$subassunto= '';$grupo='';$kind='c';
						$cmd = "INSERT INTO ttddfim2 (id,symbol,grupo,kind,assunto,subassunto) VALUES ('$id','$symbol','$grupo','$kind','$assunto','$subassunto');";
						$id++;
						$res = execute_query($cmd);
						echo "$cmd<BR>";
					}
					elseif (substr($texto,0,1)=='.') // .desinfestação;066.1
					{
						$kind_anterior = $kind;
						$kind=1;
						if (substr($texto,1,1)=='.') $kind=2;

						if ($kind_anterior==1 && $kind==2) $k=0;

						$texto = substr($texto,1);
						list($assunto,$grupo) = explode(';',$texto);
						$assunto = trim($assunto);
						$grupo = trim($grupo);
						if ($kind==1)
						{
							$j=$j+1;
							$symbol = $maingroup.".".$j.".";
						}
						else
						{
							$k=$k+1;
							$symbol = $maingroup.".".$j.".".$k.".";
							$assunto = substr($assunto,1);
						}

						$subassunto= '';
						$cmd = "INSERT INTO ttddfim2 (id,symbol,grupo,kind,assunto,subassunto) VALUES ('$id','$symbol','$grupo','$kind','$assunto','$subassunto');";
						$id++;
						$res = execute_query($cmd);
						echo "$cmd<BR>";
					}
					else // 1.1;ABASTECIMENTO DE VEÃCULOS;042.4 ou 1.11;@;004
					{
						$kind = 0;
						list($symbol,$assunto,$grupo) = explode(';',$texto);
						$assunto = trim($assunto); // Acesso Ã  documentação arquivÃ­stica Ver POLÃTICA DE ACESSO Ã€ DOCUMENTAÃ‡ÃƒO ARQUIVÃSTICA
						$subassunto = '';
						$pos = strpos($assunto,' Ver ');
						if ($pos !== false)
						{
							$subassunto=substr($assunto,$pos+5);
							$assunto=substr($assunto,0,$pos);
						}
						$grupo = trim($grupo);
						$maingroup = $symbol;
						$symbol = $symbol.".";
						$j=0;$k=0;
						if ($assunto=='@') $assunto=' ';
						$cmd = "INSERT INTO ttddfim2 (id,symbol,grupo,kind,assunto,subassunto) VALUES ('$id','$symbol','$grupo','$kind','$assunto','$subassunto');";
						$id++;
						$res = execute_query($cmd);
						echo "$cmd<BR>";
					}


				}
				fclose($fpr);
			}
			echo "<BR><BR>Fim de processamento: $total";
			exit();
		}

		if ($op==7)
		{

			$fname="onosma1.txt";
			@ $fpr = fopen($fname,"r");
			if (!$fpr)
				echo "Não foi identificado o arquivo texto $fname";
			else
			{
				$total = 1;
				while (!feof($fpr))
				{
					$total++;
					$texto= trim(fgets($fpr));
					if (substr($texto,0,1)=='.')
					{
						$i = strlen($texto);
						if ($i<50)	echo "$texto<BR>";
					}
				}
				fclose($fpr);
			}
			echo "<BR><BR>Fim de processamento: $total";
			exit();
		}

		if ($op==3)
		{
			$fname="kind.xml";
			$fname="kindfim.xml";
			$fname="KindIphone.xml";

			@ $fpw = fopen($fname,"w");
			$texto = '<?xml version="1.0" encoding="UTF-8"?>';
			fputs($fpw,$texto."\n");
			$texto = '<ROOT>';
			fputs($fpw,$texto."\n");

			$cmd = "select * from ttdd where kind='s'";
			$cmd = "select * from ttdd where 1";
			$cmd = "select * from ttddfim where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line['id'];
				$grupo = $line['grupo'];
				$kind = trim($line['kind']);
				$assunto = $line['assunto'];
				$fase_corrente = $line['fase_corrente'];
				if ($fase_corrente=="") $fase_corrente=" ";
				$fase_intermediaria = $line['fase_intermediaria'];
				if ($fase_intermediaria=="") $fase_intermediaria=" ";
				$destinacao = $line['destinacao'];
				if ($destinacao=="") $destinacao=" ";
				$observacoes = $line['observacoes'];
				if ($observacoes=="") $observacoes=" ";
				$indice = trim($line['indice']);
				$proximo = trim($line['proximo']);
/*
				$texto = '	<row>';
				fputs($fpw,$texto."\n");
				$texto = "<field name='id'>$id</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='grupo'>$grupo</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='kind'>$kind</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='assunto'>$assunto</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='fase_corrente'>$fase_corrente</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='fase_intermediaria'>$fase_intermediaria</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='destinacao'>$destinacao</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='observacoes'>$observacoes</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='indice'>$indice</field>";
				fputs($fpw,$texto."\n");
				$texto = "<field name='proximo'>$proximo</field>";
				fputs($fpw,$texto."\n");
				$texto = '	</row>';
				fputs($fpw,$texto."\n");
*/
				$texto = '	<row>';
				fputs($fpw,$texto."\n");
				$texto = "		<id>$id</id>";
				fputs($fpw,$texto."\n");
				$texto = "		<grupo>$grupo</grupo>";
				fputs($fpw,$texto."\n");
				$texto = "		<kind>$kind</kind>";
				fputs($fpw,$texto."\n");
				$texto = "		<assunto>$assunto</assunto>";
				fputs($fpw,$texto."\n");
				$texto = "		<fase_corrente>$fase_corrente</fase_corrente>";
				fputs($fpw,$texto."\n");
				$texto = "		<fase_intermediaria>$fase_intermediaria</fase_intermediaria>";
				fputs($fpw,$texto."\n");
				$texto = "		<destinacao>$destinacao</destinacao>";
				fputs($fpw,$texto."\n");
				$texto = "		<observacoes>$observacoes</observacoes>";
				fputs($fpw,$texto."\n");
				$texto = "		<indice>$indice</indice>";
				fputs($fpw,$texto."\n");
				$texto = "		<proximo>$proximo</proximo>";
				fputs($fpw,$texto."\n");
				$texto = '	</row>';
				fputs($fpw,$texto."\n");
			}
			$texto = '</ROOT>';
			fputs($fpw,$texto."\n");
			echo "Fim de processamento: <a href='kindI.xml'>Clique aqui para kindS.xml</a><BR><BR>";
			exit();
		}

		if ($op==6)
		{
			$count_c = 0;
			$count_s = 0;
			$count_g = 0;
			$count_z = 0;
			$count_m = 0;
			$count_n = 0;
			$kind = "";
			$cmd = "select * from ttddfim where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line['id'];
				$symbol = $line['symbol'];
				$kind_anterior = $kind;
				$kind = trim($line['kind']);

				if ($kind=='n')
				{
					if ($kind_anterior=='m')
						$count_n=1;
					else
						$count_n++;

					$symbol="$count_c.$count_s.$count_g.$count_z.$count_m.$count_n";

				}


				if ($kind=='m')
				{
					if ($kind_anterior=='z')
						$count_m=1;
					else
						$count_m++;

					$symbol="$count_c.$count_s.$count_g.$count_z.$count_m";

				}

				if ($kind=='z')
				{
					if ($kind_anterior=='g')
						$count_z=1;
					else
						$count_z++;

					$symbol="$count_c.$count_s.$count_g.$count_z";

				}

				if ($kind=='g')
				{
					if ($kind_anterior=='s')
						$count_g=1;
					else
						$count_g++;

					$symbol="$count_c.$count_s.$count_g";

				}

				if ($kind=='s')
				{
					if ($kind_anterior=='c')
						$count_s=1;
					else
						$count_s++;

					$symbol="$count_c.$count_s";

				}

				if ($kind=='c')
				{
					if ($kind_anterior=='')
						$count_c=0;
					else
						$count_c++;

					$symbol="$count_c";

				}


				$cmd2 = "update ttddfim set symbol='$symbol' where id=$id";
				$res2 = execute_query($cmd2);
				echo "$cmd2;<BR>";
			}
			echo "Fim de processamento";
			exit();
		}

		if ($op==1)
		{
			//$section = '1';
			////$cmd = "update ttdd set indice=0, proximo=0 where 1";
			////echo "$cmd<BR>";
			////$res = mysqli_query($link,$cmd);
			//if ($section=='0') $start = 1;
			//if ($section=='1') $start = 98;

			$section = '0';
			$section = '1';
			$section = '2';
			$section = '3';
			$section = '4';
			if ($section=='0') $start = 1;
			if ($section=='1') $start = 60;
			if ($section=='2') $start = 74;
			if ($section=='3') $start = 82;
			if ($section=='4') $start = 127;

			$total = 0;
			$indice = $start;
			$cmd = "";
			$cmd = "update ttddfim set indice=0, proximo=$indice where symbol like '$section%' and kind='c'";
			echo "$cmd<BR>";
			$res = mysqli_query($link,$cmd);

			$cmd = "update ttddfim set indice=$indice where symbol like '$section%' and kind='s'";
			echo "$cmd<BR>";
			$res = mysqli_query($link,$cmd);

			$indice=$indice+1;
			$cmd = "select * from ttddfim where symbol like '$section%' and kind='s'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddfim where kind='g' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddfim set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddfim set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddfim where symbol like '$section%' and kind='g'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddfim where kind='z' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddfim set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddfim set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddfim where symbol like '$section%' and kind='z'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddfim where kind='m' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddfim set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddfim set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}

			$cmd = "select * from ttddfim where symbol like '$section%' and kind='m'";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$symbol = $line['symbol'];
				$kind = trim($line['kind']);
				$descricao = trim($line['descricao']);

				$gravou = 0;
				$cmd2 = "select * from ttddfim where kind='n' and symbol like '$symbol%'";
				$res2 = mysqli_query($link,$cmd2);
				while ($line2=@mysqli_fetch_assoc($res2))
				{
					$symbol1 = $line2['symbol'];
					$cmd3 = "update ttddfim set indice=$indice where symbol='$symbol1'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$gravou = 1;
				}

				if ($gravou==1)
				{
					$cmd3 = "update ttddfim set proximo=$indice where symbol='$symbol'";
					$res3 = mysqli_query($link,$cmd3);
					echo "$cmd3<BR>";
					$indice++;
				}
			}


			echo "Fim do processamento: $total";
			exit();
		}

		if ($op==5)
		{
			echo "Iniciando...<BR>";
			$cmd = "select * from ttddfim where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line["id"];
				$grupo = $line["grupo"];
				$kind = $line["kind"];
				$assunto = $line["assunto"];
				echo '"'.$grupo.'"'.",";

			}
			echo "Fim processamento";
			exit();

			$cmd = "select * from ttdd where 1";
			$res = mysqli_query($link,$cmd);
			while ($line=@mysqli_fetch_assoc($res))
			{
				$id = $line["id"];
				$symbol = $line["symbol"];
				$kind = $line["kind"];
				$assunto = $line["assunto"];
				if ($kind=='c') echo "<B>$symbol</B> $assunto<BR><BR>";
				if ($kind=='s') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
				if ($kind=='g') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
				if ($kind=='z') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
				if ($kind=='m') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
				if ($kind=='n') echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>$symbol</B> $assunto<BR><BR>";
			}
			echo "Fim processamento";
			exit();
		}

		if ($op==2)
		{

			// CREATE TABLE `producao`.`ttddfim` (`id` INT NOT NULL ,`symbol` CHAR( 7 ) NOT NULL ,`kind` CHAR( 1 ) NOT NULL ,`assunto` TEXT NOT NULL ,`fase_corrente` CHAR( 255 ) NOT NULL ,`fase_intermediaria` CHAR( 255 ) NOT NULL ,`destinacao` CHAR( 255 ) NOT NULL ,`observacoes` TEXT NOT NULL ) ENGINE = InnoDB
			$fname="tabela1.csv";
			$fname="ftabela.csv";

			@ $fpr = fopen($fname,"r");
			if (!$fpr)
				echo "Não foi identificado o arquivo texto $fname";
			else
			{
				$total = 1;
				while (!feof($fpr))
				{
					$texto= trim(fgets($fpr));
					list($symbol,$kind,$assunto,$fase_corrente,$fase_intermediaria,$destinacao,$observacoes) = explode(';',$texto);
					$symbol = trim($symbol);
					$kind = trim($kind);
					$assunto = trim($assunto);
					$fase_corrente = trim($fase_corrente);
					$fase_intermediaria = trim($fase_intermediaria);
					$destinacao = trim($destinacao);
					$observacoes = trim($observacoes);
					$cmd = "INSERT INTO ttddfim (id,symbol,kind,assunto,fase_corrente,fase_intermediaria,destinacao,observacoes) VALUES ('$total','$symbol','$kind','$assunto','$fase_corrente','$fase_intermediaria','$destinacao','$observacoes');";
					$total++;
					$res = execute_query($cmd);
					echo "$cmd<BR>";
				}
				fclose($fpr);
			}
			echo "<BR><BR>Fim de processamento: $total";
			exit();
		}
		echo "Fim de processamento";
		exit();
	}

?>

</BODY></HTML>
