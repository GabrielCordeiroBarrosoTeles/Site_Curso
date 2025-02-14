<style>
    #card {
        align-items: center;
        border-radius: 0%;
        text-align: center;
        border-left: none;
        border-top: none;
        border-right: none;
        border-bottom: 6px solid #2222ff;
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

<?php if (isset($_SESSION['tipo_usuario']) && ($_SESSION['tipo_usuario'] === 'adm' || $_SESSION['tipo_usuario'] === 'professor')): ?>
    <section class="container">
        <h3  style="text-align: center;" id="eventos">Possibilidades</h3><br>
        <div class="row row-cols-3 row-cols-md-6 g-6">

            <div class="col">
                <div class="card" id="card">
                    <img src="img/cadastro cursos.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><span data-bs-toggle="modal" data-bs-target="#exampleModal1"  style="background-color: #2222ff;border: #2222ff" class="btn btn-brand ms-lg-3 text-light">Cad.cursos</span></h5>
                        <p class="card-text" id="cardtext"></p>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card" id="card">
                    <img src="img/cadastro cliente.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><span data-bs-toggle="modal" data-bs-target="#exampleModal2"  style="background-color: #2222ff;border: #2222ff" class="btn btn-brand ms-lg-3 text-light">Cad.Cliente</span></h5>
                        <p class="card-text" id="cardtext"></p>
                    </div>
                </div>
            </div>
                
            <div class="col">
                <div class="card" id="card">
                    <img src="img/gerar nota fiscal.png" class="card-img-top" alt="..." >
                    <div class="card-body">
                        <h5 class="card-title"><a href="gerar_nota_fiscal.php" style="background-color: #2222ff;border: #2222ff" class="btn btn-brand ms-lg-3 text-light">Ger.NF</a></h5>
                        <p class="card-text" id="cardtext"></p>
                    </div>
                </div>
            </div>
                    
            <div class="col">
                <div class="card"  id="card">
                    <img src="img/exibir cliente.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title" ><a href="exibir_cliente.php" style="background-color: #2222ff;border: #2222ff" class="btn btn-brand ms-lg-3 text-light">Exib.Cliente</a></h5>
                        <p class="card-text" id="cardtext"></p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card" id="card">
                    <img src="img/exibir cursos.png" class="card-img-top" alt="..." >
                    <div class="card-body">
                        <h5 class="card-title"><a href="exibir.php" style="background-color: #2222ff;border: #2222ff" class="btn btn-brand ms-lg-3 text-light">Exib.cursos</a></h5>
                        <p class="card-text" id="cardtext"></p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card" id="card">
                    <img src="img/exibir nota fiscal.png" class="card-img-top" alt="..." >
                    <div class="card-body">
                        <h5 class="card-title"><a href="exibir_notasfiscais.php" style="background-color: #2222ff;border: #2222ff" class="btn btn-brand ms-lg-3 text-light">Exib.NF</a></h5>
                        <p class="card-text" id="cardtext"></p>
                    </div>
                </div>
            </div>
                    
        </div>
    </section>
<?php endif; ?>

<?php if (isset($_SESSION['tipo_usuario']) && ($_SESSION['tipo_usuario'] === 'aluno' )): ?>
    <section class="container my-5">
        <h3 class="text-center text-dark mb-4" id="eventos">Possibilidades</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">

            <div class="col">
                <div class="card shadow-sm border-0">
                    <img src="img/exibir cursos.png" class="card-img-top" alt="imagem_capa do cursos">
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="exibir.php" class="btn btn-brand text-light" style="background-color: #2222ff; border: none;">Exibir Cursos</a>
                        </h5>
                        <p class="card-text" id="cardtext"></p>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php endif; ?>

<?php
    //$funcao = "Anti-Inflamatórios";
    //$query = "SELECT * FROM cursos WHERE funcao = '$funcao' ORDER BY vendido DESC LIMIT 8";]
    $query = "SELECT curso.*, professor.nome AS nome_professor, professor.sobrenome AS sobrenome_professor, COUNT(matricula.id) AS total_matriculas
                FROM curso
                LEFT JOIN matricula ON curso.id = matricula.id_curso
                LEFT JOIN professor ON curso.id_prof = professor.id
                GROUP BY curso.id
                ORDER BY total_matriculas DESC
                LIMIT 4;
                ";
    $query_run = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($query_run) > 0) {

        echo '<div class="container py-5">';
            //echo "<h2 style='text-align:center;'>" . $funcao . " Mais vendidos</h2>";
            echo "<h2 style='text-align:center;'> Mais vendidos</h2>";
            echo '<div class="row">';

                while ($cursos = mysqli_fetch_assoc($query_run)) {
                    // Card
                    echo '<div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-4">';
                        echo '<div class="card rounded shadow-sm border-0 h-100">'; // Adiciona a classe h-100 para altura total
                            echo '<div class="card-body p-4 d-flex flex-column">'; // Adiciona d-flex e flex-column para layout flexível
                                // Container com altura fixa e centralização da imagem_capa
                                echo '<div style="width:100%; height:200px; display:flex; align-items:center; justify-content:center; overflow:hidden;">';
                                    echo '<img src="img/categoria/'.$cursos["imagem_capa"].'" alt="" style="max-height:100%; max-width:100%; object-fit: contain;">';
                                echo '</div>';
                                echo '<h5 class="mt-auto"><a href="#" class="text-dark" style="text-decoration: none;">' . $cursos["titulo"] . '</a></h5>'; // Adiciona mt-auto para empurrar o título para o final
                                echo '<p class="small text-muted font-italic">' . $cursos["categoria"] . '</p>';
                                echo '<h5 class="card-title">';
                                    echo '<span style="color:#ffff;background-color: #2222ff;border: #2222ff" class="btn btn-brand ms-lg-3" data-toggle="modal" data-target="#myModal' . $cursos["id"] . '">Ver Mais</span>';
                                echo '</h5>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                    // Modal
                    echo '<div class="modal fade" id="myModal' . $cursos["id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                        echo '<div class="modal-dialog" role="document">';
                            echo '<div class="modal-content">';
                                echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title" id="exampleModalLabel">' . $cursos["nome"] . '</h5>';
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
                </div>
            </div>
        </div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>