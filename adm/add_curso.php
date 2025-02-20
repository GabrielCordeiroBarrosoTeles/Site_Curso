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

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet"><!--Importante, faz os icons aparecerem no footrer-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet"><!--Importante, faz os icons aparecerem no footrer-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
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
                        <h4>Add Aula
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
                            if (isset($_GET['id'])) {
                                $curso_id = mysqli_real_escape_string($mysqli, $_GET['id']);
                                $query = "SELECT * FROM curso WHERE id='$curso_id'";
                                $query_run = mysqli_query($mysqli, $query);

                                if (mysqli_num_rows($query_run) > 0) 
                                {
                                    $curso = mysqli_fetch_array($query_run);
                        ?>
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="curso_id" value="<?= $curso['id']; ?>">
                                        <div class="text-center mb-4" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
                                            <img class="img-fluid rounded shadow-sm" id="preview-imagem" src="img/categoria/<?= $curso['imagem_capa']; ?>" alt="Imagem do Curso" style="max-height: 250px; object-fit: cover;">
                                        </div>
                                   
                                        <!-- Card -->
                                        <?php
                                            $query = "SELECT curso.*, professor.nome AS nome_professor, professor.sobrenome AS sobrenome_professor, COUNT(matricula.id) AS total_matriculas
                                                        FROM curso
                                                        LEFT JOIN matricula ON curso.id = matricula.id_curso
                                                        LEFT JOIN professor ON curso.id_prof = professor.id
                                                        GROUP BY curso.id
                                                        ORDER BY total_matriculas DESC
                                                        LIMIT 4";
                                            $query_run = mysqli_query($mysqli, $query);

                                            if (mysqli_num_rows($query_run) > 0) {
                                        ?>
                                        <div class="container py-5">
                                            <h2 class="text-center mb-4">Funções</h2>
                                            <div class="row">

                                                <!-- Card -->

                                                <!-- Card de Add aula -->
                                                <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                                                    <div class="card rounded shadow-sm border-0 h-100">
                                                        <div class="card-body p-4 d-flex flex-column">
                                                            <div class="d-flex justify-content-center align-items-center mb-3" style="height: 200px; overflow: hidden; border-radius: 10px; background-color: #f8f9fa;">
                                                                <img src="img/add_aula.png" alt="" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                                            </div>
                                                            <h5 class="mt-auto text-center"><a href="#" class="text-dark" style="text-decoration: none;">Adicionar Aula ao <br> <?= $curso["titulo"] ?></a></h5>
                                                            <p class="small text-muted font-italic text-center"><?= $curso["categoria"] ?></p>
                                                            <div class="text-center mt-3">
                                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal1<?= $curso["id"] ?>">Adicionar Aula</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Card de Add modulo -->
                                                <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                                                    <div class="card rounded shadow-sm border-0 h-100">
                                                        <div class="card-body p-4 d-flex flex-column">
                                                            <div class="d-flex justify-content-center align-items-center mb-3" style="height: 200px; overflow: hidden; border-radius: 10px; background-color: #f8f9fa;">
                                                                <img src="img/add_modulo.png" alt="" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                                            </div>
                                                            <h5 class="mt-auto text-center"><a href="#" class="text-dark" style="text-decoration: none;">Adicionar Módulo ao <br> <?= $curso["titulo"] ?></a></h5>
                                                            <p class="small text-muted font-italic text-center"><?= $curso["categoria"] ?></p>
                                                            <div class="text-center mt-3">
                                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal2<?= $curso["id"] ?>">Adicionar Módulo</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Card de Exibir as aulas -->
                                                <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                                                    <div class="card rounded shadow-sm border-0 h-100">
                                                        <div class="card-body p-4 d-flex flex-column">
                                                            <div class="d-flex justify-content-center align-items-center mb-3" style="height: 200px; overflow: hidden; border-radius: 10px; background-color: #f8f9fa;">
                                                                <img src="img/exibir_aula.png" alt="" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                                            </div>
                                                            <h5 class="mt-auto text-center"><a href="#" class="text-dark" style="text-decoration: none;">Exibir Aulas do <br> <?= $curso["titulo"] ?></a></h5>
                                                            <p class="small text-muted font-italic text-center"><?= $curso["categoria"] ?></p>
                                                            <div class="text-center mt-3">
                                                                <a href="exibir_aulas.php?id=<?= $curso['id']; ?>" class="btn btn-primary">Exibir Aulas</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Card de Exibir os modulos -->
                                                <div class="col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                                                    <div class="card rounded shadow-sm border-0 h-100">
                                                        <div class="card-body p-4 d-flex flex-column">
                                                            <div class="d-flex justify-content-center align-items-center mb-3" style="height: 200px; overflow: hidden; border-radius: 10px; background-color: #f8f9fa;">
                                                                <img src="img/exibir_modulo.png" alt="" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                                            </div>
                                                            <h5 class="mt-auto text-center"><a href="exibir_modulos.php?id=<?= $curso['id']; ?>" class="text-dark" style="text-decoration: none;">Exibir Módulos do <br> <?= $curso["titulo"] ?></a></h5>
                                                            <p class="small text-muted font-italic text-center"><?= $curso["categoria"] ?></p>
                                                            <div class="text-center mt-3">
                                                                <a href="exibir_modulos.php?id=<?= $curso['id']; ?>" class="btn btn-primary">Exibir Módulos</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modals-->

                                                <!-- Modal de Add Aula -->
                                                <div class="modal fade" id="myModal1<?= $curso["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="modal-title" id="exampleModalLabel" style="text-align:center">Adicionar Aula</h2>
                                                                <button type="button" class="btn-close" style="color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form action="code.php" method="post" enctype="multipart/form-data">
                                                                    <!-- ID do curso (oculto) -->
                                                                    <input type="hidden" name="id_curso" value="<?= $curso["id"] ?>">

                                                                    <!-- Drive_link -->
                                                                    <div class="mb-3">
                                                                        <label for="drive_link" class="form-label">Link do Drive:</label>
                                                                        <input type="text" class="form-control" id="drive_link" name="drive_link" placeholder="Digite o link do Drive" required>
                                                                    </div>

                                                                    <!-- Título -->
                                                                    <div class="mb-3">
                                                                        <label for="titulo" class="form-label">Título:</label>
                                                                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título do módulo" required>
                                                                    </div>

                                                                    <!-- Conteúdo -->
                                                                    <div class="mb-3">
                                                                        <label for="conteudo" class="form-label">Conteudo:</label>
                                                                        <input type="text" class="form-control" id="conteudo" name="conteudo" placeholder="Digite o conteudo da aula" required>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="duracao" class="form-label">Duração da Aula (hh:mm:ss):</label>
                                                                        <input type="text" class="form-control" id="duracao" name="duracao" placeholder="ex: 00:58:35" required>
                                                                    </div>

                                                                    <script>
                                                                        $(document).ready(function () {
                                                                            $('#duracao').mask('00:00:00');
                                                                        });
                                                                    </script>

                                                                    <!-- Selecionar o módulo -->
                                                                    <div class="mb-3">
                                                                        <label for="id_modulo" class="form-label">Módulo:</label>
                                                                        <select class="form-control" id="id_modulo" name="id_modulo" required onchange="atualizarOrdem()">
                                                                            <option value="" disabled selected>Selecione o módulo</option>
                                                                            <?php
                                                                                $query = "SELECT id, titulo FROM modulo WHERE id_curso = {$curso['id']} ORDER BY ordem";
                                                                                $result = mysqli_query($mysqli, $query);

                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                    echo "<option value='{$row['id']}'>{$row['titulo']}</option>";
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Selecionar a ordem da aula -->
                                                                    <div class="mb-3">
                                                                        <label for="ordem" class="form-label">Posição da Aula:</label>
                                                                        <select class="form-control" id="ordem" name="ordem" required>
                                                                            <option value="" disabled selected>Selecione a posição</option>
                                                                        </select>
                                                                    </div>

                                                                    <script>
                                                                        function atualizarOrdem() {
                                                                            var idModulo = document.getElementById("id_modulo").value;
                                                                            var ordemSelect = document.getElementById("ordem");

                                                                            // Limpa as opções anteriores
                                                                            ordemSelect.innerHTML = '<option value="" disabled selected>Carregando...</option>';

                                                                            // Faz uma requisição AJAX para buscar a ordem das aulas dentro do módulo
                                                                            var xhr = new XMLHttpRequest();
                                                                            xhr.open("GET", "buscar_ordem_aula.php?id_modulo=" + idModulo, true);
                                                                            xhr.onload = function () {
                                                                                if (xhr.status == 200) {
                                                                                    ordemSelect.innerHTML = xhr.responseText;
                                                                                }
                                                                            };
                                                                            xhr.send();
                                                                        }
                                                                    </script>

                                                                    <!-- Botão de Envio -->
                                                                    <div class="text-center">
                                                                        <button type="submit" name="save_aula" class="btn btn-primary">Salvar Módulo</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                 

                                                <!-- Modal de Add Módulo -->
                                                <div class="modal fade" id="myModal2<?= $curso["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="modal-title" id="exampleModalLabel" style="text-align:center">Adicionar Módulo</h2>
                                                                <button type="button" class="btn-close" style="color: #fff;" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form action="code.php" method="post" enctype="multipart/form-data">
                                                                    <!-- ID do curso (oculto) -->
                                                                    <input type="hidden" name="id_curso" value="<?= $curso["id"] ?>">

                                                                    <!-- Pré-visualização da imagem -->
                                                                    <div class="mb-3" id="preview-container" style="display: none;">
                                                                        <label for="preview" class="form-label">Pré-visualização:</label>
                                                                        <img id="preview" src="#" alt="Pré-visualização da imagem" style="max-width: 100%; height: auto; border: 2px solid #2222ff; border-radius: 10px; margin-top: 10px;">
                                                                    </div>

                                                                    <!-- Upload da Imagem -->
                                                                    <div class="mb-3">
                                                                        <label for="imagem" class="form-label">Imagem da Capa:</label>
                                                                        <input type="file" class="form-control" id="imagem" name="imagem" required>
                                                                    </div>

                                                                    <!-- Script de Pré-visualização da Imagem -->
                                                                    <script>
                                                                        document.getElementById('imagem').addEventListener('change', function(event) {
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

                                                                    <!-- Título -->
                                                                    <div class="mb-3">
                                                                        <label for="titulo" class="form-label">Título:</label>
                                                                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título do módulo" required>
                                                                    </div>

                                                                    <!-- Descrição -->
                                                                    <div class="mb-3">
                                                                        <label for="descricao" class="form-label">Descrição:</label>
                                                                        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição do módulo" required>
                                                                    </div>

                                                                    <!-- Ordem do módulo -->
                                                                    <div class="mb-3">
                                                                        <label for="ordem" class="form-label">Posição do Módulo:</label>
                                                                        <select class="form-control" id="ordem" name="ordem" required>
                                                                            <option value="" disabled selected>Selecione a posição</option>
                                                                            <?php
                                                                                $query = "SELECT ordem, titulo FROM modulo WHERE id_curso = {$curso['id']} ORDER BY ordem";
                                                                                $result = mysqli_query($mysqli, $query);
                                                                                $max_ordem = 0;

                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                    $max_ordem = max($max_ordem, $row['ordem']);
                                                                                    echo "<option value='{$row['ordem']}'>Antes de {$row['titulo']} (Ordem {$row['ordem']})</option>";
                                                                                }
                                                                                echo "<option value='" . ($max_ordem + 1) . "'>Último (Ordem " . ($max_ordem + 1) . ")</option>";
                                                                            ?>
                                                                        </select>
                                                                    </div>


                                                                    <!-- Botão de Envio -->
                                                                    <div class="text-center">
                                                                        <button type="submit" name="save_modulo" class="btn btn-primary">Salvar Módulo</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </form>
                                <?php
                            } else {
                                echo "<h4>Nenhum ID encontrado</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
        $(document).ready(function () { 
            var $seuCampoCpf = $("#cpf");
            $seuCampoCpf.mask('000.000.000-00', {reverse: true});
        });
    </script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    
    <!-- jQuery (necessário para Bootstrap 4) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle com Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>

</body>
</html>