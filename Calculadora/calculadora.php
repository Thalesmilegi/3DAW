<?php 
    include("calculadora.html");
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $op = $_POST['op'];

    if($num1 != NULL || $num2 != NULL){

        switch($op){
            case "soma":
                $resultado = $num1 + $num2;
                echo "<font style='color:white; margin-left: 47.7%;'>O resultado da soma é: $resultado </font>";
            break;
            case "sub":
                $resultado = $num1 - $num2;
                echo "<font style='color:white; margin-left: 47.7%;'>O resultado da subtração é: $resultado </font>";
            break;
            case "mult":
                $resultado = $num1 * $num2;
                echo "<font style='color:white; margin-left: 47.7%;'>O resultado da multiplição é: $resultado </font>";
            break;
            case "div":
                $resultado = $num1 / $num2;
                echo "<font style='color:white; margin-left: 47.7%;'>O resultado da divisão é: $resultado </font>";
            break;
        }
    }else{
        echo "Preencha os campos vázios!";
    }

?>