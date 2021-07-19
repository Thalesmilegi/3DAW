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
        <section class="mb-4">
            <div class="container px-4 px-lg-5 mt-5">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {	
                    $cod_barra = $_POST["cod_barra"];
                }
                ?>
                <table class="table table-sm">
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
                            $Show = mysqli_query($con, "SELECT nome, categoria, preco_venda, qtd_estoque, cod_barra FROM produtos WHERE ativo='s'");
                            while($r = mysqli_fetch_array($Show)): ?>
                                <tr>
                                    <td><?php echo $r['cod_barra']; ?></td>
                                    <td><a href="<?php echo $r['cod_barra'] ?>.php"><?php echo $r['nome']; ?></a></td>
                                    <td><?php echo $r['categoria']; ?></td>
                                    <td><?php echo $r['preco_venda']; ?></td>
                                    <td><?php echo $r['qtd_estoque']; ?></td>
    
                                </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>
         <!-- Footer-->
         <footer id="footer" class="p-2 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>