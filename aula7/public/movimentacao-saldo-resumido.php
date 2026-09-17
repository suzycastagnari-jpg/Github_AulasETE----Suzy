<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DAO\MovimentacaoDAO;

$dao = new MovimentacaoDAO();

$dados = $dao->saldoResumido();

ob_start();
?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2>
                <i class="bi bi-bar-chart-line"></i>
                Saldo Resumido
            </h2>

            <p class="text-muted">
                Resumo financeiro das pessoas cadastradas
            </p>
        </div>

        <a href="movimentacao-create.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Nova Movimentação
        </a>

    </div>


    <div class="card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Pessoa</th>
                            <th>Total de Entradas</th>
                            <th>Total de Saídas</th>
                            <th>Saldo</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php if (empty($dados)): ?>

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhuma movimentação encontrada.
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($dados as $item): ?>

                            <tr>

                                <td>
                                    <?= $item['id'] ?>
                                </td>

                                <td>
                                    <strong>
                                        <?= htmlspecialchars($item['nome']) ?>
                                    </strong>
                                </td>

                                <td class="text-success">
                                    <strong>
                                        R$
                                        <?= number_format(
                                            $item['total_entradas'],
                                            2,
                                            ',',
                                            '.'
                                        ) ?>
                                    </strong>
                                </td>

                                <td class="text-danger">
                                    <strong>
                                        R$
                                        <?= number_format(
                                            $item['total_saidas'],
                                            2,
                                            ',',
                                            '.'
                                        ) ?>
                                    </strong>
                                </td>

                                <td>

                                    <?php if ($item['saldo'] > 0): ?>

                                        <span class="badge bg-success fs-6">
                                            R$
                                            <?= number_format(
                                                $item['saldo'],
                                                2,
                                                ',',
                                                '.'
                                            ) ?>
                                        </span>

                                    <?php elseif ($item['saldo'] < 0): ?>

                                        <span class="badge bg-danger fs-6">
                                            R$
                                            <?= number_format(
                                                $item['saldo'],
                                                2,
                                                ',',
                                                '.'
                                            ) ?>
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-secondary fs-6">
                                            R$
                                            0,00
                                        </span>

                                    <?php endif; ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php

$content = ob_get_clean();

require "layout.php";