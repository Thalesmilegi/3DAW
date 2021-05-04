<!DOCTYPE html>
<html>
	<head>
		<title>Crud PHP</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>
	<body>
		<?php include "connection.php"; ?>
        <?php 
        if(isset($_POST['submit'])){
			$mat = $_POST['mat'];
        }
        ?>
        <div class="container">
			
			<div class="card text-center mt-5">
				<div class="card-header">
					MENU BUSCAR
				</div>
				<div class="card-body">
                    <a href="insere.php" class="btn btn-primary">Inserir Aluno</a>
					<a href="lista.php" class="btn btn-primary">Listar Alunos</a>

					<form class="mt-2" method="POST" action="buscar.php">
		
                        <input type="text" name="mat" placeholder="Entre com a matricula...">
                            
                        <input type="submit" name="submit" value="Buscar aluno">
                    
                    </form>
					
				</div>
				<div class="card-footer text-muted">
					Trabalho CRUD
				</div>
		</div>
        
        <?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {	
				$mat = $_POST["mat"];
                $sql = "SELECT mat, nome, datanasc FROM Alunos where mat = '$mat'"; 
				$resultado = $con->query($sql);

		?>
        
       
        <table class="table table-sm mt-5">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Matricula</th>
                    <th>Data de Nascimento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($linha = mysqli_fetch_assoc($resultado)) {
                        ?>
                        <tr>
                            <td><?php echo $linha['nome']; ?></td>
                            <td><?php echo $linha['mat']; ?></td>
                            <td><?php echo $linha['datanasc']; ?></td>
                        </tr>
                        <?php
                    }
                }else {
                    echo "<script>alert('Aluno não encontrado!')</script>";
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
