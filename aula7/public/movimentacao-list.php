<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DAO\MovimentacaoDAO;

$dao = new MovimentacaoDAO();

$movimentacoes = $dao->listar();

ob_start();

?>

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
        padding: 15px;
        border-bottom: 2px solid #e4bfd3;
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

    .badge-entrada {
        background-color: #d8f3dc;
        color: #28733d;
        padding: 7px 12px;
        border-radius: 20px;
    }

    .badge-saida {
        background-color: #f8d7da;
        color: #9b2635;
        padding: 7px 12px;
        border-radius: 20px;
    }

    /* BOTÕES DE AÇÃO */

    .btn-editar {
        background-color: #fff0c7;
        color: #8a6500;
        border: 1px solid #f0d98c;
        border-radius: 8px;
    }

    .btn-editar:hover {
        background-color: #f5df9f;
        color: #6f5200;
    }

    .btn-excluir {
        background-color: #f8d7da;
        color: #9b2635;
        border: 1px solid #efb9be;
        border-radius: 8px;
    }

    .btn-excluir:hover {
        background-color: #efb9be;
        color: #7d1e2b;
    }
</style>


<div class="container py-4">

    <!-- CABEÇALHO -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-arrow-left-right me-2"></i>

                Movimentações

            </h2>

            <p class="text-muted mb-0">

                Lista de movimentações financeiras cadastradas.

            </p>

        </div>


        <a href="movimentacao-create.php" class="btn btn-primary">

            <i class="bi bi-plus-circle me-1"></i>

            Nova Movimentação

        </a>

    </div>


    <!-- TABELA -->

    <div class="card border-0 shadow-lg rounded-4">

        <div class="card-body p-4">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Pessoa</th>

                            <th>Tipo</th>

                            <th>Valor</th>

                            <th>Data</th>

                            <th>Descrição</th>

                            <th>Ações</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php if (count($movimentacoes) > 0): ?>

                            <?php foreach ($movimentacoes as $movimentacao): ?>

                                <tr>

                                    <!-- ID -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $movimentacao['id']
                                        ) ?>

                                    </td>


                                    <!-- PESSOA -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $movimentacao['pessoa_nome']
                                        ) ?>

                                    </td>


                                    <!-- TIPO -->

                                    <td>

                                        <?php if (
                                            $movimentacao['tipo'] === 'entrada'
                                        ): ?>

                                            <span class="badge-entrada">

                                                <i class="bi bi-arrow-down-circle me-1"></i>

                                                Entrada

                                            </span>

                                        <?php else: ?>

                                            <span class="badge-saida">

                                                <i class="bi bi-arrow-up-circle me-1"></i>

                                                Saída

                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    <!-- VALOR -->

                                    <td class="fw-semibold">

                                        R$

                                        <?= number_format(
                                            (float) $movimentacao['valor'],
                                            2,
                                            ',',
                                            '.'
                                        ) ?>

                                    </td>


                                    <!-- DATA -->

                                    <td>

                                        <?= date(
                                            'd/m/Y',
                                            strtotime(
                                                $movimentacao['data_movimentacao']
                                            )
                                        ) ?>

                                    </td>


                                    <!-- DESCRIÇÃO -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $movimentacao['descricao'] ?? ''
                                        ) ?>

                                    </td>


                                    <!-- AÇÕES -->

                                    <td>

                                        <div class="d-flex gap-2">

                                            <!-- EDITAR -->

                                            <a href="movimentacao-edit.php?id=<?= $movimentacao['id'] ?>"
                                                class="btn btn-sm btn-editar" title="Editar movimentação">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            <!-- EXCLUIR -->

                                            <a href="movimentacao-excluir.php?id=<?= $movimentacao['id'] ?>"
                                                class="btn btn-sm btn-excluir" title="Excluir movimentação"
                                                onclick="return confirm('Tem certeza que deseja excluir esta movimentação?');">

                                                <i class="bi bi-trash"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>


                        <?php else: ?>

                            <tr>

                                <td colspan="7" class="text-center text-muted py-5">

                                    <i class="bi bi-info-circle me-1"></i>

                                    Nenhuma movimentação cadastrada.

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<!-- BOOTSTRAP ICONS -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


<?php

$content = ob_get_clean();

require "layout.php";

?>