<?php 
 
$content = ' 

<br>

<style>
    body {
        background: linear-gradient(135deg, #fff5fa, #f8f0ff);
    }

    .container {
        background: #ffffff;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(180, 100, 160, 0.15);
        border: 1px solid #f1d8e8;
    }

    h2 {
        color: #c45a91;
        text-align: center;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .form-label {
        color: #744d68;
        font-weight: 600;
    }

    .form-control {
        border: 1px solid #e6c9dc;
        border-radius: 10px;
        padding: 11px;
        background-color: #fffafd;
    }

    .form-control:focus {
        border-color: #d477a7;
        box-shadow: 0 0 0 0.2rem rgba(212, 119, 167, 0.15);
    }

    .btn-primary {
        background-color: #d66b9d;
        border-color: #d66b9d;
        border-radius: 10px;
        padding: 10px 25px;
    }

    .btn-primary:hover {
        background-color: #bd5688;
        border-color: #bd5688;
    }

    .btn-secondary {
        background-color: #eadde7;
        border-color: #eadde7;
        color: #694f62;
        border-radius: 10px;
        padding: 10px 25px;
    }

    .btn-secondary:hover {
        background-color: #d9c6d4;
        border-color: #d9c6d4;
        color: #513c4b;
    }
</style>
 
<div class="container mt-4"> 
 
    <h2>Cadastro de Pessoa</h2> 
 
    <form action="pessoa-cadastrar.php" method="POST"> 
 
        <div class="mb-3"> 
            <label for="nome" class="form-label">Nome</label> 
            <input  
                type="text"  
                class="form-control"  
                id="nome"  
                name="nome"  
                maxlength="100"  
                required> 
        </div> 
 
        <div class="mb-3"> 
            <label for="telefone" class="form-label">Telefone</label> 
            <input  
                type="text"  
                class="form-control"  
                id="telefone"  
                name="telefone"  
                maxlength="15"> 
        </div> 
 
        <div class="mb-3"> 
            <label for="cpf" class="form-label">CPF</label> 
            <input  
                type="text"  
                class="form-control"  
                id="cpf"  
                name="cpf"  
                maxlength="11"  
                required> 
        </div> 
 
        <div class="mb-3"> 
            <label for="endereco" class="form-label">Endereço</label> 
            <input  
                type="text"  
                class="form-control"  
                id="endereco"  
                name="endereco"  
                maxlength="255"> 
        </div> 
 
        <button type="submit" class="btn btn-primary"> 
            Cadastrar 
        </button> 
 
        <a href="index.php" class="btn btn-secondary"> 
            Voltar 
        </a> 
 
    </form> 
 
</div> 
'; 
 
include "layout.php"; 
?>