<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Utils/Formatter.php';

use App\DAO\PessoaDAO;
use App\Utils\Formatter;

$dao = new PessoaDAO();

$termo = trim($_GET['termo'] ?? '');

$pessoas = [];

if ($termo !== '') {
    $pessoas = $dao->pesquisar($termo);
}

ob_start();

?>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                Pesquisar Pessoa
            </h2>

            <p class="text-muted mb-0">
                Pesquise uma pessoa pelo nome ou CPF.
            </p>
        </div>

        <a href="pessoa-create.php" class="btn btn-primary">
            Nova Pessoa
        </a>

    </div>


    <!-- FORMULÁRIO DE PESQUISA -->

    <div class="card shadow-sm border-0 rounded-4 mb-4">

        <div class="card-body p-4">

            <form method="GET" action="pessoa-pesquisar.php">

                <div class="row g-3 align-items-end">

                    <div class="col-md-10">

                        <label for="termo" class="form-label fw-semibold">
                            Nome ou CPF
                        </label>

                        <input type="text" class="form-control" id="termo" name="termo"
                            value="<?= htmlspecialchars($termo) ?>" placeholder="Digite o nome ou CPF">

                    </div>

                    <div class="col-md-2">

                        <button type="submit" class="btn btn-primary w-100">
                            Pesquisar
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <?php if ($termo !== ''): ?>

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-body p-4">

                <h5 class="mb-3">
                    Resultado da pesquisa
                </h5>

                <?php if (count($pessoas) > 0): ?>

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

                                <?php foreach ($pessoas as $pessoa): ?>

                                    <tr>

                                        <td>
                                            <?= htmlspecialchars($pessoa['id']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($pessoa['nome']) ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                Formatter::formatCpf($pessoa['cpf'])
                                            ) ?>
                                        </td>

                                        <td>

                                            <?php

                                            $telefone = '';

                                            if (!empty($pessoa['telefone'])) {
                                                $telefone = Formatter::formatTelefone(
                                                    $pessoa['telefone']
                                                );
                                            }

                                            ?>

                                            <?= htmlspecialchars($telefone) ?>

                                        </td>

                                        <td>
                                            <?= htmlspecialchars(
                                                $pessoa['endereco'] ?? ''
                                            ) ?>
                                        </td>

                                        <td>

                                            <a href="pessoa-edit.php?id=<?= $pessoa['id'] ?>" class="btn btn-warning btn-sm">
                                                Editar
                                            </a>

                                            <a href="pessoa-excluir.php?id=<?= $pessoa['id'] ?>" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Tem certeza que deseja excluir esta pessoa?');">
                                                Excluir
                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                <?php else: ?>

                    <div class="alert alert-warning mb-0">

                        Nenhuma pessoa encontrada para:

                        <strong>
                            <?= htmlspecialchars($termo) ?>
                        </strong>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    <?php endif; ?>

</div>

<?php

$content = ob_get_clean();

require "layout.php";