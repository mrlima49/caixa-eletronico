<?php
session_start();
require_once "./dbconfig.php";
require_once "./readhistorico.php";
if(isset($_SESSION['user'])){
    $id = $_SESSION['user'];
    $sql = "SELECT * FROM contas WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
    if($stmt->rowCount() > 0):
        $dados = $stmt->fetch();
        $titular = $dados['titular'];
        $agencia = $dados['agencia'];
        $conta = $dados['conta'];
        $saldo = $dados['saldo'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>saruBank</title>
    <style>
        table{
            border-collapse:collapse;
            text-align: center;
        }
        .green{
            color: green;
        }
        .red{
            color: red;
        }
    </style>
</head>
<body>
    <h1>SaruBank</h1>
    <p><strong>Titular: <?= $titular; ?></strong></p>
    <p><strong>Agência: <?= $agencia; ?></strong></p>
    <p><strong>Conta: <?= $conta; ?></strong></p>
    <p><strong>Saldo: <?= $saldo; ?></strong></p>
    <p><a href="sair.php">Sair</a></p>
    <hr>
    <a href="addop.php">Fazer operação</a>
    <h3>Movimentação/Extrato</h3>
    <table border="1" width="500">
        <thead>
            <tr>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <?php
            $sql = "SELECT * FROM historico WHERE id_conta = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $_SESSION['user']);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $userDatas = $stmt->fetchAll();
            }else{
                echo '<p><b>Sem lançamentos</b></p>';
            }
        ?>
        <tbody>
            <?php if(isset($userDatas)): foreach($userDatas as $userData): ?>
                <tr>
                    <td><?= date('d/m/Y H:i', strtotime($userData['data_op']));?></td>
                    <td>
                        <?php if($userData['tipo'] == '1'): ?>
                            <p class="green">+<?= $userData['valor']?></p>
                        <?php else: ?>
                            <p class="red">-<?= $userData['valor']?></p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php 
                endforeach; 
            endif;    
            ?>
        </tbody>
    </table>
<?php
    endif;
}else{
    header("location: login.php");
}
?>
</body>
</html>