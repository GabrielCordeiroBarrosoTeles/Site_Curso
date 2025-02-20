<?php
require 'session_check.php';
require '../dbcon.php';

if (!isset($_GET['id'])) {
    die("Curso não especificado.");
}

$curso_id = $_GET['id'];

// Consulta para obter o título do curso e o nome do professor
$queryCurso = "
    SELECT 
        c.titulo AS titulo_curso, 
        CONCAT(p.nome, ' ', p.sobrenome) AS nome_professor
    FROM curso c
    JOIN professor p ON c.id_prof = p.id
    WHERE c.id = ?
";
$stmtCurso = $mysqli->prepare($queryCurso);
$stmtCurso->bind_param("i", $curso_id);
$stmtCurso->execute();
$resultCurso = $stmtCurso->get_result();
$curso_info = $resultCurso->fetch_assoc();

// Consulta para obter os módulos do curso
$queryModulos = "
    SELECT id, titulo, descricao, duracao, imagem
    FROM modulo 
    WHERE id_curso = ?
    ORDER BY ordem ASC
";
$stmtModulos = $mysqli->prepare($queryModulos);
$stmtModulos->bind_param("i", $curso_id);
$stmtModulos->execute();
$resultModulos = $stmtModulos->get_result();
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Módulos do Curso</title>
</head>
<body>
<?php include './includes/navbar_modal.php'; ?>
<br><br>

<div class="container mt-4">
    <?php include 'message.php'; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Módulo
                        <?php if (isset($_SESSION['user_tipo_usuario']) && $_SESSION['user_tipo_usuario'] === 'adm'): ?>
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal1" class="btn btn-primary float-end">Adicionar ao curso</a>
                        <?php endif; ?>
                    </h4>
                </div>
                <div class="card-body table-responsive">
                    <p><strong>Professor:</strong> <?= $curso_info['nome_professor'] ?? 'Não informado'; ?></p>
                    <p><strong>Curso:</strong> <?= $curso_info['titulo_curso'] ?? 'Não informado'; ?></p>

                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>IMG</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Duração</th>
                                <th>Visualizar</th>
                                <th>Editar</th>
                                <th>Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($resultModulos->num_rows > 0): ?>
                                <?php while ($modulo = $resultModulos->fetch_assoc()): ?>
                                    <?php
                                        // Busca a duração total das aulas apenas para o módulo atual
                                        $queryDuracao = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(duracao))) AS total_duracao FROM aula WHERE id_modulo = ?";
                                        $stmtDuracao = $mysqli->prepare($queryDuracao);
                                        $stmtDuracao->bind_param("i", $modulo['id']);
                                        $stmtDuracao->execute();
                                        $resultDuracao = $stmtDuracao->get_result();
                                        $rowDuracao = $resultDuracao->fetch_assoc();
                                        $total_duracao = $rowDuracao['total_duracao'] ?? '00:00:00';
                                    ?>
                                    <tr>
                                        <td><?= $modulo['id']; ?></td>
                                        <td><img height='80px' src='img/modulos/<?= $modulo["imagem"] ?>'></td>
                                        <td><?= $modulo['titulo']; ?></td>
                                        <td><?= $modulo['descricao']; ?></td>
                                        <td><?= $total_duracao; ?> horas</td>
                                        <td>
                                            <a href="aula-view.php?id=<?= $modulo['id']; ?>" class="btn btn-primary btn-sm">
                                                Visualizar
                                            </a>
                                        </td>
                                        <td>
                                            <a href="aula-edit.php?id=<?= $modulo['id']; ?>" class="btn btn-success btn-sm">
                                                Editar
                                            </a>
                                        </td>
                                        <td>
                                            <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Você tem certeza que deseja deletar este curso?');">
                                                <button type="submit" name="delete_aula" value="<?= $modulo['id']; ?>" class="btn btn-danger btn-sm">
                                                    Deletar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Nenhum módulo encontrado para este curso.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
