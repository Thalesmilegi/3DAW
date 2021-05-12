<?php 
	include 'connection.php';
	if(isset($_GET['delete_id'])){
		$id = $_GET['delete_id'];
		$query = mysqli_query($con, "DELETE FROM clientes WHERE id = '$id'");
		if($query){
			header("location:menu_cli.php");
		}else{
			echo "<script>alert('Desculpe, excluir a consulta não funciona!')</script>";
		}
	}
 ?>