<?php

class TransactionController
{
    private static $pdo;

    public function __construct()
    {
        self::$pdo = new PDO("mysql:host=localhost;dbname=sua_base_de_dados", "usuario", "senha");
    }

    // Método para inicializar rotas
    public static function init($app, $pdo)
    {
        self::$pdo = $pdo;

        // Rota para criar uma nova transação
        $app->post('/transacao', function ($request, $response) {
            $data = $request->getParsedBody();
            $descricao = $data['descricao'];
            $valor = $data['valor'];
            $dataTransacao = $data['data'];
            $tipoId = $data['tipo_id'];

            $sql = "INSERT INTO transacao (descricao, valor, data, tipo_id) VALUES (?, ?, ?, ?)";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$descricao, $valor, $dataTransacao, $tipoId]);

            $response->getBody()->write(json_encode(['status' => 'Transação criada com sucesso']));
            return $response->withHeader('Content-Type', 'application/json');
        });

        // Rota para listar transações
        $app->get('/transacao', function ($request, $response) {
            $sql = "SELECT t.*, tt.descricao AS tipo_descricao FROM transacao t 
                    JOIN tipo_transacao tt ON t.tipo_id = tt.id";
            $stmt = self::$pdo->query($sql);
            $transacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $response->getBody()->write(json_encode($transacoes));
            return $response->withHeader('Content-Type', 'application/json');
        });

        // Rota para editar uma transação
        $app->put('/transacao/{id}', function ($request, $response, $args) {
            $id = $args['id'];
            $data = $request->getParsedBody();
            $descricao = $data['descricao'];
            $valor = $data['valor'];
            $dataTransacao = $data['data'];
            $tipoId = $data['tipo_id'];

            $sql = "UPDATE transacao SET descricao = ?, valor = ?, data = ?, tipo_id = ? WHERE id = ?";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$descricao, $valor, $dataTransacao, $tipoId, $id]);

            $response->getBody()->write(json_encode(['status' => 'Transação atualizada com sucesso']));
            return $response->withHeader('Content-Type', 'application/json');
        });

        // Rota para excluir uma transação
        $app->delete('/transacao/{id}', function ($request, $response, $args) {
            $id = $args['id'];

            $sql = "DELETE FROM transacao WHERE id = ?";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute([$id]);

            $response->getBody()->write(json_encode(['status' => 'Transação excluída com sucesso']));
            return $response->withHeader('Content-Type', 'application/json');
        });
    }

    public function create()
    {
        $descricao = $_POST['descricao'];
        $valor = $_POST['valor'];
        $data = $_POST['data'];
        $tipo_id = $_POST['tipo_id'];

        $sql = "INSERT INTO transacao (descricao, valor, data, tipo_id) VALUES (?, ?, ?, ?)";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$descricao, $valor, $data, $tipo_id]);
    }

    public function readAll()
    {
        $sql = "SELECT t.*, tt.descricao AS tipo_descricao 
                FROM transacao t 
                JOIN tipo_transacao tt ON t.tipo_id = tt.id";
        $stmt = self::$pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id)
    {
        $descricao = $_POST['descricao'];
        $valor = $_POST['valor'];
        $data = $_POST['data'];
        $tipo_id = $_POST['tipo_id'];

        $sql = "UPDATE transacao SET descricao = ?, valor = ?, data = ?, tipo_id = ? WHERE id = ?";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$descricao, $valor, $data, $tipo_id, $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM transacao WHERE id = ?";
        $stmt = self::$pdo->prepare($sql);
        $stmt->execute([$id]);
    }
}
