<?php
    // Inclui a verificação de sessão, que deve ser o primeiro a ser chamado
    require 'session_check.php'; 

    // Inclua a conexão com o banco de dados, se necessário
    require '../dbcon.php';

    // Verificação de cargo
    if (!isset($_SESSION['user_tipo_usuario']) || ($_SESSION['user_tipo_usuario'] !== 'adm' && $_SESSION['user_tipo_usuario'] !== 'professor')) {
        // Redirecione para uma página de erro ou exiba uma mensagem de acesso negado
        header('Location: erro_acesso.php'); // Página de erro personalizada
        exit(); // Encerra a execução do script
    }
?>
 


<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #E7DFDD;
            border-radius: 30px;
        }
        ::-webkit-scrollbar-thumb {
            background: #000000;
            border-radius: 30px;
        }
    </style>
    <title>Curso Edit</title>
</head>
<body>
    <?php include './includes/navbar_modal.php'?> <!-- Navbar -->
    <div class="container mt-5">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Curso
                            <a href="exibir_cursos.php" class="btn btn-danger float-end">VOLTAR
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
                            $query = "SELECT * FROM curso WHERE id='$curso_id' ";
                            $query_run = mysqli_query($mysqli, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $curso = mysqli_fetch_array($query_run);  
                                ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="curso_id" value="<?= $curso['id']; ?>">
                                    <img class="form" height="250px" id="preview-imagem" src="img/categoria/<?= $curso['imagem_capa']; ?>"><br><br>
                                    <div class="form-group">
                                        <label for="imagem_input">Imagem:</label>
                                        <input type="file" class="form-control" id="imagem_input" name="imagem_capa" onchange="previewImagem(event)">
                                    </div>
                                    <script>
                                        function previewImagem(event) {
                                            var reader = new FileReader();
                                            reader.onload = function(){
                                                var output = document.getElementById('preview-imagem');
                                                output.src = reader.result;
                                            };
                                            reader.readAsDataURL(event.target.files[0]);
                                        }
                                    </script>
                                    <script>
                                        function updateImagemPreview(caminhoImagem) {
                                            var previewImagem = document.getElementById('preview-imagem');
                                            previewImagem.src = caminhoImagem;
                                        }
                                    </script>
                                    <div class="mb-3">
                                        <label for="titulo" class="form-label">Título:</label>
                                        <input type="text" name="titulo" value="<?= $curso['titulo']; ?>" class="form-control" id="titulo">
                                    </div>  
                                    <div class="mb-3">
                                        <label for="descricao" class="form-label">Descrição:</label>
                                        <input type="text" name="descricao" value="<?= $curso['descricao']; ?>" class="form-control" id="descricao">
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoria" class="form-label">Categoria:</label>
                                        <select class="form-control" id="categoria" name="categoria" >
                                            <option value="<?= $curso['categoria']; ?>" >Deseja trocar? (<?= $curso['categoria']; ?>)</option>
                                            <option value="Programação">Programação</option>
                                            <option value="Banco de Dados">Banco de Dados</option>
                                            <option value="Marketing Digital">Marketing Digital</option>
                                            <option value="Design UX/UI">Design UX/UI</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="professor" class="form-label">Professor:</label>
                                        <select class="form-control" id="professor" name="professor">
                                            <?php
                                                $professor_id = $curso['id_prof'];
                                                $prof_query = "SELECT id, nome, sobrenome FROM professor WHERE id='$professor_id'";
                                                $prof_result = mysqli_query($mysqli, $prof_query);
                                                if ($prof_result && mysqli_num_rows($prof_result) > 0) {
                                                    $professor = mysqli_fetch_assoc($prof_result);
                                            ?>
                                                    <option value="<?= $professor['id']; ?>" selected>Deseja trocar o prof. <?= $professor['nome']; ?> <?= $professor['sobrenome']; ?>?</option>
                                            <?php
                                                } else {
                                            ?>
                                                    <option value="" disabled selected>Professor não encontrado</option>
                                            <?php
                                                }

                                                $all_prof_query = "SELECT id, nome, sobrenome FROM professor WHERE id != '$professor_id'";
                                                $all_prof_result = mysqli_query($mysqli, $all_prof_query);
                                                if ($all_prof_result && mysqli_num_rows($all_prof_result) > 0) {
                                                    while ($prof = mysqli_fetch_assoc($all_prof_result)) {
                                            ?>
                                                        <option value="<?= $prof['id']; ?>"><?= $prof['nome']; ?> <?= $prof['sobrenome']; ?></option>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="valorDoCurso" class="form-label">Valor do curso:</label>
                                        <input type="text" name="valorDoCurso" value="<?= number_format($curso['valor'], 2, ',', '.'); ?>" class="form-control" id="valorDoCurso">
                                        <script>
                                            $(document).ready(function(){
                                                $('#valorDoCurso').mask('000.000.000,00', {reverse: true});
                                            });
                                        </script>
                                    </div>
                                    <div class="mb-3">
                                        <label for="data" class="form-label">Data de Criação:</label>
                                        <input type="text" name="data" value="<?= date('d/m/Y', strtotime($curso['data_criacao'])); ?>" class="form-control" id="data" readonly style="background-color: #d3d3d3;">
                                    </div>  
                                    <div class="mb-3">
                                        <button type="submit" name="update_curso" class="btn btn-primary">Atualizar curso</button>
                                    </div>
                                </form>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(document).ready(function () { 
        var $seuCampoCpf = $("#cpf");
        $seuCampoCpf.mask('000.000.000-00', {reverse: true});
    });
</script>
</body>
</html>