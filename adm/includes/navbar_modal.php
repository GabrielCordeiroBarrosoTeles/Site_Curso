<?php
    require '../config.php'; // Importa as configurações do site
?>
   <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <style>
        /* Navbar */
        .top-nav {
            background-color: var(--brand);
            color: #fff;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .top-nav p {
            display: inline-block;
            margin-bottom: 0;
            margin-right: 10px;
        }

        .top-nav span,
        .top-nav i {
            vertical-align: middle;
        }

        .navbar {
            box-shadow: var(--shadow);
        }

        .social-icons a {
            width: 28px;
            height: 28px;
            display: inline-flex;
            color: #fff;
            background-color: rgba(255, 255, 255, 0.25);
            text-decoration: none;
            align-items: center;
            justify-content: center;
            border-radius: 100px;
        }

        .social-icons a:hover {
            background-color: #fff;
            color: var(--brand);
        }

        .navbar .navbar-nav .nav-link {
            color: var(--dark);
        }

        .navbar .navbar-nav .nav-link:hover {
            color: var(--brand);
        }

        .navbar .navbar-nav .nav-link.active {
            color: var(--brand);
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: 700;
        }

        .navbar-brand .dot {
            color: var(--brand);
        }

        .bg-cover {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <!-- Navbar 1 -->
<div class="top-nav" id="home" style="background-color: #2222ff;">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="col-auto">
                <p class="contact-info mb-0"><i class='bx bxs-envelope'></i> <?php echo $CompanyEmailAddress ; ?></p>
                <p class="contact-info mb-0"><i class='bx bxs-phone-call'></i> <?php echo $CompanyTelephone ; ?></p>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 576px) {
        .contact-info {
            font-size: 0.8rem;
        }
    }
</style>

    <!-- Navbar 2 -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.php">
            <a class="navbar-brand" href="home.php">
                <img src="../img/logo.png" alt="" srcset="" style="width:30px;"><!--Nome da empresa com a ultima palavra em destaque-->
                <?php echo $PrimeiraParte . ' '; ?><span style="color: #2222ff;"><?php echo $UltimaPalavra; ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php" style="color:black;">Home</a>
                    </li> 
                    <?php if (isset($_SESSION['user_tipo_usuario']) && ($_SESSION['user_tipo_usuario'] === 'adm' || $_SESSION['user_tipo_usuario'] === 'professor')): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal1"  aria-hidden="true" style="color:black;">Cad. estoque</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal2"  aria-hidden="true" style="color:black;">Cad. cliente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="exibir_aluno.php" style="color:black;">Exibir aluno</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user_tipo_usuario']) && ($_SESSION['user_tipo_usuario'] === 'adm' )): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal3"  aria-hidden="true" style="color:black;">Cad. Usuario</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="exibir_cursos.php" style="color:black;">Exibir cursos</a>
                    </li>
                    <?php if (isset($_SESSION['user_tipo_usuario']) && ($_SESSION['user_tipo_usuario'] === 'adm' || $_SESSION['user_tipo_usuario'] === 'operador')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="exibir_notasfiscais.php" style="color:black;">Exibir NF</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gerar_nota_fiscal.php" style="color:black;">Gerar NF</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <a href="logout.php" style="background-color: #2222ff;border: #2222ff" class="btn btn-brand ms-lg-3 text-light">
                    Sair
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </a>

            </div>
        </div>
    </nav>

  <!-- Modal Cadastro Estoque -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel" style="text-align:center">Cadastro de Estoque</h2>
                <button type="button" class="btn-close" style="color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="code.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" required>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="valorcompra" class="form-label">Valor de Compra:</label>
                            <input type="text" class="form-control" id="valorcompra" name="valorcompra" placeholder="Digite o preço da compra" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="valorvenda" class="form-label">Valor de Venda:</label>
                            <input type="text" class="form-control" id="valorvenda" name="valorvenda" placeholder="Digite o preço da venda" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="quantidade" class="form-label">Quantidade:</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Digite a quantidade" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="funcao" class="form-label">Função:</label>
                            <input type="text" class="form-control" id="funcao" name="funcao" placeholder="Digite a função" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="detalhe" class="form-label">Detalhe:</label>
                            <input type="text" class="form-control" id="detalhe" name="detalhe" placeholder="Digite o detalhe" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="marca" class="form-label">Marca:</label>
                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Digite a marca" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="peso" class="form-label">Peso:</label>
                            <input type="text" class="form-control" id="peso" name="peso" placeholder="Digite o peso" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem:</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="save_estoque" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-header {
        background-color: #2222ff;
        color: white;
    }
    .modal-title {
        margin: auto;
    }
    .btn-close {
        background-color: white;
        border: none;
    }
    .btn-primary {
        background-color: #2222ff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #6b3510;
    }
    .form-label {
        color: #2222ff;
    }
</style>


    <!-- Modal Cadastro Cliente -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel"  style="text-align:center">Cadastro de Cliente</h2>
                <button type="button" class="btn-close" style="color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="code.php" method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="text" class="form-control phone" id="telefone" name="telefone" placeholder="Digite o telefone" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="save_cliente" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-header {
        background-color: #2222ff;
        color: white;
    }
    .modal-title {
        margin: auto;
    }
    .btn-close {
        background-color: white;
        border: none;
    }
    .btn-primary {
        background-color: #2222ff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #6b3510;
    }
    .form-label {
        color: #2222ff;
    }
</style>


<!-- Modal Cadastro Usuário -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel"  style="text-align:center">Cadastro de Usuário</h2>
                <button type="button" class="btn-close" style="color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="cadastrar_usuario.php" method="post">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login:</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Digite o login" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cargo:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cargo" id="operador" value="operador" required>
                            <label class="form-check-label" for="operador">Operador</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="cargo" id="adm" value="adm" required>
                            <label class="form-check-label" for="adm">Administrador</label>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-header {
        background-color: #2222ff;
        color: white;
    }
    .modal-title {
        margin: auto;
    }
    .btn-close {
        background-color: white;
        border: none;
    }
    .btn-primary {
        background-color: #2222ff;
        border: none;
    }
    .btn-primary:hover {
        background-color: #6b3510;
    }
    .form-label {
        color:rgb(0, 0, 0);
    }
    .form-check-label {
        color:rgb(0, 0, 0);
    }
</style>



    <script>
        const dataAtual = new Date();
        const anoAtual = dataAtual.getFullYear();
        document.getElementById('anoAtual').innerHTML = anoAtual;
    </script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/app.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script>
        $(document).ready(function () { 
            var $seuCampoCpf = $("#cpf");
            $seuCampoCpf.mask('000.000.000-00', {reverse: true});
        });
        var behavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            }
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }
            };
            $('.phone').mask(behavior, options);
    </script>