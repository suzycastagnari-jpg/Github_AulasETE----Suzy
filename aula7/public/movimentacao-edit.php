<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DAO\MovimentacaoDAO;
use App\DAO\PessoaDAO;

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    echo "<script>
            alert('Movimentação inválida.');
            window.location.href = 'movimentacao-list.php';
          </script>";
    exit;
}

$movimentacaoDAO = new MovimentacaoDAO();
$pessoaDAO = new PessoaDAO();

$movimentacao = $movimentacaoDAO->buscarPorId($id);
$pessoas = $pessoaDAO->listar();

if (!$movimentacao) {
    echo "<script>
            alert('Movimentação não encontrada.');
            window.location.href = 'movimentacao-list.php';
          </script>";
    exit;
}

ob_start();
?>

<div class="container mt-4">

    <div class="mb-4">
        <h2>
            <i class="bi bi-pencil-square"></i>
            Editar Movimentação
        </h2>

        <p class="text-muted">
            Altere os dados da movimentação abaixo.
        </p>
    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <form action="movimentacao-editar.php" method="POST">

                <input
                    type="hidden"
                    name="id"
                    value="<?= $movimentacao['id'] ?>"
                >

                <!-- PESSOA -->
                <div class="mb-3">

                    <label for="pessoa_id" class="form-label">
                        Pessoa
                    </label>

                    <select
                        name="pessoa_id"
                        id="pessoa_id"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Selecione uma pessoa
                        </option>

                        <?php foreach ($pessoas as $pessoa): ?>

                            <option
                                value="<?= $pessoa['id'] ?>"
                                <?= $pessoa['id'] == $movimentacao['pessoa_id'] ? 'selected' : '' ?>
                            >
                                <?= htmlspecialchars($pessoa['nome']) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- TIPO -->
                <div class="mb-3">

                    <label for="tipo" class="form-label">
                        Tipo
                    </label>

                    <select
                        name="tipo"
                        id="tipo"
                        class="form-select"
                        required
                    >

                        <option
                            value="entrada"
                            <?= $movimentacao['tipo'] === 'entrada' ? 'selected' : '' ?>
                        >
                            Entrada
                        </option>

                        <option
                            value="saida"
                            <?= $movimentacao['tipo'] === 'saida' ? 'selected' : '' ?>
                        >
                            Saída
                        </option>

                    </select>

                </div>


                <!-- VALOR -->
                <div class="mb-3">

                    <label for="valor" class="form-label">
                        Valor
                    </label>

                    <input
                        type="number"
                        name="valor"
                        id="valor"
                        class="form-control"
                        step="0.01"
                        min="0.01"
                        value="<?= htmlspecialchars($movimentacao['valor']) ?>"
                        required
                    >

                </div>


                <!-- DATA -->
                <div class="mb-3">

                    <label for="data_movimentacao" class="form-label">
                        Data da Movimentação
                    </label>

                    <input
                        type="date"
                        name="data_movimentacao"
                        id="data_movimentacao"
                        class="form-control"
                        value="<?= $movimentacao['data_movimentacao'] ?>"
                        required
                    >

                </div>


                <!-- DESCRIÇÃO -->
                <div class="mb-3">

                    <label for="descricao" class="form-label">
                        Descrição
                    </label>

                    <textarea
                        name="descricao"
                        id="descricao"
                        class="form-control"
                        rows="4"
                    ><?= htmlspecialchars($movimentacao['descricao'] ?? '') ?></textarea>

                </div>


                <!-- BOTÕES -->
                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        <i class="bi bi-check-circle"></i>
                        Salvar Alterações
                    </button>

                    <a
                        href="movimentacao-list.php"
                        class="btn btn-secondary"
                    >
                        <i class="bi bi-arrow-left"></i>
                        Cancelar
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php

$content = ob_get_clean();

require "layout.php";