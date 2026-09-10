<?php

namespace App\DAO;

use App\Model\Pessoa;
use App\Config\Conexao;
use PDO;

class PessoaDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Conexao::conectar();
    }

    // INSERT
    public function insert(Pessoa $pessoa): bool
    {
        $sql = "INSERT INTO pessoas (nome, telefone, cpf, endereco)
                VALUES (:nome, :telefone, :cpf, :endereco)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':nome' => $pessoa->getNome(),
            ':telefone' => $pessoa->getTelefone(),
            ':cpf' => $pessoa->getCpf(),
            ':endereco' => $pessoa->getEndereco()
        ]);
    }

    // LISTAR
    public function listar(): array
    {
        $sql = "SELECT id, nome, cpf, telefone, endereco
                FROM pessoas
                ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BUSCAR POR ID
    public function buscarPorId(int $id): ?Pessoa
    {
        $sql = "SELECT * FROM pessoas WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        $pessoa = new Pessoa(
            $dados['nome'],
            $dados['telefone'],
            $dados['cpf'],
            $dados['endereco']
        );

        $pessoa->setId($dados['id']);

        return $pessoa;
    }

    // EDITAR
    public function editar(Pessoa $pessoa): bool
    {
        $sql = "UPDATE pessoas
                SET nome = :nome,
                    telefone = :telefone,
                    cpf = :cpf,
                    endereco = :endereco
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':nome' => $pessoa->getNome(),
            ':telefone' => $pessoa->getTelefone(),
            ':cpf' => $pessoa->getCpf(),
            ':endereco' => $pessoa->getEndereco(),
            ':id' => $pessoa->getId()
        ]);
    }

    // EXCLUIR
    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM pessoas WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }
}