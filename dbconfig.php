<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=caixa_eletronico", "root", "");
}catch(PDOException $e){
    echo "Error: ".$e->getMessage();
}