<?php include "connection.php";
if(isset($_POST['update'])){
  $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
  $endereco = $_POST['endereco'];
  $cep = $_POST['cep'];
  $cidade = $_POST['cidade'];
  $estado = $_POST['estado'];
  $id = $_POST['id'];
  $query = mysqli_query($con, "UPDATE clientes SET nome = '$nome', cpf = '$cpf', endereco = '$endereco', cep = '$cep', cidade = '$cidade', estado = '$estado' WHERE id = '$id'");
  if ($query) {
    header("location:lista.php");
  }else{
    echo "<script>alert('Desculpe, atualizar a consulta não funciona')</script>";
  }
}
 ?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Crud</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/e7a1dc7285.js" crossorigin="anonymous"></script>
    </head>
    <body>

        <?php
            if(isset($_GET['update_id'])): ?>
            <?php $id = $_GET['update_id']; ?>
            <?php $query = mysqli_query($con, "SELECT * FROM clientes WHERE id = '$id' ");
            $r = mysqli_fetch_array($query);
            $nome = $r['nome'];
            $cpf = $r['cpf'];
            $endereco = $r['endereco'];
            $cep = $r['cep'];
            $cidade = $r['cidade'];
            $estado = $r['estado'];
        ?>

        <div class="container">
            <a href="menu_cli.php"><i class="fas fa-home" style="margin-top: 2%"></i></a>
            <div class="card text-center mt-5">
                <div class="card-header">
                    UPDATE CLIENTE
                </div>
                <div class="card-body">
                    <a href="insere.php" class="btn btn-primary">Inserir Cliente</a>
                    <a href="lista.php" class="btn btn-primary">Listar Clientes</a>
                    <a href="buscar.php" class="btn btn-primary">Exibir um Cliente</a>

                    <form class="mt-2" method="POST" action="update.php">

                        <input type="text" name="nome" placeholder="Entre com o nome..." value="<?php echo $nome; ?>">
                        
                        <input type="text" name="cpf" placeholder="Entre com o cpf..."value="<?php echo $cpf; ?>">
                    
                        <input type="text" name="endereco"placeholder="Entre com o endereco..." value="<?php echo $endereco; ?>">

                        <input type="text" name="cep" placeholder="Entre com o cep..."value="<?php echo $cep; ?>">

                        <input type="text" name="cidade" placeholder="Entre com a cidade..."value="<?php echo $cidade; ?>">

                        <input type="text" name="estado" placeholder="Entre com o estado..."value="<?php echo $estado; ?>">
                        
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="update" value="Atualizar">
                        
                    </form>
                    
                </div>
                <div class="card-footer text-muted">
                    AV1 3DAW - CRUD
                </div>
            </div>
        </div>   
    <!-- form -->
  <?php endif; ?>

  </body>

</html>