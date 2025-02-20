<?php
include("conexao.php"); // Certifique-se de incluir sua conexão

if (isset($_GET['id_modulo'])) {
    $id_modulo = intval($_GET['id_modulo']);

    $query = "SELECT ordem, titulo FROM aula WHERE id_modulo = ? ORDER BY ordem";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id_modulo);
    $stmt->execute();
    $result = $stmt->get_result();

    $max_ordem = 0;
    while ($row = $result->fetch_assoc()) {
        $max_ordem = max($max_ordem, $row['ordem']);
        echo "<option value='{$row['ordem']}'>Antes de {$row['titulo']} (Ordem {$row['ordem']})</option>";
    }

    // Última posição
    echo "<option value='" . ($max_ordem + 1) . "'>Último (Ordem " . ($max_ordem + 1) . ")</option>";
}
?>
