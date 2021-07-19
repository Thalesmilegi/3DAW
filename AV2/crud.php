<?php
//dados de conexao com banco de dados do sistema
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "loja";

//captura acao que deve ser executada
$a = $_REQUEST["action"];

//identifica acao e invoca metodo a ser executado
switch ( $a ) {
    case "lista":
        carregarLista(); break;
    case "salvar":
        salvarForm(); break;
    case "buscar":
        carregarProduto(); break;
    case "validar":
        isValidCod(); break;
}


//*****************************************************************************
// Metodo que carrega lista de produtos cadastrados
//
function carregarLista() {
    //abre conexao com banco de dados
    global $host, $user, $pass, $db;
    $mysqli = new mysqli( $host, $user, $pass, $db );
    if ( $mysqli->connect_errno ) { printf("Connect failed: %s\n", $mysqli->connect_error); exit(); }
    //preara e executa consulta de lista de produtos
    $sql = "SELECT * FROM produtos WHERE ativo = 's' ORDER BY id DESC";
    if (!$res = $mysqli->query( $sql )) {
        echo "Erro ao executar SQL<br>";
        echo "Query: ".$sql."<br>";
        echo "Errno: ".$mysqli->errno."<br>";
        echo "Error: ".$mysqli->error."<br>";
        $res->close();
        exit;
    }
    //verifica se existe retorno de dados
    if ($res->num_rows === 0) {
        echo "Nenhum cadastro realizado até o momento.";
        $res->close();
        exit;
    }

    
    //monta tabela de resultados na pagina
    $saida = "<table>";
    while ($d = mysqli_fetch_array($res, MYSQLI_BOTH)) {
        $saida  = $saida. "<tr>"
                . "  <td style='width:25%'><img class=thumb src='/AV2/imagens/".$d['foto']."' /></td>"
                . "  <td>"
                . "      <a style=text-decoration:none; href='".$d['cod_barra'].".php'><p class=plus style=color:black;text-decoration:none;>".$d['nome']."</p></a>"
                . "      <h6>Código de Barra: ".$d['cod_barra']."</h6>"
                . "      <h6>Categoria: ".$d['categoria']."</h6>"
                . "      <h6>R$".$d['preco_venda']."</h6>"
                . "      <h6>Estoque: ".$d['qtd_estoque']."</h6>"
                . "  </td>"
                . "  <td style='width:25%'><input type=button class=button value=Editar onClick='carregarProduto(\"".$d['id']."\");'></td>"
                . "</tr>";
    }
    $saida = $saida. "</table>";

    echo $saida;
    $res->close();
    $mysqli->close();
}

