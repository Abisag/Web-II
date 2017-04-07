<?php
	require('conexion.php');
	$query="SELECT * FROM cdr";
	$resultado=$mysqli->query($query);
?>

<html>
	<head>
		<link rel="stylesheet" href="css/estilos.css"/>
		<title class="titulo">Registro de llamadas</title>
		
	</head>
	<body >
	<form name="asterisk" method="post" accion="index.php">
		<div id="nombre"><center><h1>Registro de llamadas</h1></center></div>
		<input type="submit" name="ID" value="ID">
		<input type="submit" name="extenision" value ="Fuente">
		<input type="submit" name="fecha" value="Fecha">
		<SELECT NAME="Combo" SIZE=1> 
			<OPTION VALUE="CBID">ID</OPTION>
			<OPTION VALUE="CBFuente">Fuente</OPTION>
			<OPTION VALUE="CBDestino">Destino</OPTION> 
		</SELECT> 
		<input type="text" name="txt_ext">
		
		<p></p>
		<div id="tabla">
			<table border=1 width="80%">
			<thead>
				<tr>
					<td class="texto1"><b>ID</b></td>
					<td><b>Fecha</b></td>
					<td><b>Fuente</b></td>
					<td><b>Destino</b></td>
					
					
					<td><b>Duracion</b></td>
				</tr>
				<tbody>
					
					<?php 

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
							
							<td><?php echo $row['id'];?>
							</td>
							<td>
								<?php echo $row['calldate'];?>
							</td>
							<td>
								<?php echo $row['src'];?>
							</td>
							<td>
								<?php echo $row['dst'];?>
							</td>
							<td><?php echo $row['dcontext'];?>
							</td>
							
							<td>
								<?php echo $row['duration'];?>
							</td>
							<td>
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
	
