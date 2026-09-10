<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DAO\PessoaDAO;

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: pessoa-list.php");
    exit;
}

$dao = new PessoaDAO();

if ($dao->excluir((int)$id)) {

    echo "<script>
            alert('Pessoa excluída com sucesso!');
            window.location.href = 'pessoa-list.php';
          </script>";

} else {

    echo "<script>
            alert('Erro ao excluir pessoa!');
            window.location.href = 'pessoa-list.php';
          </script>";
}
?>