//*****************************************************************************
// Metodo que carrega dados do produto selecionado para alteracao
//
function carregarProduto() {
    //var_dump($_POST);
    if ( ! isset( $_POST ) || empty( $_POST ) ) {
        echo "Dados do formulário não chegaram no PHP.";
        exit;
    }
    //recupera ID a ser buscado
    if ( isset( $_POST["id"] ) && is_numeric( $_POST["id"] ) ) {
        $id = (int) $_POST["id"];

        //abre conexao com banco
        global $host, $user, $pass, $db;
        $mysqli = new mysqli( $host, $user, $pass, $db );
        if ( $mysqli->connect_errno ) { printf("Connect failed: %s\n", $mysqli->connect_error); exit(); }
        //prepara e executa sql para buscar registro
        $stmt = $mysqli->prepare("SELECT * FROM produtos WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $meta = $stmt->result_metadata();
        while ($field = $meta->fetch_field()) {
            $parameters[] = &$row[$field->name];
        }

        call_user_func_array(array($stmt, 'bind_result'), $parameters);
        while ($stmt->fetch()) {
            foreach($row as $key => $val) {
                $x[$key] = $val;
            }
            $results[] = $x;
        }
        //retorna array em formato JSON para leitura via ajax
        echo json_encode( $results );

        $mysqli->close();
    } else {
        echo "ID nao encontrado.";
    }
}

//*****************************************************************************
// Metodo que salva ou atualiza form de cadastro do produto

function salvarForm() {
    //var_dump($_POST);
    if ( ! isset( $_POST ) || empty( $_POST ) ) {
        echo "Dados do formulário não chegaram no PHP.";
        exit;
    }
    //recupera dados do formulario html
    $id              = (int) $_POST["id"];
    $cod_barra       = $_POST["cod_barra"];
    $nome            = $_POST["nome"];
    $fabricante      = $_POST["fabricante"];
    $categoria       = $_POST["categoria"];
    $tipo_prod       = $_POST["tipo_prod"];
    $preco_venda     = $_POST["preco_venda"];
    $qtd_estoque     = $_POST["qtd_estoque"];
    $peso_gramas     = $_POST["peso_gramas"];
    $descricao       = $_POST["descricao"];
    $data_inclusao   = $_POST["data_inclusao"];
    $foto            = isset( $_FILES['foto'] ) ? $_FILES['foto'] : null;
    $nome_imagem= $_POST["nomeFoto"];
    $ativo           = $_POST["ativo"];

    //verifica dados do form
    $v = validarForm( $id, $cod_barra, $nome, $fabricante, $categoria, $tipo_prod, $preco_venda, $qtd_estoque, $peso_gramas, $descricao, $data_inclusao , $nome_imagem, $ativo);
    if ($v != null) {
        echo "Problema encontrado:<br>".$v;
        exit;
    }
    //envia a imagem para o diretorio
    if (! empty( $foto ) ) {
        $imagem_tmp   = $foto['tmp_name'];
        $nome_imagem  = $foto['name']; //basename($foto['name']);
        $diretorio    = $_SERVER['DOCUMENT_ROOT'].'/AV2/imagens/';
        $envia_imagem = $diretorio.$nome_imagem;

        if (! move_uploaded_file( $imagem_tmp, $envia_imagem ) ) {
            echo 'Erro ao enviar arquivo de imagem.';
            //echo "<br>Nome temporario do arquivo: ".$imagem_tmp."<br>Nome da Imagem: ".$nome_imagem."<br>Diretorio armazenamento: ".$diretorio."<br>envia: ".$envia_imagem;
            exit;
        }
    }
    //abre conexao com banco
    global $host, $user, $pass, $db;
    $mysqli = new mysqli( $host, $user, $pass, $db );
    if ( $mysqli->connect_errno ) { printf("Connect failed: %s\n", $mysqli->connect_error); exit(); }
    //prepara SQL para insert ou update dependendo do ID do form
    $sql = null;
    if ( $id > 1 ) {
        $sql = "UPDATE produtos SET cod_barra=?, nome=?, fabricante=?, categoria=?, tipo_prod=?, preco_venda=?, qtd_estoque=?, peso_gramas=?, descricao=?, data_inclusao=?, foto=?, ativo=? WHERE id=".$id;
    } else {
        $sql = "INSERT INTO produtos (cod_barra, nome, fabricante, categoria, tipo_prod, preco_venda, qtd_estoque, peso_gramas, descricao, data_inclusao, foto, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    }
    //prepara e executa sql para insert dos dados
    $stmt = $mysqli->prepare( $sql );
    $stmt->bind_param('sssssdidssss', $cod_barra, $nome, $fabricante, $categoria, $tipo_prod, $preco_venda, $qtd_estoque, $peso_gramas, $descricao, $data_inclusao, $nome_imagem , $ativo); 
    $stmt->execute();
    //verifica se SQL de update foi executado
    if ( $id > 1 ) {
        if ( $stmt->affected_rows > 0 ) {
            echo "Produto atualizado com sucesso!";
        } else {
            echo "Não houve necessidade de atualizar os dados, nenhum valor foi modificado.";
        }
    //verifica se SQL de insert foi executado
    } else {
        if ( $stmt->affected_rows > 0 ) {
            echo "Produto cadastrado com sucesso!";
        } else {
            echo "Error: ".$stmt;
            exit;
        }
    }
    $mysqli->close();
}

//*****************************************************************************
// Metodo que persiste dados do formulario em server-side
//
function validarForm( $id, $cod_barra, $nome, $fabricante, $categoria, $tipo_prod, $preco_venda, $qtd_estoque, $peso_gramas, $descricao, $data_inclusao, $foto , $ativo) {
    //validar campo código de barra
    if ( $cod_barra == null || trim( $cod_barra ) == "" ) {
        return "Campo Código de Barra deve ser preenchido.";
    }
    //validar campo nome
    if ( $nome == null || trim( $nome ) == "" ) {
        return "Campo Nome deve ser preenchido.";
    }
    //validar campo fabricante
    if ( $fabricante == null || trim( $fabricante ) == "" ) {
        return "Campo fabricante deve ser preenchido.";
    }
    //validar campo categoria
    if ( $categoria == null || trim( $categoria ) == "" ) {
        return "Campo categoria deve ser preenchido.";
    }
    //validar campo tipo_prod
    if ( $tipo_prod == null || trim( $tipo_prod ) == "" ) {
        return "Campo Tipo de Produto deve ser preenchido.";
    }
    //validar campo preco_venda
    if ( $preco_venda == null || trim( $preco_venda ) == "" ) {
        return "Campo Preço deve ser preenchido.";
    }
    //validar campo qtd_estoque
    if ( $qtd_estoque == null || trim( $qtd_estoque ) == "" ) {
        return "Campo Quantidade em Estoque deve ser preenchido.";
    }
    //validar campo peso_gramas
    if ( $peso_gramas == null || trim( $peso_gramas ) == "" ) {
        return "Campo Peso em Gramas deve ser preenchido.";
    }
    //validar campo descricao
    if ( $descricao == null || trim( $descricao ) == "" ) {
        return "Campo Descrição deve ser preenchido.";
    }
    //validar campo data de inclusão
    if ( $data_inclusao == null || trim( $data_inclusao ) == "" ) {
        return "Campo Data deve ser preenchido.";
    }
    //validar campo foto
    if ( empty( $foto ) ) {
        //return "Campo Foto deve ser preenchido.";
    }
    //validar campo ativo
    if ( $ativo == null || trim( $ativo ) == "" ) {
        return "Campo Ativo deve ser preenchido.";
    }
    return null;
}
