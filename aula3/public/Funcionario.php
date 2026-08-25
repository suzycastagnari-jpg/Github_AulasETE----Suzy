<?php

class Funcionario {
    private $nome;
    private $salario;
    private $previdencia;
    private $descontos;


    public function __construct($nome, $salario, $previdencia){
        $this->nome = $nome;
        $this->salario = $salario;
        $this->previdencia = $previdencia;
        $this->descontos = 0;
    }


    public function calcularDesconto(){
        $this->descontos = round(($this->salario * 0.275) + $this->previdencia, 2);
        return $this->descontos;
    }


    public function mostrarDados(){
        echo "Nome: " . $this->nome . "<br>";
        echo "Salário: R$ " . $this->salario . "<br>";
        echo "Previdência: R$ " . $this->previdencia . "<br>";
        echo "Valor do desconto: R$ " . $this->descontos . "<br><br>";
    }
}
?>