<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DAO\MovimentacaoDAO;

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    echo "<script>
            alert('Movimentação inválida.');
            window.location.href = 'movimentacao-list.php';
          </script>";
    exit;
}

$dao = new MovimentacaoDAO();

$dao->excluir($id);

echo "<script>
        alert('Movimentação excluída com sucesso!');
        window.location.href = 'movimentacao-list.php';
      </script>";