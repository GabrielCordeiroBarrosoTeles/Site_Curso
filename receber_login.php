<?php
session_start();

require_once 'dbcon.php';

// Verificar se ocorreu erro na conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe o login, a senha e o tipo de usuário do formulário
    $login = htmlspecialchars(trim($_POST['login']));
    $senha = trim($_POST['senha']);
    $tipo_usuario = htmlspecialchars(trim($_POST['tipo_usuario']));

    // Validar se os campos não estão vazios
    if (empty($login) || empty($senha) || empty($tipo_usuario)) {
        $_SESSION['login_error'] = "Preencha todos os campos.";
        header('Location: index.php');
        exit();
    }

    // Preparar a consulta para buscar o usuário no banco de dados
    $sql = "SELECT * FROM usuario WHERE login = ? AND tipo_usuario = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $login, $tipo_usuario); // "ss" para duas strings
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar a senha criptografada
        if (password_verify($senha, $user['senha'])) {
            // Senha correta, iniciar a sessão
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_login'] = $user['login'];
            $_SESSION['user_tipo_usuario'] = $user['tipo_usuario']; // Armazena o tipo_usuario do usuário na sessão

            // Definir mensagem de boas-vindas com base no tipo de usuário
            if ($user['tipo_usuario'] == 'aluno') {
                $_SESSION['welcome_message'] = 'Bem-vindo ao ambiente de aprendizado!';
            } else {
                $_SESSION['welcome_message'] = 'Bem-vindo à página administrativa! Você é ' . $user['tipo_usuario'] . '.';
            }

            $stmt->close();
            $mysqli->close();

            // Redirecionar com base no tipo de usuário
            if ($user['tipo_usuario'] == 'aluno') {
                header('Location: ava/home.php'); // Redirecionar para a pasta ava
            } else {
                header('Location: adm/home.php'); // Redirecionar para home
            }
            exit();
        } else {
            // Senha incorreta
            $stmt->close();
            $mysqli->close();
            $_SESSION['login_error'] = "Login ou senha incorretos!";
            sleep(1); // Adiciona atraso para evitar força bruta
            header('Location: index.php');
            exit();
        }
    } else {
        // Usuário não encontrado
        $stmt->close();
        $mysqli->close();
        $_SESSION['login_error'] = "Login ou senha incorretos!";
        sleep(1); // Adiciona atraso para evitar força bruta
        header('Location: index.php');
        exit();
    }
}
?>