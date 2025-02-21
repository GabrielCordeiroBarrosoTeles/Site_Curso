<?php
session_start();
require 'dbcon.php';

// Verificação de sessão
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Você precisa estar logado para se inscrever em um curso.";
    echo "<script>
            alert('Você precisa estar logado para se inscrever em um curso.');
            window.location.href = 'index.php';
          </script>";
    exit(0);
}

if (isset($_POST['inscrever'])) {
    $curso_id = mysqli_real_escape_string($mysqli, $_POST['curso_id']);
    $user_id = $_SESSION['user_id'];

    // Verificar se o usuário já está inscrito no curso
    $check_query = "SELECT * FROM matricula WHERE id_curso='$curso_id' AND id_usuario='$user_id'";
    $check_result = mysqli_query($mysqli, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['message'] = "Você já está inscrito neste curso.";
        header("Location: exibir_cursos.php");
        exit(0);
    }

    // Inserir a inscrição na tabela de matrículas
    $query = "INSERT INTO matricula (id_curso, id_usuario) VALUES (?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $curso_id, $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Inscrição realizada com sucesso!";
        header("Location: exibir_cursos.php");
        $stmt->close();
        exit(0);
    } else {
        $_SESSION['message'] = "Falha ao realizar a inscrição.";
        $stmt->close();
        header("Location: exibir_cursos.php");
        exit(0);
    }
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
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <title>Inscrição</title>
</head>
<body>
    <?php include 'includes/navbarmodal.php'; ?> <!-- Navbar -->

    <div class="container mt-5">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Inscrição no Curso</h4>
                    </div>
                    <div class="card-body">
                        <form action="inscricao.php" method="POST">
                            <div class="mb-3">
                                <label for="curso_id" class="form-label">ID do Curso</label>
                                <input type="text" name="curso_id" class="form-control" id="curso_id" required>
                            </div>
                            <button type="submit" name="inscrever" class="btn btn-primary">Inscrever-se</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>