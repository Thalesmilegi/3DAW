<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nome = $_GET["estado"];

    if($nome == "RJ" || $nome == "rj" || $nome == "Rj"){
        echo 'Rio de janeiro, Angra, Caxias';
    }else if($nome == "SP" || $nome == "sp" || $nome == 'Sp'){
        echo 'São paulo, Campinas';
    }else{
        echo 'Algo de errado não está certo!!!';
    }
    
    
}

?>