<?php
require_once '../config/database.php';

class Transaction {
    public function create($descricao, $valor, $data, $tipo_id) {
        global $pdo;
        $sql = "INSERT INTO transacao (descricao, valor, data, tipo_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$descricao, $valor, $data, $tipo_id]);
    }

    public function readAll() {
        global $pdo;
        $sql = "SELECT t.*, tt.descricao AS tipo_descricao FROM transacao t 
                JOIN tipo_transacao tt ON t.tipo_id = tt.id";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $descricao, $valor, $data, $tipo_id) {
        global $pdo;
        $sql = "UPDATE transacao SET descricao = ?, valor = ?, data = ?, tipo_id = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$descricao, $valor, $data, $tipo_id, $id]);
    }

    public function delete($id) {
        global $pdo;
        $sql = "DELETE FROM transacao WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>

