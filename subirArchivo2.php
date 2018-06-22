<?php
	ECHO "Iniciando proceso de transferencia de arhivo</BR>";
	ECHO "INSERT INTO usuarios (id_usuario, nombre_usuarios, foto) VALUES (NULL, 'Kenya', 'kenya_pack.xlsx')</BR>";

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "bds133";

	$conexion = mysqli_connect($servername, $username, $password, $database); 
	if ($conexion = true){
		echo "Conexion exitosa</BR>"; 
	}


	IF(ISSET ($_POST["submit"])){
		ECHO "</BR> Se presiono un boton submit con metodo POST </BR>";
		
		$archivoOrigen = $_FILES["fileToUpload"]["tmp_name"];
		$archivoDestino = "archivos/".$_FILES["fileToUpload"]["name"];
		ECHO "El archivo a enviar es: ".$archivoDestino."</BR>";
	}


	$FileType = pathinfo($archivoDestino,PATHINFO_EXTENSION);

	//$check = getfile(fdf_document)($archivoOrigen);

	ECHO "Extencion del archivo: ".$FileType."</BR>";

	if($FileType=="xlsx" || $FileType=="xls"){ 

	echo "El archivo, es un exel</BR>"; 

	move_uploaded_file($archivoOrigen,$archivoDestino); 

	$query = "INSERT INTO usuarios (id_usuario, nombre_usuarios, foto) VALUES (NULL, 'Kenya', 'kenya_pack.xlsx')";
	ECHO "Query a ejecutar:".$query."</BR>"; 
	$query_a_ejecutar = mysqli_query(mysqli_connect($servername, $username, $password, $database), "INSERT INTO usuarios (id_usuario, nombre_usuarios, foto) VALUES (NULL, 'Kenya', '".$archivoDestino."')");
 
	if($query_a_ejecutar){ 
		ECHO "Query ejecutado correctamente</br>"; 
		HEADER("Refresh: 5; url=formulario_Archivo2.html"); 
		} else { 
			ECHO "Query no ejecutado</br>"; 
		} 
	}else{ 
		echo "El archivo NO es un exel</BR>"; 
	}
?>