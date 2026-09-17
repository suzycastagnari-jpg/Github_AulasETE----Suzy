<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DAO\MovimentacaoDAO;
use App\Model\Movimentacao;

$pessoaId = (int) ($_POST['pessoa_id'] ?? 0);

$tipo = $_POST['tipo'] ?? '';

$valor = (float) ($_POST['valor'] ?? 0);

$descricao = trim($_POST['descricao'] ?? '');

$dataMovimentacao = $_POST['data_movimentacao'] ?? '';


if ($pessoaId <= 0) {

    echo "<script>
            alert('Selecione uma pessoa.');
            history.back();
          </script>";

    exit;
}


if (!in_array($tipo, ['entrada', 'saida'])) {

    echo "<script>
            alert('Tipo de movimentação inválido.');
            history.back();
          </script>";

    exit;
}


if ($valor <= 0) {

    echo "<script>
            alert('Informe um valor válido.');
            history.back();
          </script>";

    exit;
}


if ($dataMovimentacao === '') {

    echo "<script>
            alert('Informe a data da movimentação.');
            history.back();
          </script>";

    exit;
}


$movimentacao = new Movimentacao(
    $pessoaId,
    $tipo,
    $valor,
    $descricao !== '' ? $descricao : null,
    $dataMovimentacao
);


$dao = new MovimentacaoDAO();

$dao->inserir($movimentacao);


echo "<script>
        alert('Movimentação cadastrada com sucesso!');
        window.location.href = 'movimentacao-create.php';
      </script>";