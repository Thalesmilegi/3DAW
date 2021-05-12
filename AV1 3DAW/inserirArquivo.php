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
        <title>Crud PHP</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/e7a1dc7285.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <a href="menu_prod.php"><i class="fas fa-home" style="margin-top: 2%"></i></a>
			<div class="card text-center mt-3">
				<div class="card-header">
					INSERÇÃO DE PRODUTO
				</div>
				<div class="card-body">
                    <a href="lista_prod.php" class="btn btn-primary">Listar Produtos</a>					
                    <form class="mt-4" method="POST" action="inserirArquivo.php">
                            Digite o nome do arquivo: <input type="text" name="csv">
                            <input type="submit" name="submit" value="Enviar">
                        </fieldset>
                    </form>
                    </div>
				<div class="card-footer text-muted">
                    AV1 3DAW - CRUD
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
                    $descricao = $dados[1];
                    $preco = $dados[2];
                    $quantidade = $dados[3];
                    $peso = $dados[4];

                    $query = mysqli_query($con, "INSERT INTO produtos (nome, descricao, preco, quantidade, peso) VALUES ('$nome','$descricao', '$preco', '$quantidade', '$peso')");
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