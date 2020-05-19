<?php

require_once "./dbconfig.php";
$sql = "SELECT FROM historico valor, data_op WHERE id_conta = ?";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $_SESSION['user']);
$stmt->execute();
$info = $stmt->fetchAll();


