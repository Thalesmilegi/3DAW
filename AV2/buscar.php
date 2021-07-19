<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Loja Ximbolé Bahiano</title>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Ximbolé Bahiano</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="listaprod.php">Lista dos produtos</a></li>
                        <li class="nav-item"><a class="nav-link" href="buscar.php">Buscar produto por código de barra</a></li>
                        <li class="nav-item"><a class="nav-link" href="inserir.php">Inserir produto</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Loja Ximbolé Bahiano</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Loja voltada para artigos tecnologicos</p>
                </div>
            </div>
        </header>
        <?php include "connection.php"; ?>
        <?php 
        if(isset($_POST['submit'])){
			$cod_barra = $_POST['cod_barra'];
        }
        ?>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <form class="mt-2" method="POST" action="buscar.php">
            
                    <input class="form-control" type="text" name="cod_barra" placeholder="Entre com o código de barra...">
                    <br>
                    <input class="btn btn-outline-dark mt-auto" type="submit" name="submit" value="Buscar produto">
                
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {	
                    $cod_barra = $_POST["cod_barra"];
                    $sql = "SELECT nome, categoria, preco_venda, qtd_estoque, cod_barra FROM produtos where cod_barra = '$cod_barra' AND ativo ='s'"; 
                    $resultado = $con->query($sql);
                ?>

                <table class="table table-sm mt-5">
                    <thead>
                        <tr>
                            <th>Código de Barra</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($resultado->num_rows > 0) {
                            while ($linha = mysqli_fetch_assoc($resultado)) {
                                ?>
                                
                                <tr>
                                    <td><?php echo $linha['cod_barra']; ?></td>
                                    <td><a href="<?php echo $cod_barra ?>.php"><?php echo $linha['nome']; ?></a></td>
                                    <td><?php echo $linha['categoria']; ?></td>
                                    <td><?php echo $linha['preco_venda']; ?></td>
                                    <td><?php echo $linha['qtd_estoque']; ?></td>
                                </tr>
                                <?php
                            }
                        }else {
                            echo "<script>alert('Produto não encontrado!')</script>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                    }
                ?>
            </div>
        </section>
         <!-- Footer-->
         <footer id="footer" class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>