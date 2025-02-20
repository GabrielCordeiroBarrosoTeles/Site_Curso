<?php
require 'session_check.php';
require '../dbcon.php';

// Verifica se foi enviado o id do módulo via GET
if (!isset($_GET['id'])) {
    die("Módulo não especificado.");
}

$modulo_id = $_GET['id'];

// Primeiro: obtém o id_curso a partir do módulo
$queryModulo = "SELECT id_curso FROM modulo WHERE id = ?";
$stmtModulo = $mysqli->prepare($queryModulo);
$stmtModulo->bind_param("i", $modulo_id);
$stmtModulo->execute();
$resultModulo = $stmtModulo->get_result();

if ($resultModulo->num_rows == 0) {
    die("Módulo não encontrado.");
}

$modulo = $resultModulo->fetch_assoc();
$curso_id = $modulo['id_curso'];

// Segundo: obtém todas as aulas do curso com os dados do curso e do professor
$queryAulas = "
    SELECT 
        a.id AS aula_id,
        a.titulo AS aula_titulo,
        a.conteudo AS aula_descricao,
        a.duracao AS aula_duracao,
        a.drive_link AS drive_link,
        c.titulo AS curso_titulo,
        c.categoria AS curso_categoria,
        CONCAT(p.nome, ' ', p.sobrenome) AS professor_nome
    FROM aula a
    JOIN modulo m ON a.id_modulo = m.id
    JOIN curso c ON m.id_curso = c.id
    JOIN professor p ON c.id_prof = p.id
    WHERE c.id = ?
    ORDER BY a.ordem ASC
";
$stmtAulas = $mysqli->prepare($queryAulas);
$stmtAulas->bind_param("i", $curso_id);
$stmtAulas->execute();
$resultAulas = $stmtAulas->get_result();
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aulas do Curso</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include './includes/navbar_modal.php'; ?>
  <br><br>
  <div class="container mt-4">
    <?php include 'message.php'; ?>
    <?php if ($resultAulas->num_rows > 0): 
            // Usa a primeira aula para exibir os dados do curso e professor
            $primeiraAula = $resultAulas->fetch_assoc();
    ?>
      <h4 class="mb-3">
        Aulas do Curso: <?= htmlspecialchars($primeiraAula['curso_titulo']); ?> <br>
        <small>Categoria: <?= htmlspecialchars($primeiraAula['curso_categoria']); ?> | Professor: <?= htmlspecialchars($primeiraAula['professor_nome']); ?></small>
      </h4>
      <table class="table table-bordered table-striped text-center">
        <thead>
          <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Conteúdo</th>
            <th>Duração</th>
            <th>Link</th>
          </tr>
        </thead>
        <tbody>
          <!-- Primeira aula -->
          <tr>
            <td><?= htmlspecialchars($primeiraAula['aula_id']); ?></td>
            <td><?= htmlspecialchars($primeiraAula['aula_titulo']); ?></td>
            <td><?= htmlspecialchars($primeiraAula['aula_descricao']); ?></td>
            <td><?= htmlspecialchars($primeiraAula['aula_duracao']); ?></td>
            <td>
              <?php if (!empty($primeiraAula['drive_link'])): ?>
                <a href="<?= htmlspecialchars($primeiraAula['drive_link']); ?>" target="_blank">Visualizar</a>
              <?php else: ?>
                Sem link
              <?php endif; ?>
            </td>
          </tr>
          <!-- Demais aulas -->
          <?php while ($aula = $resultAulas->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($aula['aula_id']); ?></td>
              <td><?= htmlspecialchars($aula['aula_titulo']); ?></td>
              <td><?= htmlspecialchars($aula['aula_descricao']); ?></td>
              <td><?= htmlspecialchars($aula['aula_duracao']); ?></td>
              <td>
                <?php if (!empty($aula['drive_link'])): ?>
                  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#videoModal" 
                          data-title="<?= htmlspecialchars($aula['aula_titulo'], ENT_QUOTES, 'UTF-8'); ?>" 
                          data-link="<?= htmlspecialchars($aula['drive_link'], ENT_QUOTES, 'UTF-8'); ?>">
                      Ver Aula
                  </button>
                <?php else: ?>
                  N/A
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <h4>Nenhuma aula encontrada para este curso.</h4>
    <?php endif; ?>
  </div>

  <!-- Modal para exibição do vídeo -->
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
