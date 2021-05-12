<!DOCTYPE html>
<html>
	<head>
		<title>Crud PHP</title>
        
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/e7a1dc7285.js" crossorigin="anonymous"></script>
    </head>
	<body>
		<?php include "connection.php"; ?>
        
        <div class="container">
            <a href="menu_prod.php"><i class="fas fa-home" style="margin-top: 2%"></i></a>
			<div class="card text-center mt-3">
				<div class="card-header">
					LISTA PRODUTOS
				</div>
				<div class="card-body">
                <a href="inserirArquivo.php" class="btn btn-primary">Inserir Produto por Arquivo</a>

                    <table class="table table-sm mt-5">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Peso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $Show = mysqli_query($con, "SELECT * FROM produtos");
                                while($r = mysqli_fetch_array($Show)): ?>
                                    <tr>
                                        <td><?php echo $r['nome']; ?></td>
                                        <td><?php echo $r['descricao']; ?></td>
                                        <td><?php echo $r['preco']; ?></td>
                                        <td><?php echo $r['quantidade']; ?></td>
                                        <td><?php echo $r['peso']; ?></td>
                                    </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

				</div>
				<div class="card-footer text-muted">
                    AV1 3DAW - CRUD
				</div>
			</div>
			
		</div>
        
       
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>