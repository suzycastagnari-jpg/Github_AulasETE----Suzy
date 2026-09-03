<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Models\Pessoa;
use App\DAO\PessoaDAO;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // receber os dados
    $nome = $_POST['nome'] ?? '';
    $telefone = $_POST['telefone'] ?? null;
    $cpf = $_POST['cpf'] ?? '';
    $endereco = $_POST['endereco'] ?? null;

    // converter nome e endereço
    $nome = mb_strtoupper($nome, 'UTF-8');

    if ($endereco !== null) {
        $endereco = mb_strtoupper($endereco, 'UTF-8');
    }

    // criar objeto Pessoa
    $pessoa = new Pessoa($nome, $telefone, $cpf, $endereco);

    // criar PessoaDAO
    $dao = new PessoaDAO();

    // inserir no banco
    if ($dao->insert($pessoa)) {

        echo "<script>
                alert('Dados salvos com sucesso!');
                window.location.href = 'pessoa-create.php';
              </script>";

    } else {

        echo "<script>
                alert('Erro ao salvar dados!');
                window.location.href = 'pessoa-create.php';
              </script>";
    }
}

?>