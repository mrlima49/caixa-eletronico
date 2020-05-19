<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer Transação</title>
</head>
<body>
    <form action="addtrans.php" method="post">
        <p>Tipo de transação:</p>
        <select name="tipo">
            <option value="1">Deposito</option>
            <option value="2">Saque</option>
        </select>
        <p><input type="number" name="valor" placeholder="Valor:"></p>
        <p><input type="submit" name="btn"></p>
    </form>
</body>
</html>