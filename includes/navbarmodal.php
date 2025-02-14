<?php
    require 'config.php'; // Importa as configurações do site
?>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet"><!--Importante, faz os icons aparecerem no footrer-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="css/navbarmodal.css">


<!-- Navbar 1 -->
<div class="top-nav" id="home">
    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <div class="col-auto">
                <p class="contact-info mb-0"><i class='bx bxs-envelope'></i> <?php echo $CompanyEmailAddress ; ?></p>
                <p class="contact-info mb-0"><i class='bx bxs-phone-call'></i> <?php echo $CompanyTelephone ; ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Navbar 2 -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top" id="navbar2">
    <div class="container">
        <a class="navbar-brand" id="navbarBrand" href="index.php" >
            <img src="./img/logo.png" id="logo" alt="" srcset="">
            <!--Nome da empresa com a ultima palavra em destaque-->
            <?php echo $PrimeiraParte . ' '; ?><span style="color: #2222ff;">&nbsp;<?php echo $UltimaPalavra; ?></span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <p class="p">
                        <a class="link" href="index.php">Home</a>
                    </p>
                </li>
                <?php
                require 'dbcon.php';
                $query = "SELECT DISTINCT id, categoria FROM curso WHERE categoria IN ('Programação', 'Banco de Dados');";
                $query_run = mysqli_query($mysqli, $query);

                $funcoes = array(); // Array para armazenar as funções únicas

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $estoque) {
                        // Verifica se a função já foi adicionada ao array
                        if (!in_array($estoque['categoria'], $funcoes)) {
                            $funcoes[] = $estoque['categoria']; // Adiciona a função única ao array
                            ?>
                            <li class="nav-item">
                                <p class="p">
                                    <a class="link" href="cursos.php?id=<?= $estoque['id']; ?>">
                                        <?= $estoque['categoria']; ?>
                                    </a>
                                </p>
                            </li>
                            <?php
                        }
                    }
                } else {
                    echo "<h5>Nenhum aluno cadastrado</h5>";
                }
                ?>
                <li> 
                    <p>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"class="link botao">Login</a>
                    </p>
                    
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Modal Login-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="container-fluid">
                    <div class="row gy-4">
                        <div class="col-lg-4 col-sm-12 bg-cover" style="background-image: url('img/img1.png'); min-height: 250px;"></div>
                        <div class="col-lg-8">
                            <form class="p-lg-5 col-12 row g-3" action="receber_login.php" method="post">
                                <div>
                                    <h1>Login
                                        <a href="./" class="btn btn-danger float-end">VOLTAR</a>
                                    </h1>
                                    <p>Registre aqui seu login no sistema</p>
                                </div>
                                <div class="col-lg-12">
                                    <label for="userName" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="login" id="userName" aria-describedby="emailHelp">
                                </div>
                                <div class="col-12">
                                    <label for="userPassword" class="form-label">Senha</label>
                                    <input type="password" class="form-control" name="senha" id="userPassword" aria-describedby="emailHelp">
                                </div>   
                                <div class="col-12">
                                    <button type="submit" class="text-light link botao login-btn">Logar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

