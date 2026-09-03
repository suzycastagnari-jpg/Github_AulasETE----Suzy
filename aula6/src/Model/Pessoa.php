<?php
namespace App\Model;

class Pessoa{

    private ?int $id = null;       
    private string $nome;          
    private ?string $telefone = null;    
    private string $cpf;           
    private ?string $endereco = null;    
    private ?string $createdAt = null; 
    private ?string $updatedAt = null;


    // Getter e Setter do ID
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }


    // Getter e Setter do Nome
    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }


    // Getter e Setter do Telefone
    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): void
    {
        $this->telefone = $telefone;
    }


    // Getter e Setter do CPF
    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }


    // Getter e Setter do Endereço
    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(?string $endereco): void
    {
        $this->endereco = $endereco;
    }


    // Getter e Setter do CreatedAt
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }


    // Getter e Setter do UpdatedAt
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

}
?>