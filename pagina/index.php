<?php
	require('conexion.php');
	$query="SELECT id,calldate,src,dst,dcontext,lastapp,duration,disposition FROM cdr_data";
	$resultado=$mysqli->query($query);
?>

<html>
	<head>
		<link rel="stylesheet" href="css/estilos.css"/>
		<title class="titulo">Registro de llamadas</title>
		
	</head>
	<body class="texto2">
	<form name="asterisk" method="post" accion="index.php">
		<div id="nombre"><center><h1>CENTRO DE LLAMADAS MDA.</h1></center></div>
		<input class="bottom" type="submit" name="ID" value="ID">
		<input class="bottom" type="submit" name="fecha" value="Fecha">
		<input class="bottom" type="submit" name="enviar" value="Buscar">
		<SELECT class="texto1" NAME="Combo" SIZE=1> 
			<OPTION VALUE="CBFuente">Fuente</OPTION>
			<OPTION VALUE="CBDestino">Destino</OPTION> 
		</SELECT> 
		<input type="text" name="txt_ext">
		<p></p>
		<div id="tabla">
			<table border=1 width="80%">
			<thead>
				<tr class="texto1">
					<td class="texto1"><b>ID</b></td>
					<td class="texto1"><b>Fecha</b></td>
					<td class="texto1"><b>Fuente</b></td>
					<td class="texto1"><b>Destino</b></td>
					
					
				</tr>
				<tbody>
					
					<?php 

					//if(isset($_POST["enviar"])){
					//	$env=$_POST["txt_ext"];
					//	$query="SELECT id,calldate,src,dst,dcontext,lastapp,duration,disposition FROM cdr_data where src=$env";
					//}
					if(isset($_POST["enviar"])){
						$env=$_POST["txt_ext"];
						$op=$_POST["Combo"];
						if ($op=="CBID") {
							$query="SELECT id,calldate,src,dst,dcontext,lastapp,duration,disposition FROM cdr_data where id like '%$env%'";
						}
						if ($op=="CBFuente") {
							$query="SELECT id,calldate,src,dst,dcontext,lastapp,duration,disposition FROM cdr_data where src
							like '%$env%'";
						}
						if ($op=="CBDestino") {
							$query="SELECT id,calldate,src,dst,dcontext,lastapp,duration,disposition FROM cdr_data where dst like '%$env%'";
						}
					}
					if (isset($_POST["extenision"])){
						$query="SELECT id,calldate,src,dst,dcontext,lastapp,duration,disposition FROM cdr_data order by src";
					}
					if(isset($_POST["fecha"])){
						$query="SELECT id,calldate,src,dst,dcontext,lastapp,duration,disposition FROM cdr_data order by calldate desc";
					}
						$resultado=$mysqli->query($query);
					while($row=$resultado->fetch_assoc()){ ?>
						<tr>
							
							<td class="texto3"><?php echo $row['id'];?>
							</td>
							<td class="texto3" >
								<?php echo $row['calldate'];?>
							</td>
							
							<td class="texto3">
								<?php echo $row['duration'];?>
							</td>
							<td class="texto3">
								<?php if ($row['lastapp']=="VoiceMail") {
									echo "VOICEMAIL";
								}
								 else{
									echo $row['disposition'];
								}
								 ;?>
																
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</form>

		
		</body>
	</html>	
	
