<?php
    //dados de conexao com banco de dados do sistema
    $host   = "localhost";
    $user   = "root";
    $pass   = "";
    $db     = "loja";

    global $host, $user, $pass, $db;
    $mysqli = new mysqli( $host, $user, $pass, $db );
    if ( $mysqli->connect_errno ) { printf("Connect failed: %s\n", $mysqli->connect_error); exit(); }  
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="styles.css" async>
    <link rel="stylesheet" type="text/css" href="css/styles.css" async>
    <script src="scripts.js"></script>
</head>
<body style="background: #212529 !important;">
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
    <div id="conteudo" style="margin-top: 20px;">
    <div id="msg-php" class="no-display"></div>

    <form style="font-size: 14px;" method="POST" enctype="multipart/form-data" onSubmit="salvarForm(); return false;" onsubmit="isValidCod();" id="frmCrud">
        <fieldset>
            <legend style="font-size: 16px;">Código de Barra:</legend>
            <input id="cod_barra" type="text" class="input-text" required placeholder="Digite o código de barra do produto..." name="cod_barra" onFocus="inputOn(this)" onBlur="inputOff(this)"/>
            <legend style="font-size: 16px;">Nome:</legend>
            <input id="nome" type="text" class="input-text" required placeholder="Digite seu nome aqui..." name="nome" onFocus="inputOn(this)" onBlur="inputOff(this)"/>
            <legend style="font-size: 16px;">Fabricante:</legend>
            <input id="fabricante" type="text"class="input-text" required placeholder="Digite o fabricante do produto aqui..." name="fabricante" onFocus="inputOn(this)" onBlur="inputOff(this)"/>
            <legend style="font-size: 16px;">Categoria:</legend>
            <select name="categoria" id="categoria" onFocus="inputOn(this)" onBlur="inputOff(this)">
                <option value="">-- Escolha uma categoria --</option>
                    <?php
                        $res = mysqli_query( $mysqli, "SELECT cod_categoria, nome FROM categoria ORDER BY nome ");
                        while ( $row = mysqli_fetch_assoc( $res ) ) {
                            echo '<option value="'.$row['cod_categoria'].'">'.$row['nome'].'</option>';
                        }
                    ?>
            </select>
            <legend style="font-size: 16px;">Tipo de Produto:</legend>
            <select name="tipo_prod" id="tipo_prod" onFocus="inputOn(this)" onBlur="inputOff(this)">
                <option value="">-- Escolha o tipo de produto --</option>
                <?php
                        $res = mysqli_query( $mysqli, "SELECT cod_tipoprod, nome FROM tipo_prod ORDER BY nome ");
                        while ( $row = mysqli_fetch_assoc( $res ) ) {
                            echo '<option value="'.$row['cod_tipoprod'].'">'.$row['nome'].'</option>';
                        }
                    ?>
            </select>
            <legend style="font-size: 16px;">Preço:</legend>
            <input id="preco_venda" type="int" class="input-text" required placeholder="Digite preço do produto aqui..." name="preco_venda" onFocus="inputOn(this)" onBlur="inputOff(this)"/>
        </fieldset>
        <fieldset>    
            <legend style="font-size: 16px;">Quantidade em Estoque:</legend>
            <input id="qtd_estoque" type="int" class="input-text" required placeholder="Digite quantidade de produto em estoque aqui..." name="qtd_estoque" onFocus="inputOn(this)" onBlur="inputOff(this)"/>
            <legend style="font-size: 16px;">Peso em gramas:</legend>
            <input id="peso_gramas" type="int" class="input-text" required placeholder="Digite o peso em gramas do produto aqui..." name="peso_gramas" onFocus="inputOn(this)" onBlur="inputOff(this)"/>
            <legend style="font-size: 16px;">Descrição:</legend>
            <input id="descricao" type="text" class="input-text" required placeholder="Digite a descrição do produto aqui..." name="descricao" onFocus="inputOn(this)" onBlur="inputOff(this)"/>
            <legend style="font-size: 16px;">Data da Inclusão:</legend>
            <input id="data_inclusao" type="date" class="input-text" required placeholder="Digite a data de hoje aqui..." name="data_inclusao" onFocus="inputOn(this)" onBlur="inputOff(this)"/>
            <legend style="font-size: 16px;">Ativo:</legend>
            <select style="margin-bottom: 20px" name="ativo" id="ativo" onFocus="inputOn(this)" onBlur="inputOff(this)">
                <option value="">-- O produto está ativo? --</option>
                <option value="s">Sim</option>
                <option value="n">Não</option>
        </fieldset>
        <fieldset>
            <legend>Foto:</legend>
            <input type="file" id="foto" name="foto" class="input-text" accept="image/png, image/jpeg"/>
            <img id="image" class="thumb" />
        </fieldset>
        <input id="id" type="hidden" value="-1" />
        <input id="nomeFoto" type="hidden" value="" />
        <input type="reset" class="button" id="btnLimpar" value="Limpar" />
        <input type="submit" class="button" id="btnSalvar" value="Salvar" />
    </form>
</div>

<div id="lista">
    <script type="text/javascript">carregarLista();</script>
</div>
<script type="text/javascript">
    const categoriaSelect = document.querySelector('#cod_categoria');
    const tipoprodSelect = document.querySelector('#cod_tipoprod');
    categoriaSelect.addEventListener('change', e => {
        fetch(`./tipoprod.ajax.php?cod_categoria=${e.target.value}`,{method:'GET'})
        .then(dados => dados.json()) //descodifica a resposta
        .then(dados => {
            tipoprodSelect.innerHTML = '';
            dados.forEach(e=>{
                const option = document.createElement('option');
                option.innerText = e.nome;
                tipoprodSelect.appendChild(option);
            })
            console.log()
        }) // exibi a resposta
        .catch(err => console.log(err));
    });
    
</script>

<p class="rodape"></p>
</body>
</html>