<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Utils/Formatter.php';

use App\DAO\PessoaDAO;
use App\Utils\Formatter;

$dao = new PessoaDAO();

$pessoas = $dao->listar();

$content = '
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-people-fill me-2"></i>
                Pessoas
            </h2>

            <p class="text-muted mb-0">
                Lista de pessoas cadastradas.
            </p>
        </div>

        <a href="pessoa-create.php" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i>
            Nova Pessoa
        </a>

    </div>

    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                            <th>Endereço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
';

foreach ($pessoas as $pessoa) {

    // Formatar CPF
    $cpfFormatado = Formatter::formatCpf($pessoa['cpf']);

    // Formatar telefone
    $telefoneFormatado = '';

    if (!empty($pessoa['telefone'])) {
        $telefoneFormatado = Formatter::formatTelefone(
            $pessoa['telefone']
        );
    }

    $content .= '
                        <tr>

                            <td>
                                ' . htmlspecialchars($pessoa['id']) . '
                            </td>

                            <td>
                                ' . htmlspecialchars($pessoa['nome']) . '
                            </td>

                            <td>
                                ' . htmlspecialchars($cpfFormatado) . '
                            </td>

                            <td>
                                ' . htmlspecialchars($telefoneFormatado) . '
                            </td>

                            <td>
                                ' . htmlspecialchars($pessoa['endereco'] ?? '') . '
                            </td>

                            <td>

                                <a
                                    href="pessoa-edit.php?id=' . $pessoa['id'] . '"
                                    class="btn btn-warning btn-sm"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                    Editar
                                </a>

                                <a
                                    href="pessoa-excluir.php?id=' . $pessoa['id'] . '"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm(\'Tem certeza que deseja excluir esta pessoa?\');"
                                >
                                    <i class="bi bi-trash"></i>
                                    Excluir
                                </a>

                            </td>

                        </tr>
    ';
}

if (count($pessoas) === 0) {

    $content .= '
                        <tr>

                            <td colspan="6" class="text-center text-muted py-4">

                                <i class="bi bi-info-circle me-1"></i>

                                Nenhuma pessoa cadastrada.

                            </td>

                        </tr>
    ';
}

$content .= '

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>
';

include "layout.php";

?>