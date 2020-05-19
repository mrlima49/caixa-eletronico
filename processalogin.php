<?php

session_start();
require_once "./dbconfig.php";

if(isset($_POST['btn'])){
    $agencia = filter_input(INPUT_POST, 'agencia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $conta = filter_input(INPUT_POST, 'conta', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if($agencia && $conta && $senha){
        $sql = "SELECT * FROM contas WHERE agencia = ? and conta = ? and senha = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $agencia);
        $stmt->bindValue(2, $conta);
        $stmt->bindValue(3, $senha);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $dados = $stmt->fetch();
            $_SESSION['user'] = $dados['id'];
            header("location: index.php");
        }else{
            echo "falhou";
        }
    }else{
        $_SESSION['msg'] = "preencha os campos abaixos";
        header("location: login.php");
    }

}else{
    header("location: login.php");
}