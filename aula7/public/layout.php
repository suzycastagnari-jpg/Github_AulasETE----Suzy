<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema Financeiro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* FUNDO DA PÁGINA */
        body {
            background: linear-gradient(135deg, #fff5fa, #f8f0ff) !important;
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(90deg, #000000, #8e5bb7) !important;
            padding: 14px 20px;
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .navbar .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            margin-left: 8px;
            border-radius: 8px;
            padding: 8px 14px !important;
            transition: 0.3s;
        }

        .navbar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        /* MENU DROPDOWN */
        .dropdown-menu {
            border: none;
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 8px 20px rgba(100, 60, 100, 0.15);
        }

        .dropdown-item {
            border-radius: 8px;
            padding: 10px 14px;
            color: #604b5b;
            transition: 0.3s;
        }

        .dropdown-item:hover {
            background-color: #f9e8f2;
            color: #b84d8b;
        }

        /* CONTEÚDO */
        .container {
            margin-bottom: 40px;
        }

        /* BOTÃO DO MENU MOBILE */
        .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 8px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container-fluid">

            <a class="navbar-brand" href="/index.php">
                Sistema Financeiro
            </a>

            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSistema">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSistema">

                <ul class="navbar-nav me-auto">

                    <!-- MENU PESSOAS -->
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown">

                            Pessoas
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item"
                                   href="/pessoa-create.php">
                                    Cadastrar
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="/pessoa-list.php">
                                    Listar
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="/pessoa-paginado.php">
                                    Listar Paginado
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="/pessoa-pesquisar.php">
                                    Pesquisar
                                </a>
                            </li>

                        </ul>
                    </li>


                    <!-- MENU MOVIMENTAÇÕES -->
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           role="button"
                           data-bs-toggle="dropdown">

                            Movimentações
                        </a>

                        <ul class="dropdown-menu">

                            <li>
                                <a class="dropdown-item"
                                   href="/movimentacao-create.php">
                                    Nova
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="/movimentacao-list.php">
                                    Listar
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="/movimentacao-saldos-positivos.php">
                                    Saldos Positivos
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                   href="/movimentacao-saldo-resumido.php">
                                    Saldo Resumido
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>

            </div>
        </div>
    </nav>


    <!-- CONTEÚDO DA PÁGINA -->
    <div class="container mt-4">

        <?php
        echo isset($content) ? $content : "";
        ?>

    </div>


    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>