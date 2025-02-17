<?php
    session_start();
    require '../dbcon.php';

// Conexão com o banco de dados (substitua com suas próprias informações de conexão)
$mysqli = new mysqli('localhost',"root","","sitecurso");

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

if (isset($_POST['delete_cursos'])) {
    $curso_id = mysqli_real_escape_string($mysqli, $_POST['delete_cursos']);
    $query = "DELETE FROM curso WHERE id='$curso_id'";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['message'] = "Curso excluído com sucesso!";
        header("Location: exibir_cursos.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Falha ao excluir o curso";
        header("Location: home.php");
        exit(0);
    }
}

function validar_valor($valor) {
    return floatval(str_replace(',', '.', $valor));
}

if (isset($_POST['update_curso'])) {
    $curso_id = mysqli_real_escape_string($mysqli, $_POST['curso_id']);
    $titulo = mysqli_real_escape_string($mysqli, $_POST['titulo']);
    $descricao = mysqli_real_escape_string($mysqli, $_POST['descricao']);
    $categoria = mysqli_real_escape_string($mysqli, $_POST['categoria']);
    $valorDoCurso = validar_valor(mysqli_real_escape_string($mysqli, $_POST['valorDoCurso']));
    $id_prof = mysqli_real_escape_string($mysqli, $_POST['professor']);

    // Verificar se o id_prof existe na tabela de professores
    $prof_query = "SELECT id FROM professor WHERE id='$id_prof'";
    $prof_result = mysqli_query($mysqli, $prof_query);
    if (mysqli_num_rows($prof_result) == 0) {
        $_SESSION['message'] = "ID do professor inválido";
        header("Location: home.php");
        exit(0);
    }

    if (!empty($_FILES['imagem_capa']['name'])) {
        $imagem = basename($_FILES['imagem_capa']['name']);
        $imagem_temp = $_FILES['imagem_capa']['tmp_name'];
        $imagem_destination = "img/categoria/$imagem";

        if (!is_dir('img/categoria')) {
            mkdir('img/categoria', 0777, true);
        }

        if (!move_uploaded_file($imagem_temp, $imagem_destination)) {
            $_SESSION['message'] = "Falha ao mover o arquivo de imagem";
            header("Location: home.php");
            exit(0);
        }

        $query = "UPDATE curso SET titulo=?, descricao=?, categoria=?, valor=?, id_prof=?, imagem_capa=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssisi", $titulo, $descricao, $categoria, $valorDoCurso, $id_prof, $imagem, $curso_id);
    } else {
        $query = "UPDATE curso SET titulo=?, descricao=?, categoria=?, valor=?, id_prof=? WHERE id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssis", $titulo, $descricao, $categoria, $valorDoCurso, $id_prof, $curso_id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Curso atualizado com sucesso!";
        header("Location: exibir_cursos.php");
        $stmt->close();
        exit(0);
    } else {
        $_SESSION['message'] = "Falha ao atualizar o curso";
        header("Location: home.php");
        $stmt->close();
        exit(0);
    }
}

if (isset($_POST['save_curso'])) {
    $titulo = mysqli_real_escape_string($mysqli, $_POST['titulo']);  
    $descricao = mysqli_real_escape_string($mysqli, $_POST['descricao']);
    $categoria = mysqli_real_escape_string($mysqli, $_POST['categoria']);
    $valorDoCurso = mysqli_real_escape_string($mysqli, $_POST['valorDoCurso']);
    $id_prof = mysqli_real_escape_string($mysqli, $_POST['id_prof']);

    // Processar o upload da foto
    $imagem = basename($_FILES['imagem_capa']['name']);
    $imagem_temp = $_FILES['imagem_capa']['tmp_name'];
    $imagem_destination = 'img/categoria/' . $imagem;
    if (!move_uploaded_file($imagem_temp, $imagem_destination)) {
        $_SESSION['message'] = "Falha ao mover o arquivo de imagem";
        header("Location: home.php");
        exit(0);
    }

    $query = "INSERT INTO curso (titulo, descricao,categoria, valor, id_prof, imagem_capa) VALUES ('$titulo', '$descricao', '$categoria', '$valorDoCurso', '$id_prof','$imagem')";

    $query_run = mysqli_query($mysqli, $query);
    if ($query_run) {
        $_SESSION['message'] = "Curso cadastrado com sucesso!";
        header("Location: exibir_cursos.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Falha ao cadastrar o curso";
        header("Location: home.php");
        exit(0);
    }
}

if(isset($_POST['save_cliente'])) {
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $cpf = mysqli_real_escape_string($mysqli, $_POST['cpf']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $telefone = mysqli_real_escape_string($mysqli, $_POST['telefone']);
    
    $query = "INSERT INTO cliente (nome,cpf,email,telefone) VALUES ('$nome','$cpf','$email','$telefone')";
    $query_run = mysqli_query($mysqli, $query);
    if($query_run) {
        $_SESSION['message'] = "cliente cadastrado com sucesso!";
        header("Location: exibir_cliente.php");
        exit(0);
    } else {
        $_SESSION['message'] = "cliente não cadastrado";
        header("Location: exibir_cliente.php");
        exit(0);
    }
}

if (isset($_POST['delete_cliente'])) {
    $student_id = mysqli_real_escape_string($mysqli, $_POST['delete_cliente']);
    $query = "DELETE FROM cliente WHERE id='$student_id' ";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['message'] = "cliente excluído com sucesso";
        header("Location: exibir_cliente.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Não foi possível excluir o cliente";
        header("Location: exibir_cliente.php");
        exit(0);
    }
}

if (isset($_POST['update_cliente'])) {
    $student_id = mysqli_real_escape_string($mysqli, $_POST['student_id']);
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $cpf = mysqli_real_escape_string($mysqli, $_POST['cpf']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $telefone = mysqli_real_escape_string($mysqli, $_POST['telefone']);

    $query = "UPDATE cliente SET nome='$nome', cpf='$cpf', email='$email', telefone='$telefone' WHERE id='$student_id' ";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['message'] = "cliente atualizado com sucesso";
        header("Location: home.php");
        exit(0);
    } else {
        $_SESSION['message'] = "cliente não atualizado";
        header("Location: home.php");
        exit(0);
    }
}
?>
