<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $csv = $_POST["csv"];
    $csvValido = 0;

    if ($csv != "") {
        $csvValido = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Inserir Aluno por Arquivo</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">	
			<div class="card text-center mt-5">
				<div class="card-header">
					MENU INSERSÃO POR ARQUIVO
				</div>
				<div class="card-body">					
					<a href="inserirArquivo.php" class="btn btn-primary">Inserir Aluno por Arquivo</a>
					<a href="lista.php" class="btn btn-primary">Listar Alunos</a>
					<a href="buscar.php" class="btn btn-primary">Exibir um Aluno</a>

                    <form class="mt-4" method="POST" action="inserirArquivo.php">
                            Digite o nome do arquivo: <input type="text" name="csv">
                            <input type="submit" name="submit" value="Enviar">
                        </fieldset>
                    </form>
                    </div>
				<div class="card-footer text-muted">
					Trabalho CRUD
				</div>
			</div>
			
		</div>	

        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if ($csvValido == 1)
            {

                include "connection.php";

                $arquivo = fopen($csv,'r');

                fgetcsv($arquivo,1000,";");

                while($dados = fgetcsv($arquivo,1000,";"))
                {

                    $nome = $dados[0];
                    $mat = $dados[1];
                    $datanasc = $dados[2];

                    $datanasc = implode("/",array_reverse(explode("-",$datanasc)));

                    $query = mysqli_query($con, "INSERT INTO Alunos (nome, mat, datanasc) VALUES ('$nome','$mat', '$datanasc')");
                }

                if($query === TRUE)
                {
                    echo "<script>alert('Inserção realizada com sucesso!')</script>";
                }
                else{
                    echo "<script>alert('Algo deu errado na inserção! Tente novamente.')</script>";
                }
            }else{
                echo "<script>alert('Verifique o arquivo!')</script>";
            }
        }

        ?>
    </body>
</html>