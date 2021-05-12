<!DOCTYPE html>
<html>
	<head>
		<title>Crud PHP</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/e7a1dc7285.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php include "connection.php"; ?>
        <?php 
        if(isset($_POST['submit'])){
			$cpf = $_POST['cpf'];
        }
        ?>
        <div class="container">
            <a href="menu_cli.php"><i class="fas fa-home" style="margin-top: 2%"></i></a>
			<div class="card text-center mt-3">
				<div class="card-header">
					BUSCAR CLIENTE
				</div>
				<div class="card-body">
                    
                    <a href="insere.php" class="btn btn-primary">Inserir Cliente</a>
					<a href="lista.php" class="btn btn-primary">Listar Clientes</a>

					<form class="mt-2" method="POST" action="buscar.php">
		
                        <input type="text" name="cpf" placeholder="Entre com o cpf...">
                            
                        <input type="submit" name="submit" value="Buscar cliente">
                    
                    </form>
					
				</div>
				<div class="card-footer text-muted">
                    AV1 3DAW - CRUD
				</div>
		</div>
        
        <?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {	
				$cpf = $_POST["cpf"];
                $sql = "SELECT nome, cpf, endereco, cep, cidade, estado FROM clientes where cpf = '$cpf'"; 
				$resultado = $con->query($sql);

		?>
        
       
        <table class="table table-sm mt-5">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>CEP</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($linha = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <tr>
                            <td><?php echo $linha['nome']; ?></td>
                            <td><?php echo $linha['cpf']; ?></td>
                            <td><?php echo $linha['endereco']; ?></td>
                            <td><?php echo $linha['cep']; ?></td>
                            <td><?php echo $linha['cidade']; ?></td>
                            <td><?php echo $linha['estado']; ?></td>
                        </tr>
                        <?php
                    }
                }else {
                    echo "<script>alert('Cliente não encontrado!')</script>";
                }?>
            </tbody>
        </table>
        <?php
			}
		?>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>