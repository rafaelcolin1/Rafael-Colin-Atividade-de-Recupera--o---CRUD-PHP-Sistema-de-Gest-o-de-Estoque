<?php
include '../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = $_GET['id'];

$stmt = mysqli_prepare($conn, "DELETE FROM produtos WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);

if (mysqli_stmt_execute($stmt)) {
    echo "Produto excluído com sucesso.";
    echo "<br><a href='../index.php'>Voltar</a>";
} else {
    echo "Erro ao excluir produto: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
?>