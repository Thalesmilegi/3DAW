<?php 
    echo "<font style='color:white;margin-left: 22%'>SE A OPCÃO SELECIONA FOR <strong>RAIZ OU INVERSO</strong> DE UM NÚMERO, PREENCHA SOMENTE O PRIMEIRO CAMPO!!</font>";
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Calculadora</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
		integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">  
    </head>
    <body class="bg-dark">
        <div class="container">
            <div class="card card-login mx-auto mt-5 col-6">
                <div class="card card-header text-center">Minha Calculadora</div>
                <div class="card-body">
                    <form action="calculadora.php" method="POST">
                        <div class="form-group">
                            <select class="form-control" name="op">
                                <option selected>Escolha a operação desejada</option>
                                <option value="soma">Adição</option>
                                <option value="sub">Subtração</option>
                                <option value="mult">Multiplicação</option>
                                <option value="div">Divisão</option>
                                <option value="por">Porcentagem</option>
                                <option value="inv">Inverso de um número</option>
                                <option value="pot">Potenciação</option>
                                <option value="raiz">Raiz</option>
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label for="">Digite um número</label>
                            <input type="number" class="form-control" name="num1" placeholder="Digite um número">
                            <label for="">Digite um número</label>
                            <input type="number" class="form-control"  name="num2" placeholder="Digite um número" >
                        </div>
                        <input class="btn btn-success btn-block"type="submit" value="Calcular">

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

