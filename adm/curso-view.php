<?php
    // Inclui a verificação de sessão, que deve ser o primeiro a ser chamado
    require 'session_check.php'; // Corrija o caminho caso o arquivo 'session_check.php' esteja em outro diretório

    // Inclua a conexão com o banco de dados, se necessário
    require '../dbcon.php';
?>
 

<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
            ::-webkit-scrollbar{
                width: 10px;
            }::-webkit-scrollbar-track{
                background: #E7DFDD;
                border-radius: 30px;
            }::-webkit-scrollbar-thumb{
                background: #000000;
                border-radius: 30px;
            }
        </style>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">

    <title>Detalhes do cliente</title>
</head>
<body>
<?php include './includes/navbar_modal.php'?><!--Navbar-->
    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Dados do curso 
                            <a href="exibir_cursos.php" class="btn btn-danger float-end">
                                VOLTAR
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $curso_id = mysqli_real_escape_string($mysqli, $_GET['id']);
                            $query = "SELECT curso.*, professor.nome AS professor_nome, professor.sobrenome AS professor_sobrenome FROM curso 
                                      JOIN professor ON curso.id_prof = professor.id 
                                      WHERE curso.id='$curso_id'";
                            $query_run = mysqli_query($mysqli, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $curso = mysqli_fetch_array($query_run);
                                    $titulo = $curso['titulo'];
                                    $img = $curso['imagem_capa'];
                                    $valor = $curso['valor'];
                                    $descricao = $curso['descricao'];
                                    $categoria = $curso['categoria'];
                                    $dataDeCriacao = $curso['data_criacao'];
                                    $professor = $curso['professor_nome'] . ' ' . $curso['professor_sobrenome'];
                                ?>
                                     <div class="mb" style="text-align:center;align-items:center;">
                                        
                                        <img class="form"  height='250px' src="img/categoria/<?=$img;?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Título:</label>
                                        <p class="form-control">
                                            <?=$titulo;?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Descrição:</label>
                                        <p class="form-control">
                                            <?=$descricao;?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Professor:</label>
                                        <p class="form-control">
                                            <?=$professor;?>
                                        </p>
                                    </div>
    
                                    <div class="mb-3">
                                        <label>Categoria:</label>
                                        <p class="form-control">
                                            <?=$categoria;?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Valor do Curso:</label>
                                        <p class="form-control">
                                            <?=$valor;?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Data de Criação do curso:</label>
                                        <p class="form-control">
                                            <?=date('d/m/Y', strtotime($dataDeCriacao));?>
                                        </p>
                                    </div>

                                <?php
                            }
                            else
                            {
                                echo "<h4>Nenhum ID encontrado</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
        var $seuCampoCpf = $("#cpf");
        $seuCampoCpf.mask('000.000.000-00', {reverse: true});
    });
</script>
</body>
</html>