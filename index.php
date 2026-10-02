<?php

include 'infra/connect.php';
$sql = "SELECT * FROM produtos";
$resultado = mysqli_query($conn, $sql);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario'] ?? null;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Produtos</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <div class="body_index">

    <main>
        <h1>Gerenciador de Produtos</h1>
        <button><a href="public/cadastrar_produto.php"> Novo Produto</a></button>
        <br>
        <br>
        
        <div class="table_produtos">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Descrição</th>
                    <th>ID do Produto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    </div>
                    <?php

                    while ($produto = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        echo "<td>{$produto['nome']}</td>";
                        echo "<td>{$produto['categoria']}</td>";
                        echo "<td>{$produto['preco']}</td>";
                        echo "<td>{$produto['quantidade']}</td>";
                        echo "<td>{$produto['descricao']}</td>";
                        echo "<td>{$produto['id']}</td>";
                        echo "<td>
                                <a href='public/editar_produto.php?id={$produto['id']}'>Editar</a> |
                                <a href='public/excluir_produto.php?id={$produto['id']}'>Excluir</a>
                              </td>";
                        echo "</tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </main>

</div>
</body>

</html>