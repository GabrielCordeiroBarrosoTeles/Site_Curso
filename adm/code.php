<?php
session_start();
require '../dbcon.php';

// Conexão com o banco de dados (substitua com suas próprias informações de conexão)
$mysqli = new mysqli('localhost', "root", "", "sitecurso");

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

function validar_valor($valor) {
    return floatval(str_replace(',', '.', $valor));
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
    $valorDoCurso = validar_valor(mysqli_real_escape_string($mysqli, $_POST['valorDoCurso']));
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

    $query = "INSERT INTO curso (titulo, descricao, categoria, valor, id_prof, imagem_capa) VALUES ('$titulo', '$descricao', '$categoria', '$valorDoCurso', '$id_prof', '$imagem')";
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

if (isset($_POST['save_aluno_usuario'])) {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $login = $_POST['login'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Hash da senha
    $tipo_usuario = 'aluno';

    // Inserir na tabela usuario
    $stmt = $mysqli->prepare("INSERT INTO usuario (login, senha, tipo_usuario) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $login, $senha, $tipo_usuario);

    if ($stmt->execute()) {
        $id_usuario = $stmt->insert_id;

        // Inserir na tabela aluno
        $stmt = $mysqli->prepare("INSERT INTO aluno (id_usuario, nome, sobrenome, email, telefone) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $id_usuario, $nome, $sobrenome, $email, $telefone);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Cadastro realizado com sucesso!";
            header("Location: exibir_aluno.php");
            $stmt->close();
            exit(0);
        } else {
            $_SESSION['message'] = "Erro ao cadastrar aluno: {$stmt->error}";
            $stmt->close();
            header("Location: home.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Erro ao cadastrar usuário: {$stmt->error}";
        $stmt->close();
        header("Location: home.php");
        exit(0);
    }
}

if (isset($_POST['delete_aluno'])) {
    $student_id = mysqli_real_escape_string($mysqli, $_POST['delete_aluno']);
    $query = "DELETE FROM aluno WHERE id='$student_id'";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['message'] = "Aluno excluído com sucesso";
        header("Location: exibir_aluno.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Não foi possível excluir o aluno";
        header("Location: exibir_aluno.php");
        exit(0);
    }
}

if (isset($_POST['update_aluno'])) {
    $student_id = mysqli_real_escape_string($mysqli, $_POST['student_id']);
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $sobrenome = mysqli_real_escape_string($mysqli, $_POST['sobrenome']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $telefone = mysqli_real_escape_string($mysqli, $_POST['telefone']);

    $query = "UPDATE aluno SET nome='$nome', sobrenome='$sobrenome', email='$email', telefone='$telefone' WHERE id='$student_id'";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['message'] = "Aluno atualizado com sucesso!";
        header("Location: exibir_aluno.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Falha ao atualizar o aluno";
        header("Location: home.php");
        exit(0);
    }
}

if (isset($_POST["save_modulo"])) {
    include "conexao.php"; // Conexão com o banco

    $id_curso = $_POST["id_curso"];
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $ordem_inserida = $_POST["ordem"];
    $imagem = "";

    // Upload da imagem
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        $pasta = "img/modulos/";
        $nomeImagem = basename($_FILES["imagem"]["name"]);
        $caminhoCompleto = $pasta . $nomeImagem;

        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoCompleto)) {
            $imagem = $nomeImagem;
        } else {
            $_SESSION['message'] = "Erro ao enviar a imagem!";
            header("Location: home.php");
            exit(0);
        }
    }

    // Atualiza as ordens dos módulos que vêm depois da posição escolhida
    $query_update = "UPDATE modulo SET ordem = ordem + 1 WHERE id_curso = $id_curso AND ordem >= $ordem_inserida";
    mysqli_query($mysqli, $query_update);

    // Insere o novo módulo na posição correta
    $query_insert = "INSERT INTO modulo (id_curso, titulo, descricao, ordem, imagem) 
                     VALUES ('$id_curso', '$titulo', '$descricao', '$ordem_inserida', '$imagem')";
    
    if (mysqli_query($mysqli, $query_insert)) {
        $_SESSION['message'] = "Módulo salvo com sucesso!";
        header("Location: exibir_modulos.php");
        mysqli_close($mysqli);
        exit(0);
    } else {
        $_SESSION['message'] = "Erro ao salvar o módulo: " . mysqli_error($mysqli);
        mysqli_close($mysqli);
        header("Location: home.php");
        exit(0);
    }
}

if (isset($_POST['save_aula'])) {
    $id_modulo = $_POST['id_modulo'];
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $drive_link = $_POST['drive_link'];
    $ordem = $_POST['ordem'];
    $duracao = $_POST['duracao']; // Captura a duração do formulário

    // Empurrar para frente as aulas com ordem maior ou igual à selecionada
    $queryAtualiza = "UPDATE aula SET ordem = ordem + 1 WHERE id_modulo = ? AND ordem >= ?";
    $stmtAtualiza = $mysqli->prepare($queryAtualiza);
    $stmtAtualiza->bind_param("ii", $id_modulo, $ordem);
    $stmtAtualiza->execute();

    // Inserir a nova aula com duração
    $queryInsert = "INSERT INTO aula (id_modulo, titulo, conteudo, ordem, drive_link, duracao) VALUES (?, ?, ?, ?, ?, ?)";
    $stmtInsert = $mysqli->prepare($queryInsert);
    $stmtInsert->bind_param("ississ", $id_modulo, $titulo, $conteudo, $ordem, $drive_link, $duracao);
    
    if ($stmtInsert->execute()) {
        $_SESSION['message'] = "Aula adicionada com sucesso!";
        header("Location: exibir_modulo.php?id=" . $id_modulo);
        mysqli_close($mysqli);
        exit(0);
    } else {
        $_SESSION['message'] = "Erro ao adicionar aula: " . $stmtInsert->error;
        header("Location: add_curso.php?id=" . $id_modulo);
        mysqli_close($mysqli);
        exit(0);
    }
}


if(isset($_POST['save_matricula'])){
    // Obtém os dados enviados pelo formulário
    $id_aluno = $_POST['aluno']; // ID do aluno selecionado
    $id_curso = $_POST['curso']; // ID do curso selecionado

    // Define a data da matrícula como a data/hora atual
    $data_matricula = date('Y-m-d H:i:s');

    // Prepara a query para inserir os dados na tabela "matrucula"
    $query = "INSERT INTO matricula (id_aluno, id_curso, data_matricula) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($mysqli, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iis", $id_aluno, $id_curso, $data_matricula);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = "Matrícula registrada com sucesso!";
            header("Location: exibir_aluno.php");
            mysqli_close($mysqli);
            exit(0);
        } else {
            $_SESSION['message'] = "Erro ao registrar matrícula: " . mysqli_stmt_error($stmt);
            header("Location: exibir_aluno.php");
            mysqli_close($mysqli);
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Erro na preparação da query.";
        header("Location: exibir_aluno.php");
        mysqli_close($mysqli);
        exit(0);
    }
} else {
    header("Location: home.php");
    exit(0);
}

?>
