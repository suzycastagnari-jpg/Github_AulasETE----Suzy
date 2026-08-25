<?php

require_once "Funcionario.php";

$joao = new Funcionario("João Filho", 1000, 100);
$joao->calcularDesconto();
$joao->mostrarDados();

$maria = new Funcionario("Maria Rute", 2000, 200);
$maria->calcularDesconto();
$maria->mostrarDados();

$jose = new Funcionario("José Salgado", 3000, 400);
$jose->calcularDesconto();
$jose->mostrarDados();

?>