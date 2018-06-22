<?php
	ECHO "Iniciando proceso de transferencia de arhivo</BR>";
	ECHO "INSERT INTO usuarios (id_usuario, nombre_usuarios, foto) VALUES (NULL, 'Kenya', 'kenya_pack.jpg')</BR>";
	//Conexion a BD
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "bds133";

	$conexion = mysqli_connect($servername, $username, $password, $database); 
	if ($conexion = true){
		echo "Conexion exitosa</BR>"; 
	}

	// Inicio de transferencia
	//1- Validar si se prsiono el boton
	IF(ISSET ($_POST["submit"])){
		ECHO "</BR> Se presiono un boton submit con metodo POST </BR>";
		//$_FILES requiere el nombre el campo del formulario y requiere de un nombre temporal mientras el archivo esta en transito
		$archivoOrigen = $_FILES["fileToUpload"]["tmp_name"];
		$archivoDestino = "imagenes/".$_FILES["fileToUpload"]["name"];
		ECHO "El archivo a enviar es: ".$archivoDestino."</BR>";
	}


	$imageFileType = pathinfo($archivoDestino,PATHINFO_EXTENSION);

	$check = getimagesize($archivoOrigen);

	ECHO "Extencion del archivo: ".$imageFileType."</BR>";

	if($check!==false){ 
	//Si encontro algo un archivo de tipo imagen 
	echo "El archivo, es una lmagan </BR>"; 
	//Transfiriendo el archivo. 
	move_uploaded_file($archivoOrigen,$archivoDestino); 
	//TRANSFIRIENDO LA URL A LA BD 
	$query = "INSERT INTO usuarios (id_usuario, nombre_usuarios, foto) VALUES (NULL, 'Kenya', 'kenya_pack.jpg')";
	ECHO "Query a ejecutar:".$query."</BR>"; 
	$query_a_ejecutar = mysqli_query(mysqli_connect($servername, $username, $password, $database), "INSERT INTO usuarios (id_usuario, nombre_usuarios, foto) VALUES (NULL, 'Kenya', '".$archivoDestino."')");
	//EJECUTANDO QUERY DE INSERCION 
	if($query_a_ejecutar){ 
		ECHO "Query ejecutado correctamente</br>"; 
		HEADER("Refresh: 5; url=formulario_Archivo1.html"); 
		} else { 
			ECHO "Query no ejecutado</br>"; 
		} 
	}else{ 
		echo "El archivo NO es una imagen</BR>"; 
	}
?>