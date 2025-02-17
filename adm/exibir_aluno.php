<?php
    // Inclui a verificação de sessão, que deve ser o primeiro a ser chamado
    require 'session_check.php'; // Corrija o caminho caso o arquivo 'session_check.php' esteja em outro diretório

    // Inclua a conexão com o banco de dados, se necessário
    require '../dbcon.php';
?>
 

<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <title>Exibir aluno</title>
    <style>
            ::-webkit-scrollbar{
                width: 10px;
            }::-webkit-scrollbar-track{
                background: #E7DFDD; 
                border-radius: 30px;
            }::-webkit-scrollbar-thumb{
                background: #000000;
                border-radius: 30px;
            }
        </style>
</head>
<body>
    <?php include './includes/navbar_modal.php'?><!--Navbar-->
    <div class="container mt-4">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalhes dos alunos
                            <?php if (isset($_SESSION['user_tipo_usuario']) && $_SESSION['user_tipo_usuario'] === 'adm'): ?>
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-primary float-end">Adicionar aluno</a>
                            <?php endif; ?>
                        </h4>
                    </div>
                    <div class="card-body table-responsive">

                        <table class="table table-bordered table-striped" id="example" style="align-items: center;text-align: center;">
                            <thead style="align-items: center;text-align: center;">
                                <tr style="align-items: center;text-align: center;">
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Curso</th>
                                    <th>Descrição</th>
                                    <th>Data de matricula</th>
                                    <th>Visualizar</th>
                                    <th>Editar</th>
                                    <?php if (isset($_SESSION['user_tipo_usuario']) && $_SESSION['user_tipo_usuario'] === 'adm'): ?>
                                        
                                        <th>Deletar</th>
                                    <?php endif; ?>

                                </tr>
                            </thead>
                            <tbody style="align-items: center;text-align: center;">
                                <?php 
                                    $query = "SELECT 
                                                a.id AS aluno_id,
                                                a.nome,
                                                a.sobrenome,
                                                a.email,
                                                u.tipo_usuario,
                                                GROUP_CONCAT(DISTINCT c.titulo SEPARATOR ', ') AS curso,
                                                GROUP_CONCAT(DISTINCT c.descricao SEPARATOR ' | ') AS descricao_curso,
                                                GROUP_CONCAT(DISTINCT DATE_FORMAT(m.data_matricula, '%d/%m/%Y') SEPARATOR ', ') AS data_matricula
                                            FROM aluno a
                                            JOIN usuario u ON a.id_usuario = u.id
                                            LEFT JOIN matricula m ON a.id = m.id_aluno
                                            LEFT JOIN curso c ON m.id_curso = c.id
                                            GROUP BY a.id;
                                            ";
                                    $query_run = mysqli_query($mysqli, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($student['aluno_id']); ?></td>
                                                <td><?= htmlspecialchars($student['nome'] . ' ' . $student['sobrenome']); ?></td>
                                                <td><?= htmlspecialchars($student['email']); ?></td>
                                                <td><?= htmlspecialchars($student['tipo_usuario']); ?></td>
                                                <td><?= !empty($student['curso']) ? htmlspecialchars($student['curso']) : 'Não matriculado'; ?></td>
                                                <td><?= !empty($student['descricao_curso']) ? htmlspecialchars($student['descricao_curso']) : '-'; ?></td>
                                                <td><?= !empty($student['data_matricula']) ? htmlspecialchars($student['data_matricula']) : '-'; ?></td>
                                                <td>
                                                    <a href="aluno-view.php?id=<?= $student['aluno_id']; ?>" class="btn btn-primary btn-sm">
                                                        Vizualizar
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill text-light" viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td> 
                                                    <a href="aluno-edit.php?id=<?= $student['aluno_id']; ?>" class="btn btn-success btn-sm">
                                                        Editar
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <?php if (isset($_SESSION['user_tipo_usuario']) && $_SESSION['user_tipo_usuario'] === 'adm'): ?>
                                                <td> 
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_aluno" value="<?=$student['aluno_id'];?>" class="btn btn-danger btn-sm">
                                                            Deletar
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> Nenhum aluno cadastrado </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--Datatables-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#example').DataTable();
       });     
    </script>
    <!--Termino Datatables-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
        var $seuCampoCpf = $("#cpf");
        $seuCampoCpf.mask('000.000.000-00', {reverse: true});
    });
</script>
</body>
</html>