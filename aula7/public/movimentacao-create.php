<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DAO\PessoaDAO;

$pessoaDAO = new PessoaDAO();

$pessoas = $pessoaDAO->listar();

ob_start();

?>

<div class="container py-4">

    <div class="mb-4">

        <h2 class="fw-bold">
            Nova Movimentação
        </h2>

        <p class="text-muted">
            Cadastre uma nova movimentação financeira.
        </p>

    </div>


    <div class="card shadow-sm border-0 rounded-4">

        <div class="card-body p-4">

            <form
                method="POST"
                action="movimentacao-cadastrar.php"
            >

                <!-- PESSOA -->

                <div class="mb-3">

                    <label
                        for="pessoa_id"
                        class="form-label fw-semibold"
                    >
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

                            <option value="<?= $pessoa['id'] ?>">

                                <?= htmlspecialchars($pessoa['nome']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- TIPO -->

                <div class="mb-3">

                    <label
                        for="tipo"
                        class="form-label fw-semibold"
                    >
                        Tipo de movimentação
                    </label>

                    <select
                        name="tipo"
                        id="tipo"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Selecione o tipo
                        </option>

                        <option value="entrada">
                            Entrada
                        </option>

                        <option value="saida">
                            Saída
                        </option>

                    </select>

                </div>


                <!-- VALOR -->

                <div class="mb-3">

                    <label
                        for="valor"
                        class="form-label fw-semibold"
                    >
                        Valor
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            R$
                        </span>

                        <input
                            type="number"
                            name="valor"
                            id="valor"
                            class="form-control"
                            step="0.01"
                            min="0.01"
                            placeholder="0,00"
                            required
                        >

                    </div>

                </div>


                <!-- DATA -->

                <div class="mb-3">

                    <label
                        for="data_movimentacao"
                        class="form-label fw-semibold"
                    >
                        Data da movimentação
                    </label>

                    <input
                        type="date"
                        name="data_movimentacao"
                        id="data_movimentacao"
                        class="form-control"
                        value="<?= date('Y-m-d') ?>"
                        required
                    >

                </div>


                <!-- DESCRIÇÃO -->

                <div class="mb-4">

                    <label
                        for="descricao"
                        class="form-label fw-semibold"
                    >
                        Descrição
                    </label>

                    <textarea
                        name="descricao"
                        id="descricao"
                        class="form-control"
                        rows="3"
                        placeholder="Digite uma descrição para a movimentação"
                    ></textarea>

                </div>


                <!-- BOTÕES -->

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Salvar Movimentação
                    </button>

                    <a
                        href="index.php"
                        class="btn btn-secondary"
                    >
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

?>