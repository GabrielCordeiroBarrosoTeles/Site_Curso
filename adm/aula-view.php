<?php
    require 'session_check.php'; // Verificação de sessão
    require '../dbcon.php'; // Conexão com o banco de dados
?>

<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #E7DFDD; border-radius: 30px; }
        ::-webkit-scrollbar-thumb { background: #000000; border-radius: 30px; }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <title>Lista de Aulas</title>
</head>
<body>
    <?php include './includes/navbar_modal.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Aulas</h4>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Módulo</th>
            <th>Título</th>
            <th>Conteúdo</th>
            <th>Ordem</th>
            <th>Link</th>
            <th>Duração</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT aula.*, modulo.titulo AS titulo_modulo FROM aula 
                  JOIN modulo ON aula.id_modulo = modulo.id 
                  ORDER BY aula.id ASC";
        $query_run = mysqli_query($mysqli, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($aula = mysqli_fetch_assoc($query_run)) {
                ?>
                <tr>
                    <td><?= $aula['id']; ?></td>
                    <td><?= $aula['titulo_modulo']; ?></td>
                    <td><?= $aula['titulo']; ?></td>
                    <td><?= $aula['conteudo']; ?></td>
                    <td><?= $aula['ordem']; ?></td>
                    <td>
                        <?php if (!empty($aula['drive_link'])): ?>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#videoModal" 
                                    data-title="<?= htmlspecialchars($aula['titulo'], ENT_QUOTES, 'UTF-8'); ?>" 
                                    data-link="<?= htmlspecialchars($aula['drive_link'], ENT_QUOTES, 'UTF-8'); ?>">
                                Ver Aula
                            </button>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td><?= $aula['duracao']; ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='7'>Nenhuma aula encontrada</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Aula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="videoIframe" width="100%" height="400px" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Script para atualizar o modal dinamicamente -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var videoModal = document.getElementById('videoModal');
        videoModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget; // Botão que acionou o modal
            var titulo = button.getAttribute('data-title'); // Obtém o título
            var link = button.getAttribute('data-link'); // Obtém o link

            // Atualiza o título e o iframe do modal
            document.getElementById('videoModalLabel').textContent = "Aula: " + titulo;
            document.getElementById('videoIframe').src = link;
        });

        // Remover o link do iframe ao fechar o modal para evitar reprodução em segundo plano
        videoModal.addEventListener('hidden.bs.modal', function() {
            document.getElementById('videoIframe').src = "";
        });
    });
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
