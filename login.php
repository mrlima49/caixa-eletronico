<?php
session_start();
if(isset($_SESSION['msg'])):
    $msg = $_SESSION['msg'];
    ?>
    <script>
        alert("<?= $msg; ?>")
    </script>
    <?php
    session_unset();
endif;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <h1>Entar na conta</h1>
    <form action="processalogin.php" method="post">
        <p><input type="text" name="agencia" placeholder="Sua agencia" autofocus></p>
        <p><input type="text" name="conta" placeholder="Sua conta"></p>
        <p><input type="password" name="senha" placeholder="Sua senha"></p>
        <p><button name="btn">Entar</button></p>
    </form>
</body>
</html>