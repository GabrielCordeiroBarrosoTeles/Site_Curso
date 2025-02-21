<?php
require '../dbcon.php';

header('Content-Type: application/json');

if(isset($_GET['aluno']) && isset($_GET['curso'])) {
    $aluno = (int) $_GET['aluno'];
    $curso = (int) $_GET['curso'];

    $query = "SELECT id FROM matricula WHERE id_aluno = ? AND id_curso = ?";
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "ii", $aluno, $curso);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $exists = (mysqli_num_rows($result) > 0);

    echo json_encode(["exists" => $exists]);
    exit;
}

echo json_encode(["exists" => false]);
?>
