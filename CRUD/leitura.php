<?php
include "connection.php";

$arquivo = fopen("alunosImp3.csv", "r") or die("Não consegui abrir o arquivo, deu erro");

while(!feof($arquivo)) {
    $linha = fgets($arquivo);
    echo $linha;
    echo "<br>";
}

$q = mysqli_query($con, "INSERT INTO Alunos (nome, mat, datanasc) VALUES (?,?,?)");
while($r = mysqli_fetch_array($q)){ 
    $r['nome'];
    $r['mat'];
    $r['datanasc'];
}
fclose($arquivo);

?>