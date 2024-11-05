<?php
require_once 'controllers/TransacaoController.php';

$transacaoController = new TransacaoController();

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'create':
            $transacaoController->create();
            break;
        case 'update':
            $transacaoController->update($_POST['id']);
            break;
        case 'delete':
            $transacaoController->delete($_POST['id']);
            break;
    }
}

$transacoes = $transacaoController->readAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Transações</title>
</head>
<body>
    <h1>Gerenciamento de Transações Financeiras</h1>
    <form method="POST" action="">
        <input type="hidden" name="id" id="id">
        <label>Descrição: <input type="text" name="descricao" required></label>
        <label>Valor: <input type="number" name="valor" step="0.01" required></label>
        <label>Data: <input type="date" name="data" required></label>
        <label>Tipo: 
            <select name="tipo_id" required>
                <option value="1">Receita</option>
                <option value="2">Despesa</option>
            </select>
        </label>
        <button type="submit" name="action" value="create">Adicionar</button>
    </form>

    <h2>Lista de Transações</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transacoes as $transacao): ?>
                <tr>
                    <td><?php echo $transacao['id']; ?></td>
                    <td><?php echo $transacao['descricao']; ?></td>
                    <td><?php echo $transacao['valor']; ?></td>
                    <td><?php echo $transacao['data']; ?></td>
                    <td><?php echo $transacao['tipo_descricao']; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $transacao['id']; ?>">
                            <button type="submit" name="action" value="delete">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
