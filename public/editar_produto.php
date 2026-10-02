<?php

include '../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadoProduto = mysqli_stmt_get_result($stmt);
$produto = mysqli_fetch_assoc($resultadoProduto);

if (!$produto) {
    die('Produto não encontrado.');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $categoria = trim($_POST['categoria']);
    $preco = (float) $_POST['preco'];
    $quantidade = (int) $_POST['quantidade'];
    $descricao = trim($_POST['descricao']);

    $sql = "UPDATE produtos SET nome = ?, categoria = ?, preco = ?, quantidade = ?, descricao = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdisi', $nome, $categoria, $preco, $quantidade, $descricao, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Produto atualizado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao atualizar produto: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <form method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" id="categoria" value="<?php echo htmlspecialchars($produto['categoria']); ?>" required>
        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" step="0.01" value="<?php echo htmlspecialchars($produto['preco']); ?>" required>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" id="quantidade" value="<?php echo htmlspecialchars($produto['quantidade']); ?>" required>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao"><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
        <button type="submit">Atualizar Produto</button>
    </form>
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>
</body>

</html>
           
        
        </select>
    </form>
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>

</body>

</html>