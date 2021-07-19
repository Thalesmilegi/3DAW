
//*****************************************************************************
// Metodo que inclui/altera acoes de elementos da pagina depois que a pagina foi carregada
//
window.onload = function() {
	//script para mostrar um preview da imagem do upload
	document.getElementById("foto").onchange = function () {
		var reader = new FileReader();

		reader.onload = function (e) {
			document.getElementById("image").src = e.target.result; //obtem info do campo foto
		};
		//carrega a imagem na tela
		reader.readAsDataURL(this.files[0]);
	};

	//prepara botao Limpar na acao de Editar produto
	document.getElementById("btnLimpar").onclick = function () {
		restauraForm();
	};
}

function restauraForm() {
	//limpa quadro preview imagem
	document.getElementById('image').src 		= '';
	//limpa os campos id e nomeFoto usados no update
	document.getElementById('id').value  		= "-1";
	document.getElementById('nomeFoto').value  	= "";
	//retorna o label original dos botoes
	document.getElementById('btnLimpar').value 	= "Limpar";
	document.getElementById('btnSalvar').value 	= "Salvar";
}

//*****************************************************************************
// Metodo que altera a cor do input quando recebe o foco
//
function inputOn( obj ) {
	obj.style.backgroundColor = "#ffffff";
}

//*****************************************************************************
// Metodo que altera a cor do input quando perde o foco
//
function inputOff( obj ) {
	obj.style.backgroundColor = "#7e83a2";
}

//*****************************************************************************
// Metodo que carrega lista de produtos cadastrados
//
function carregarLista() {
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
      		document.getElementById('lista').innerHTML = this.responseText;
    	} else {
    		document.getElementById('lista').innerHTML = "Erro na execucao do Ajax";
    	}
  	};
  	xhttp.open("POST", "crud.php", true);
  	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.send("action=lista");
}

//*****************************************************************************
// Metodo que carrega lista de produtos cadastrados
//
function carregarProduto( obj ) {
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
      		var resultado = JSON.parse( this.responseText );
      		//preenche form com dados do produto para alteracao
      		document.getElementById('id').value 		= resultado[0].id;
			document.getElementById('cod_barra').value  = resultado[0].cod_barra;
      		document.getElementById('nome').value 		= resultado[0].nome;
      		document.getElementById('fabricante').value = resultado[0].fabricante;
      		document.getElementById('categoria').value 	= resultado[0].categoria;
			document.getElementById('tipo_prod').value 	= resultado[0].tipo_prod;
			document.getElementById('preco_venda').value = resultado[0].preco_venda;
			document.getElementById('qtd_estoque').value = resultado[0].qtd_estoque;
			document.getElementById('peso_gramas').value = resultado[0].peso_gramas;
			document.getElementById('descricao').value = resultado[0].descricao;
			document.getElementById('data_inclusao').value = resultado[0].data_inclusao;
      		document.getElementById('image').src 		= "/AV2/imagens/"+resultado[0].foto;
      		document.getElementById('nomeFoto').value 	= resultado[0].foto;
			document.getElementById('ativo').value = resultado[0].ativo;
      		//deixa o foco no campo nome para edicao
      		document.getElementById('nome').focus();
      		//modifica acao do botao limpar para voltar
      		document.getElementById('btnLimpar').value 	 = "Voltar";
      		//modifica acao do botao salvar para atualizar
      		document.getElementById('btnSalvar').value 	 = "Atualizar";
    	} else {
    		document.getElementById('msg-php').innerHTML = "Erro na execucao do Ajax";
    	}
  	};
  	xhttp.open("POST", "crud.php", true);
  	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.send("action=buscar&id="+obj);
}

function isValidCod(cod_barra){
    var sum;
    var rest;
    sum = 0;
    if (cod_barra == "00000000000") return false;

    for (i=1; i<=9; i++) sum = sum + parseInt(cod_barra.substring(i-1, i)) * (11 - i);
    rest = (sum * 10) % 11;

    if ((rest == 10) || (rest == 11))  rest = 0;
    if (rest != parseInt(cod_barra.substring(9, 10)) ) return false;

    sum = 0;
    for (i = 1; i <= 10; i++) sum = sum + parseInt(cod_barra.substring(i-1, i)) * (12 - i);
    rest = (sum * 10) % 11;

    if ((rest == 10) || (rest == 11))  rest = 0;
    if (rest != parseInt(cod_barra.substring(10, 11) ) ) return false;
    return true;
}

//*****************************************************************************
// Metodo que salva (ou atualiza) form de cadastro do produto
//
function salvarForm() {
	var xhttp;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
    		//limpa o formulario
    		restauraForm();
    		document.getElementById('frmCrud').reset();
    		//exibe mensagem de sucesso na tela por alguns segundos
      		document.getElementById('msg-php').innerHTML = this.responseText;
      		document.getElementById('msg-php').classList.remove("no-display");
      		document.getElementById('msg-php').classList.add("msg-php");
      		hideMsg();
  			//atualiza lista de produtos
  			carregarLista();
    	} else {
    		document.getElementById('msg-php').innerHTML = "Erro na execucao do Ajax";
    	}
  	};
  	//recupera valores do form para enviar via ajax
  	var formData = new FormData();
  	formData.append("id", document.getElementById("id").value);
	formData.append("cod_barra", document.getElementById("cod_barra").value);
  	formData.append("nome", document.getElementById("nome").value);
  	formData.append("fabricante", document.getElementById("fabricante").value);
  	formData.append("categoria", document.getElementById("categoria").value);
	formData.append("tipo_prod", document.getElementById("tipo_prod").value);
	formData.append("preco_venda", document.getElementById("preco_venda").value);
	formData.append("qtd_estoque", document.getElementById("qtd_estoque").value);
	formData.append("peso_gramas", document.getElementById("peso_gramas").value);
	formData.append("descricao", document.getElementById("descricao").value);
	formData.append("data_inclusao", document.getElementById("data_inclusao").value);
  	formData.append("foto", document.getElementById("foto").files[0]);
  	formData.append("nomeFoto", document.getElementById("nomeFoto").value);
	formData.append("ativo", document.getElementById("ativo").value);
  	//submete para server-side
  	//xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	xhttp.open("POST", "crud.php?action=salvar", true);
  	xhttp.send( formData );
}

//*****************************************************************************
// Metodo que oculta as mensagens de alerta na tela
//
function hideMsg() {
	setTimeout(function() {
      	document.getElementById('msg-php').classList.add("no-display"); 
    }, 5000);
}



