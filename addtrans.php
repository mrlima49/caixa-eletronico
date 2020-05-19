<?php

session_start();
require_once "./dbconfig.php";

if(isset($_POST['btn'])){
    $tipo = filter_input(INPUT_POST,'tipo', FILTER_SANITIZE_NUMBER_INT);
    $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT);
    echo "{$tipo} {$valor} {$_SESSION['user']}";
    if($tipo && $valor){
        $sql = "INSERT INTO historico (id_conta, tipo, valor, data_op) VALUES (?,?,?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $_SESSION['user']);
        $stmt->bindValue(2, $tipo);
        $stmt->bindValue(3, $valor);
        $stmt->execute();
        if($stmt->rowCount() > 0){
           if($tipo == '1'){
               $sql = "UPDATE contas SET saldo = saldo + ? WHERE id = ?";
               $stmt = $pdo->prepare($sql);
               $stmt->bindValue(1, $valor);
               $stmt->bindValue(2, $_SESSION['user']);
               $stmt->execute(); 
           }else{
                $sql = "UPDATE contas SET saldo = saldo - ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(1, $valor);
                $stmt->bindValue(2, $_SESSION['user']);
                $stmt->execute(); 
           }
        }else{

        }
        header("location: index.php");
    }    
}else{
    echo "não entrou";
}
