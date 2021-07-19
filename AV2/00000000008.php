<?php
    include('connection.php');
?>
<?php
    
?>
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
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card h-100">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <?php 
                                    
                                        $sql = "SELECT * FROM produtos WHERE cod_barra = '00000000008'"; 
                                        $resultado = $con->query($sql);
                                        $saida = "<table>";
                                            while ($d = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {
                                                $saida  = $saida. "<tr>"
                                                        . "  <td><img style='height:620px; widht:540px;' class=thumb src='/3DAW_Thales/AV2/imagens/".$d['foto']."' /></td>"
                                                        . "  <td>"
                                                        . "      <h4>".$d['nome']."</h4>"
                                                        . "      <h6>Código de Barra: ".$d['cod_barra']."</h6>"
                                                        . "      <h6>Fabricante: ".$d['fabricante']."</h6>"
                                                        . "      <h6>Categoria: ".$d['categoria']."</h6>"
                                                        . "      <h6>Tipo de Produto: ".$d['tipo_prod']."</h6>"
                                                        . "      <h6>Estoque: ".$d['qtd_estoque']."</h6>"
                                                        . "      <h6>Peso em gramas: ".$d['peso_gramas']."</h6>"
                                                        . "      <h6>Descrição: ".$d['descricao']."</h6>"
                                                        . "      <h4>R$".$d['preco_venda']."</h4>"
                                                        . "  </td>"
                                                        . "</tr>";
                                            }
                                            $saida = $saida. "</table>";

                                        echo $saida;
                                        $resultado->close();
                                        $con->close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>        
        </section>           
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; AV2 3DAW 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>