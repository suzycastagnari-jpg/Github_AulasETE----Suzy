<?php

namespace App\Model;

class Movimentacao
{
    private ?int $id = null;
    private int $pessoaId;
    private string $tipo;
    private float $valor;
    private ?string $descricao = null;
    private string $dataMovimentacao;
    private ?string $createdAt = null;

    public function __construct(
        int $pessoaId,
        string $tipo,
        float $valor,
        ?string $descricao,
        string $dataMovimentacao
    ) {
        $this->pessoaId = $pessoaId;
        $this->tipo = $tipo;
        $this->valor = $valor;
        $this->descricao = $descricao;
        $this->dataMovimentacao = $dataMovimentacao;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getPessoaId(): int
    {
        return $this->pessoaId;
    }

    public function setPessoaId(int $pessoaId): void
    {
        $this->pessoaId = $pessoaId;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getDataMovimentacao(): string
    {
        return $this->dataMovimentacao;
    }

    public function setDataMovimentacao(string $dataMovimentacao): void
    {
        $this->dataMovimentacao = $dataMovimentacao;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}