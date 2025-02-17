<?php
require 'conexao.php'; // Certifique-se de que este arquivo contém a conexão com o banco

if (isset($_POST['curso_id'])) {
    $curso_id = $_POST['curso_id'];

    $query = "SELECT titulo, descricao, data_criacao, categoria, imagem_capa, valor 
              FROM curso WHERE id = '$curso_id'";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $curso = mysqli_fetch_assoc($query_run);

        // Caminho da imagem
        $image_path = 'img/categoria/' . $curso['imagem_capa'];

        // Exibe os detalhes do curso com design responsivo
        echo "
            <div class='container py-5'>
                <div class='row justify-content-center'>
                    <div class='col-lg-8 col-md-10 col-sm-12'>
                        <div class='card shadow-sm border-0 rounded-3'>
                            <div class='row g-0'>
                                <div class='col-md-5'>
                                    <img src='";
                                    if (file_exists($image_path)) {
                                        echo $image_path;
                                    } else {
                                        echo 'img/default.jpg'; // Caso a imagem não exista
                                    }
                                    echo "' class='img-fluid rounded-start' alt='{$curso['titulo']}'>
                                </div>
                                <div class='col-md-7'>
                                    <div class='card-body'>
                                        <h3 class='card-title text-center mb-4'>{$curso['titulo']}</h3>
                                        <p class='card-text'>{$curso['descricao']}</p>
                                        <div class='d-flex justify-content-between align-items-center mt-4'>
                                            <p class='card-text'><strong>Categoria:</strong> {$curso['categoria']}</p>
                                            <p class='card-text'><strong>Valor:</strong> R$ " . number_format($curso['valor'], 2, ',', '.') . "</p>
                                        </div>
                                        <p class='card-text'><strong>Data de Criação:</strong> " . date('d/m/Y', strtotime($curso['data_criacao'])) . "</p>
                                        <a href='#' class='btn btn-primary w-100 mt-4'>Ver Mais Informações</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
    } else {
        echo "<div class='alert alert-warning text-center' role='alert'>Curso não encontrado.</div>";
    }
} else {
    echo "<div class='alert alert-info text-center' role='alert'>Selecione um curso para ver os detalhes.</div>";
}
?>
