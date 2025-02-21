<?php
    require '../config.php'; // Importa as configurações do site

    // Inclua a conexão com o banco de dados, se necessário
    require '../dbcon.php';
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
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <img src="../img/logo.png" alt="" srcset="" style="width:30px;">
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
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal1" aria-hidden="true" style="color:black;">Cad. curso</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal2" aria-hidden="true" style="color:black;">Cad. cliente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="exibir_aluno.php" style="color:black;">Exibir aluno</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link" href="exibir_cursos.php" style="color:black;">Exibir cursos</a>
                    </li>
                    <?php if (isset($_SESSION['user_tipo_usuario']) && ($_SESSION['user_tipo_usuario'] === 'adm' || $_SESSION['user_tipo_usuario'] === 'operador')): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal3" aria-hidden="true" style="color:black;">Matricular</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="exibir_notasfiscais.php" style="color:black;">Exibir NF</a>
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

  <!-- Modal Cadastro Curso -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel" style="text-align:center">Cadastro de Curso</h2>
                <button type="button" class="btn-close" style="color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
    <form action="code.php" method="post" enctype="multipart/form-data">
        <div class="mb-3" id="preview-container" style="display: none; ">
            <label for="preview" class="form-label">Pré-visualização:</label>
            <img id="preview" src="#" alt="Pré-visualização da imagem" style="max-width: 100%; height: auto; border: 2px solid #2222ff; border-radius: 10px; margin-top: 10px;">
        </div>
        <style>
            @media (max-width: 576px) {
            #preview {
                max-width: 100%;
                height: auto;
            }
            }
        </style>
        <div class="mb-3">
            <label for="imagem_capa" class="form-label">Imagem da capa:</label>
            <input type="file" class="form-control" id="imagem_capa" name="imagem_capa" required>
        </div>
        
        <script>
            document.getElementById('imagem_capa').addEventListener('change', function(event) {
                const [file] = event.target.files;
                const previewContainer = document.getElementById('preview-container');
                const preview = document.getElementById('preview');
                if (file) {
                    preview.src = URL.createObjectURL(file);
                    previewContainer.style.display = 'block';
                } else {
                    preview.src = '#';
                    previewContainer.style.display = 'none';
                }
            });
        </script>
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o titulo do curso" required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="descicao" class="form-label">Descrição:</label>
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="valorDoCurso" class="form-label">Valor do curso:</label>
                <input type="text" class="form-control" id="valorDoCurso" name="valorDoCurso" placeholder="Digite o valor do curso" required>
                <script>
                    $(document).ready(function(){
                        $('#valorDoCurso').mask('#.##0,00', {reverse: true});
                    });
                </script>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="categoria" class="form-label">Categoria:</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    <option value="" disabled selected>Selecione a categoria</option>
                    <option value="Programação">Programação</option>
                    <option value="Banco de Dados">Banco de Dados</option>
                    <option value="Marketing Digital">Marketing Digital</option>
                    <option value="Design UX/UI">Design UX/UI</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="professor" class="form-label">Professor:</label>
                <select class="form-control" id="professor" name="id_prof" required>
                    <option value="" disabled selected>Selecione o professor</option>
                    <?php
                        $query = "SELECT id, nome, sobrenome FROM professor";
                        $result = mysqli_query($mysqli, $query);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='{$row['id']}'>{$row['nome']} {$row['sobrenome']}</option>";
                            }
                        } else {
                            echo "<option value=''>Erro na conexão</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" name="save_curso" class="btn btn-primary">Enviar</button>
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


<!-- Modal Matricular Aluno -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel"  style="text-align:center">Matricular Aluno</h2>
                <button type="button" class="btn-close" style="color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="code.php" method="post">
                    <div class="mb-3">
                        <label for="aluno" class="form-label">Aluno:</label>
                        <select class="form-control" id="aluno" name="aluno" required>
                            <option value="" disabled selected>Selecione o aluno</option>
                            <?php
                                $query = "SELECT aluno.id, aluno.nome, aluno.sobrenome, aluno.email, usuario.login FROM aluno INNER JOIN usuario ON aluno.id_usuario = usuario.id";
                                $result = mysqli_query($mysqli, $query);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id']}' data-email='{$row['email']}' data-login='{$row['login']}'>{$row['nome']} {$row['sobrenome']}</option>";
                                    }
                                } else {
                                    echo "<option value=''>Erro na conexão</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="login_aluno" class="form-label">Login:</label>
                            <input type="text" class="form-control" id="login_aluno" name="login_aluno" placeholder="Login do aluno" style="background-color: #e9ecef;" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email_aluno" class="form-label">Email do Aluno:</label>
                            <input type="text" class="form-control" id="email_aluno" name="email_aluno" placeholder="Email do aluno" style="background-color: #e9ecef;" readonly>
                        </div>
                        <script>
                            document.getElementById('aluno').addEventListener('change', function() {
                                var selectedOption = this.options[this.selectedIndex];
                                var email = selectedOption.getAttribute('data-email');
                                var login = selectedOption.getAttribute('data-login');
                                document.getElementById('email_aluno').value = email;
                                document.getElementById('login_aluno').value = login;
                            });
                        </script>
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

<!-- Modal Cadastro Aluno -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel"  style="text-align:center">Cadastro de Aluno</h2>
                <button type="button" class="btn-close" style="color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="code.php" method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="sobrenome" class="form-label">Sobrenome:</label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Digite o sobrenome" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sobrenome" class="form-label">Login:</label>
                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Digite o sobrenome" required>
                        </div>
                        <div class="col-md-6 mb-3">
                        <label for="sobrenome" class="form-label">Senha:</label>
                        <input type="password" class="form-control" id="sobrenome" name="sobrenome" placeholder="Digite o sobrenome" required>
                        </div>
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