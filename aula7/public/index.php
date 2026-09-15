<?php

ob_start();
?>

<style>
    .inicio {
        padding: 30px 0;
    }

    .inicio-header {
        background: linear-gradient(135deg, #b84d8b, #8e5bb7);
        color: white;
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(100, 60, 100, 0.15);
    }

    .inicio-header h1 {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .inicio-header p {
        margin-bottom: 0;
        font-size: 17px;
        opacity: 0.9;
    }

    .card-inicio {
        background: #ffffff;
        border: none;
        border-radius: 18px;
        padding: 25px;
        height: 100%;
        box-shadow: 0 6px 20px rgba(100, 60, 100, 0.10);
        transition: 0.3s;
    }

    .card-inicio:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(100, 60, 100, 0.16);
    }

    .icone-card {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        margin-bottom: 18px;
    }

    .icone-pessoas {
        background-color: #f9e1ee;
        color: #b84d8b;
    }

    .icone-movimentacoes {
        background-color: #e9def6;
        color: #8e5bb7;
    }

    .card-inicio h4 {
        color: #604b5b;
        font-weight: bold;
    }

    .card-inicio p {
        color: #8b7282;
    }

    .btn-inicio {
        border-radius: 10px;
        padding: 9px 16px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-top: 8px;
    }

    .btn-pessoas {
        background-color: #d66b9d;
        color: white;
    }

    .btn-pessoas:hover {
        background-color: #bd5688;
        color: white;
    }

    .btn-movimentacoes {
        background-color: #8e5bb7;
        color: white;
    }

    .btn-movimentacoes:hover {
        background-color: #75469d;
        color: white;
    }

    .atalhos {
        margin-top: 30px;
    }

    .atalhos h3 {
        color: #604b5b;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .atalho {
        background: #ffffff;
        border-radius: 14px;
        padding: 18px;
        text-decoration: none;
        color: #604b5b;
        display: block;
        box-shadow: 0 4px 15px rgba(100, 60, 100, 0.08);
        transition: 0.3s;
        height: 100%;
    }

    .atalho:hover {
        transform: translateY(-3px);
        color: #b84d8b;
        box-shadow: 0 7px 20px rgba(100, 60, 100, 0.13);
    }

    .atalho i {
        font-size: 22px;
        margin-right: 8px;
    }
</style>


<div class="inicio">

    <!-- APRESENTAÇÃO -->
    <div class="inicio-header">

        <h1>Bem-vindo ao Sistema Financeiro!</h1>

        <p>
            Gerencie pessoas e movimentações financeiras
            de forma simples e organizada.
        </p>

    </div>


    <!-- CARDS PRINCIPAIS -->
    <div class="row g-4">

        <!-- PESSOAS -->
        <div class="col-md-6">

            <div class="card-inicio">

                <div class="icone-card icone-pessoas">
                    <i class="bi bi-people-fill"></i>
                </div>

                <h4>Pessoas</h4>

                <p>
                    Cadastre, consulte, edite e exclua
                    pessoas cadastradas no sistema.
                </p>

                <a href="pessoa-list.php" class="btn-inicio btn-pessoas">
                    <i class="bi bi-list-ul"></i>
                    Ver Pessoas
                </a>

            </div>

        </div>


        <!-- MOVIMENTAÇÕES -->
        <div class="col-md-6">

            <div class="card-inicio">

                <div class="icone-card icone-movimentacoes">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <h4>Movimentações</h4>

                <p>
                    Controle entradas, saídas e consulte
                    os saldos das movimentações.
                </p>

                <a href="movimentacao-list.php" class="btn-inicio btn-movimentacoes">
                    <i class="bi bi-bar-chart-fill"></i>
                    Ver Movimentações
                </a>

            </div>

        </div>

    </div>

        </div>

    </div>

</div>


<?php

$content = ob_get_clean();

require "layout.php";

require "footer.php";

?>