<style>
    #card {
        border-radius: 0%;
        text-align: center;
        border-left: none;
        border-top: none;
        border-right: none;
        border-bottom: 6px solid #8B4513;
    }
    #cardtext {
        color: #747474;
        margin-top: -10px;
    }
    .modal-image {
        max-width: 50px; 
        max-height: 50px; 
    }
    /* Ajustes de estilo para imagens nos cards */
    .card-img-top {
        width: 100%;
        height: auto;
        object-fit: cover; /* Isso vai garantir que a imagem_capa seja coberta sem distorcer */
    }

    .card-body {
        padding: 1.25rem; /* Ajuste para garantir uma boa aparência */
    }

    .modal-image {
        width: 100%;
        max-width: 200px;
        height: auto;
        margin: 0 auto;
    }

    /* Adicionando altura fixa para os cards */
    .card {
        height: 100%; /* Faz com que todos os cards tenham a mesma altura */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-title {
        margin-top: auto; /* Empurra o título para o final do card */
    }
</style>
<!-- Arquivos CSS do Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Arquivos JavaScript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
    require 'dbcon.php';
    $categoria = "Programação";
    $query = "SELECT curso.*, professor.nome AS nome_professor, professor.sobrenome AS sobrenome_professor, COUNT(matricula.id) AS total_matriculas
                FROM curso
                LEFT JOIN matricula ON curso.id = matricula.id_curso
                LEFT JOIN professor ON curso.id_prof = professor.id
                WHERE curso.categoria = '$categoria'
                GROUP BY curso.id
                ORDER BY total_matriculas DESC
                LIMIT 4;
                ";
    $query_run = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($query_run) > 0) {

        echo '<div class="container py-5">';
            echo "<h2 style='text-align:center;'>" . $categoria . " Mais vendidos</h2>";
            echo '<div class="row">';

                while ($cursos = mysqli_fetch_assoc($query_run)) {
                    echo '<div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-4">';
                        echo '<div class="card rounded shadow-sm border-0 h-100">';
                            echo '<div class="card-body p-4 d-flex flex-column">';
                                echo '<div style="width:100%; height:200px; display:flex; align-items:center; justify-content:center; overflow:hidden;">';
                                    echo '<img src="./adm/img/categoria/'.$cursos["imagem_capa"].'" alt="" class="img-fluid d-block mx-auto mb-3" style="max-height:100%; max-width:100%; object-fit: contain;">';
                                echo '</div>';
                                echo '<h5 class="mt-auto"><a href="#" class="text-dark text-center" style="text-decoration: none;">' . $cursos["titulo"] . '</a></h5>';
                                echo '<p class="small text-muted font-italic text-center">' . $cursos["categoria"] . '</p>';
                                echo '<h5 class="card-title text-center">';
                                    echo '<span style="color:#ffff;background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3" data-toggle="modal" data-target="#myModal' . $cursos["id"] . '">Ver Mais</span>';
                                echo '</h5>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                    // Modal
                    echo '<div class="modal fade" id="myModal' . $cursos["id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog" role="document">';
                            echo '<div class="modal-content">';
                                echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title" id="exampleModalLabel">' . $cursos["titulo"] . '</h5>';
                                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                        echo '<span aria-hidden="true">&times;</span>';
                                    echo '</button>';
                                echo '</div>';
                                echo '<div class="modal-body">';
                                echo '<img src="./img/categoria/'.$cursos["imagem_capa"].'" alt="" class="img-fluid d-block mx-auto mb-3" style="max-width: 200px; max-height: 200px;">';
                                echo '<p>Função: ' . $cursos["categoria"] . '</p>';
                                echo '<p>Detalhe: ' . $cursos["descricao"] . '</p>';
                                echo '<p>Professor: ' . $cursos["nome_professor"] . ' ' . $cursos["sobrenome_professor"] . '</p>';
                                echo '<p>Valor: ' . $cursos["valor"] . '</p>';
                                echo '</div>';
                                echo '<div class="modal-footer">';
                                    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }

            echo '</div>';
        echo '</div>';
    } else {
        echo "<h5>Nenhum produto encontrado</h5>";
    }
?>
<?php
    require 'dbcon.php';
    $categoria = "Banco de Dados";
    $query = "SELECT curso.*, professor.nome AS nome_professor, professor.sobrenome AS sobrenome_professor, COUNT(matricula.id) AS total_matriculas
                FROM curso
                LEFT JOIN matricula ON curso.id = matricula.id_curso
                LEFT JOIN professor ON curso.id_prof = professor.id
                WHERE curso.categoria = '$categoria'
                GROUP BY curso.id
                ORDER BY total_matriculas DESC
                LIMIT 4;";
    $query_run = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($query_run) > 0) {

        echo '<div class="container py-5">';
            echo "<h2 style='text-align:center;'>" . $categoria . " Mais vendidos</h2>";
            echo '<div class="row">';

                while ($cursos = mysqli_fetch_assoc($query_run)) {
                    echo '<div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-4">';
                        echo '<div class="card rounded shadow-sm border-0 h-100">';
                            echo '<div class="card-body p-4 d-flex flex-column">';
                                echo '<div style="width:100%; height:200px; display:flex; align-items:center; justify-content:center; overflow:hidden;">';
                                    echo '<img src="./adm/img/categoria/'.$cursos["imagem_capa"].'" alt="" class="img-fluid d-block mx-auto mb-3" style="max-height:100%; max-width:100%; object-fit: contain;">';
                                echo '</div>';
                                echo '<h5 class="mt-auto"><a href="#" class="text-dark text-center" style="text-decoration: none;">' . $cursos["titulo"] . '</a></h5>';
                                echo '<p class="small text-muted font-italic text-center">' . $cursos["categoria"] . '</p>';
                                echo '<h5 class="card-title text-center">';
                                    echo '<span style="color:#ffff;background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3" data-toggle="modal" data-target="#myModal' . $cursos["id"] . '">Ver Mais</span>';
                                echo '</h5>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                    // Modal
                    echo '<div class="modal fade" id="myModal' . $cursos["id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog" role="document">';
                            echo '<div class="modal-content">';
                                echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title" id="exampleModalLabel">' . $cursos["titulo"] . '</h5>';
                                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                        echo '<span aria-hidden="true">&times;</span>';
                                    echo '</button>';
                                echo '</div>';
                                echo '<div class="modal-body">';
                                echo '<img src="./img/categoria/'.$cursos["imagem_capa"].'" alt="" class="img-fluid d-block mx-auto mb-3" style="max-width: 200px; max-height: 200px;">';
                                echo '<p>Função: ' . $cursos["categoria"] . '</p>';
                                echo '<p>Detalhe: ' . $cursos["descricao"] . '</p>';
                                echo '<p>Professor: ' . $cursos["nome_professor"] . ' ' . $cursos["sobrenome_professor"] . '</p>';
                                echo '<p>Valor: ' . $cursos["valor"] . '</p>';
                                echo '</div>';
                                echo '<div class="modal-footer">';
                                    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }

            echo '</div>';
        echo '</div>';
    } else {
        echo "<h5>Nenhum produto encontrado</h5>";
    }
?>