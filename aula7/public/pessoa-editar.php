<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Model\Pessoa;
use App\DAO\PessoaDAO;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'] ?? '';
    $telefone = $_POST['telefone'] ?? null;
    $cpf = $_POST['cpf'] ?? '';
    $endereco = $_POST['endereco'] ?? null;

    $nome = mb_strtoupper($nome, 'UTF-8');

    if ($endereco !== null) {
        $endereco = mb_strtoupper($endereco, 'UTF-8');
    }

    $pessoa = new Pessoa(
        $nome,
        $telefone,
        $cpf,
        $endereco
    );

    $pessoa->setId((int)$id);

    $dao = new PessoaDAO();

    if ($dao->editar($pessoa)) {

        echo "<script>
                alert('Pessoa atualizada com sucesso!');
                window.location.href = 'pessoa-list.php';
              </script>";

    } else {

        echo "<script>
                alert('Erro ao atualizar pessoa!');
                window.location.href = 'pessoa-list.php';
              </script>";
    }
}
?>