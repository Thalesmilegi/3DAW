<!DOCTYPE html>
<html>
	<head>
		<title>Crud PHP</title>
        
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
		<?php include "connection.php"; ?>
        
        <div class="container">
			
			<div class="card text-center mt-5">
				<div class="card-header">
					MENU LISTA
				</div>
				<div class="card-body">
					<a href="insere.php" class="btn btn-primary">Inserir Aluno</a>
					<a href="buscar.php" class="btn btn-primary">Exibir um Aluno</a>

                    <table class="table table-sm mt-5">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Matricula</th>
                                <th>Data de Nascimento</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $Show = mysqli_query($con, "SELECT * FROM Alunos");
                                while($r = mysqli_fetch_array($Show)): ?>
                                    <tr>
                                        <td><?php echo $r['nome']; ?></td>
                                        <td><?php echo $r['mat']; ?></td>
                                        <td><?php echo $r['datanasc']; ?></td>
                                        <td><a href="update.php?update_id=<?php echo $r['id']; ?>"> Update</a></td>
                                        <td><a href="delete.php?delete_id=<?php echo $r['id']; ?>">Delete</a></td>
                                    </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

				</div>
				<div class="card-footer text-muted">
					Trabalho CRUD
				</div>
			</div>
			
		</div>
        
       
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    </body>
</html>