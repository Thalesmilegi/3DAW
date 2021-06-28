<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "brasil";

	//Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}	

	$cod_estados = $_GET['cod_estados'];

	$sql = "SELECT cod_cidades, nome FROM cidades WHERE estados_cod_estados='$cod_estados' ORDER BY nome";

	$res = mysqli_query($conn, $sql);

	$lista = array();

	while ($row = mysqli_fetch_assoc($res)) {
		$cidades = array (
			'cod_cidades'  => $row['cod_cidades'],
			'nome'      => $row['nome'],
		);
		array_push($lista, $cidades);
	}

	echo( json_encode( $lista ) );
?>