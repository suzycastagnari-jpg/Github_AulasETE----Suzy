<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Utils/Formatter.php';

use App\DAO\PessoaDAO;
use App\Utils\Formatter;

$dao = new PessoaDAO();


// QUANTIDADE DE PESSOAS POR PÁGINA
$porPagina = 5;


// PÁGINA ATUAL
$pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;


// EVITA PÁGINA 0 OU NÚMERO NEGATIVO
if ($pagina < 1) {
    $pagina = 1;
}


// TOTAL DE PESSOAS
$totalPessoas = $dao->contar();


// CALCULA TOTAL DE PÁGINAS
$totalPaginas = max(1, (int) ceil($totalPessoas / $porPagina));


// SE A PÁGINA INFORMADA FOR MAIOR QUE O TOTAL
if ($pagina > $totalPaginas) {
    $pagina = $totalPaginas;
}


// CALCULA O OFFSET
$offset = ($pagina - 1) * $porPagina;


// BUSCA AS PESSOAS DA PÁGINA ATUAL
$pessoas = $dao->listarPaginado($porPagina, $offset);


$content = '

<style>

    body {
        background: linear-gradient(135deg, #fff5fa, #f8f0ff);
    }

    .container {
        max-width: 1200px;
    }

    h2 {
        color: #c45a91;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #f1d8e8 !important;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead {
        background-color: #f3d9e8 !important;
    }

    .table thead th {
        color: #744d68;
        font-weight: 600;
        border-bottom: 2px solid #e4bfd3;
        padding: 15px;
    }

    .table tbody td {
        padding: 15px;
        color: #5f4a57;
        border-color: #f1e3eb;
    }

    .table-hover tbody tr:hover {
        background-color: #fff5fa;
    }

    .btn-primary {
        background-color: #d66b9d;
        border-color: #d66b9d;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #bd5688;
        border-color: #bd5688;
    }

    .btn-warning {
        background-color: #f2c76e;
        border-color: #f2c76e;
        color: #604b28;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-danger {
        background-color: #d96b7b;
        border-color: #d96b7b;
        border-radius: 8px;
        font-weight: 600;
    }

    .pagination .page-link {
        color: #c45a91;
        border-color: #f1d8e8;
    }

    .pagination .page-item.active .page-link {
        background-color: #d66b9d;
        border-color: #d66b9d;
        color: white;
    }

    .pagination .page-link:hover {
        background-color: #fff0f7;
        color: #bd5688;
    }

</style>


<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                <i class="bi bi-people-fill me-2"></i>
                Pessoas
            </h2>

            <p class="text-muted mb-0">
                Lista de pessoas cadastradas com paginação.
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

                    <thead>

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

    $cpfFormatado = Formatter::formatCpf($pessoa['cpf']);

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

                            <td colspan="6"
                                class="text-center text-muted py-4">

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


            <!-- PAGINAÇÃO -->

            <div class="d-flex justify-content-between align-items-center mt-4">

                <div class="text-muted">

                    Página ' . $pagina . ' de ' . $totalPaginas . '

                </div>


                <nav>

                    <ul class="pagination mb-0">


                        <!-- ANTERIOR -->

                        <li class="page-item ' . ($pagina <= 1 ? 'disabled' : '') . '">

                            <a
                                class="page-link"
                                href="?pagina=' . ($pagina - 1) . '"
                            >
                                Anterior
                            </a>

                        </li>
';


for ($i = 1; $i <= $totalPaginas; $i++) {

    $content .= '

                        <li class="page-item ' . ($i == $pagina ? 'active' : '') . '">

                            <a
                                class="page-link"
                                href="?pagina=' . $i . '"
                            >
                                ' . $i . '
                            </a>

                        </li>

    ';
}


$content .= '

                        <!-- PRÓXIMA -->

                        <li class="page-item ' . ($pagina >= $totalPaginas ? 'disabled' : '') . '">

                            <a
                                class="page-link"
                                href="?pagina=' . ($pagina + 1) . '"
                            >
                                Próxima
                            </a>

                        </li>


                    </ul>

                </nav>

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