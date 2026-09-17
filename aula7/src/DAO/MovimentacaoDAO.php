<?php

namespace App\DAO;

use App\Config\Conexao;
use App\Model\Movimentacao;
use PDO;

class MovimentacaoDAO
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = Conexao::conectar();
    }

    // CADASTRAR MOVIMENTAÇÃO
    public function inserir(Movimentacao $movimentacao): bool
    {
        $sql = "INSERT INTO movimentacoes
                (
                    pessoa_id,
                    tipo,
                    valor,
                    descricao,
                    data_movimentacao
                )
                VALUES
                (
                    :pessoa_id,
                    :tipo,
                    :valor,
                    :descricao,
                    :data_movimentacao
                )";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(
            ':pessoa_id',
            $movimentacao->getPessoaId(),
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':tipo',
            $movimentacao->getTipo(),
            PDO::PARAM_STR
        );

        $stmt->bindValue(
            ':valor',
            $movimentacao->getValor()
        );

        $stmt->bindValue(
            ':descricao',
            $movimentacao->getDescricao(),
            PDO::PARAM_STR
        );

        $stmt->bindValue(
            ':data_movimentacao',
            $movimentacao->getDataMovimentacao(),
            PDO::PARAM_STR
        );

        return $stmt->execute();
    }


    // LISTAR MOVIMENTAÇÕES
    public function listar(): array
    {
        $sql = "SELECT
                    m.id,
                    m.pessoa_id,
                    p.nome AS pessoa_nome,
                    m.tipo,
                    m.valor,
                    m.descricao,
                    m.data_movimentacao
                FROM movimentacoes m
                INNER JOIN pessoas p
                    ON p.id = m.pessoa_id
                ORDER BY m.id DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // LISTAR SALDOS POSITIVOS
    public function saldosPositivos(): array
    {
        $sql = "SELECT
                    p.id,
                    p.nome,
                    COALESCE(
                        SUM(
                            CASE
                                WHEN m.tipo = 'entrada' THEN m.valor
                                WHEN m.tipo = 'saida' THEN -m.valor
                                ELSE 0
                            END
                        ),
                        0
                    ) AS saldo
                FROM pessoas p
                INNER JOIN movimentacoes m
                    ON m.pessoa_id = p.id
                GROUP BY p.id, p.nome
                HAVING saldo > 0
                ORDER BY saldo DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // SALDO RESUMIDO
    public function saldoResumido(): array
    {
        $sql = "SELECT
                p.id,
                p.nome,

                COALESCE(
                    SUM(
                        CASE
                            WHEN m.tipo = 'entrada' THEN m.valor
                            ELSE 0
                        END
                    ),
                    0
                ) AS total_entradas,

                COALESCE(
                    SUM(
                        CASE
                            WHEN m.tipo = 'saida' THEN m.valor
                            ELSE 0
                        END
                    ),
                    0
                ) AS total_saidas,

                COALESCE(
                    SUM(
                        CASE
                            WHEN m.tipo = 'entrada' THEN m.valor
                            WHEN m.tipo = 'saida' THEN -m.valor
                            ELSE 0
                        END
                    ),
                    0
                ) AS saldo

            FROM pessoas p

            INNER JOIN movimentacoes m
                ON m.pessoa_id = p.id

            GROUP BY p.id, p.nome

            ORDER BY p.nome ASC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // BUSCAR MOVIMENTAÇÃO POR ID
    public function buscarPorId(int $id): ?array
    {
        $sql = "SELECT
                m.id,
                m.pessoa_id,
                p.nome AS pessoa_nome,
                m.tipo,
                m.valor,
                m.descricao,
                m.data_movimentacao
            FROM movimentacoes m
            INNER JOIN pessoas p
                ON p.id = m.pessoa_id
            WHERE m.id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ?: null;
    }


    // ATUALIZAR MOVIMENTAÇÃO
    public function atualizar(
        int $id,
        int $pessoaId,
        string $tipo,
        float $valor,
        ?string $descricao,
        string $dataMovimentacao
    ): bool {

        $sql = "UPDATE movimentacoes
            SET
                pessoa_id = :pessoa_id,
                tipo = :tipo,
                valor = :valor,
                descricao = :descricao,
                data_movimentacao = :data_movimentacao
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(
            ':id',
            $id,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':pessoa_id',
            $pessoaId,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':tipo',
            $tipo,
            PDO::PARAM_STR
        );

        $stmt->bindValue(
            ':valor',
            $valor
        );

        $stmt->bindValue(
            ':descricao',
            $descricao,
            PDO::PARAM_STR
        );

        $stmt->bindValue(
            ':data_movimentacao',
            $dataMovimentacao,
            PDO::PARAM_STR
        );

        return $stmt->execute();
    }


    // EXCLUIR MOVIMENTAÇÃO
    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM movimentacoes
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(
            ':id',
            $id,
            PDO::PARAM_INT
        );

        return $stmt->execute();
    }
}