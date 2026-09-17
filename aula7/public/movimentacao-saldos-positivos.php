<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DAO\MovimentacaoDAO;

$dao = new MovimentacaoDAO();

$saldos = $dao->saldosPositivos();

ob_start();

?>

<style>

    body {
        background: linear-gradient(135deg, #fff5fa, #f8f0ff);
    }

    .container {
        max-width: 1100px;
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

    .saldo-positivo {
        color: #28733d;
        font-weight: bold;
        font-size: 17px;
    }

    .icone-saldo {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background-color: #d8f3dc;
        color: #28733d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

</style>


<div class="container py-4">

    <!-- CABEÇALHO -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-graph-up-arrow me-2"></i>

                Saldos Positivos

            </h2>

            <p class="text-muted mb-0">

                Pessoas que possuem saldo positivo.

            </p>

        </div>


        <a
            href="movimentacao-create.php"
            class="btn btn-primary"
        >

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

                            <th>Saldo Positivo</th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (count($saldos) > 0): ?>

                        <?php foreach ($saldos as $saldo): ?>

                            <tr>

                                <td>

                                    <?= htmlspecialchars(
                                        $saldo['id']
                                    ) ?>

                                </td>


                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="icone-saldo">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                        <strong>

                                            <?= htmlspecialchars(
                                                $saldo['nome']
                                            ) ?>

                                        </strong>

                                    </div>

                                </td>


                                <td class="saldo-positivo">

                                    R$

                                    <?= number_format(
                                        (float) $saldo['saldo'],
                                        2,
                                        ',',
                                        '.'
                                    ) ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>


                    <?php else: ?>

                        <tr>

                            <td
                                colspan="3"
                                class="text-center text-muted py-5"
                            >

                                <i class="bi bi-info-circle me-1"></i>

                                Nenhuma pessoa possui saldo positivo.

                            </td>

                        </tr>

                    <?php endif; ?>

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


<?php

$content = ob_get_clean();

require "layout.php";

?>