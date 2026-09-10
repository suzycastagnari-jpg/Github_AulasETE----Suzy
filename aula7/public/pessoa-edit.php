<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DAO\PessoaDAO;

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: pessoa-list.php");
    exit;
}

$dao = new PessoaDAO();

$pessoa = $dao->buscarPorId((int)$id);

if (!$pessoa) {
    echo "Pessoa não encontrada.";
    exit;
}

$content = '
<div class="container mt-4">

    <h2>Editar Pessoa</h2>

    <form action="pessoa-editar.php" method="POST">

        <input type="hidden" name="id" value="' . htmlspecialchars($pessoa->getId()) . '">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>

            <input
                type="text"
                class="form-control"
                id="nome"
                name="nome"
                maxlength="100"
                value="' . htmlspecialchars($pessoa->getNome()) . '"
                required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>

            <input
                type="text"
                class="form-control"
                id="telefone"
                name="telefone"
                maxlength="15"
                value="' . htmlspecialchars($pessoa->getTelefone() ?? '') . '">
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>

            <input
                type="text"
                class="form-control"
                id="cpf"
                name="cpf"
                maxlength="11"
                value="' . htmlspecialchars($pessoa->getCpf()) . '"
                required>
        </div>

        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>

            <input
                type="text"
                class="form-control"
                id="endereco"
                name="endereco"
                maxlength="255"
                value="' . htmlspecialchars($pessoa->getEndereco() ?? '') . '">
        </div>

        <button type="submit" class="btn btn-success">
            Salvar Alterações
        </button>

        <a href="pessoa-list.php" class="btn btn-secondary">
            Voltar
        </a>

    </form>

</div>
';

include "layout.php";
?>