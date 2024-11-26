<?php
class Conexao {
    public static function getConexao() {
        try {
            $conexao = new PDO('mysql:host=localhost;dbname=etech', 'root', '');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexao;
        } catch (PDOException $e) {
            echo 'Erro de conexão: ' . $e->getMessage();
            exit;
        }
    }
}

?>
