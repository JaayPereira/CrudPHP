<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Crud Jaya</title>
</head>

<body>
    <?php

    $pdo = new PDO("mysql:host=localhost;dbname=crudJaya", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['excluir'])) {
        $id_pessoa = (int) $_GET['excluir'];
        $pdo->exec("DELETE FROM tab_dados WHERE id_pessoa = $id_pessoa");
        echo "<h2>Id $id_pessoa foi excluído com sucesso!</h2>";

        header("Location: index.php");
    }

    if (isset($_POST['nome'])) {
        $sql = $pdo->prepare("INSERT INTO `tab_dados` VALUES (null, ?, ?, ?)");
        $nome = $_POST['nome'];
        $sql->execute(array($nome, $_POST['cpf'], $_POST['email']));
        echo "<h2> $nome cadastrado com sucesso!</h2>";
    }

    ?>

    <div >
        <form method="POST" max-width="80%">
            <legend>
                <h2 >Cadastro de Pessoas</h2>
            </legend>
            <fieldset>
                <div>
                    Nome: <input type="text" name="nome" >
                </div>
                <div>
                    CPF: <input type="text" name="cpf">
                </div>
                <div>
                    E-Mail : <input type="text" name="email">
                </div>
                <div>
                    <input type="submit" value="Enviar">

                    <input type="reset" value="Limpar Dados">
                </div>
        </form>
        </fieldset>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
    <br>
    <?php
    $sql = $pdo->prepare("SELECT * FROM `tab_dados`");
    $sql->execute();
    $pessoas = $sql->fetchAll();
    echo "<div'><div>";
    echo "<table>";
    echo "<thead >";
    echo "<tr>";
    echo "<th scope='col' colspan='2'>Ações</th>";
    echo "<th scope='col'>Nome</th>";
    echo "<th scope='col'>CPF</th>";
    echo "<th scope='col'>E-Mail</th>";
    echo "</tr></thead><tbody >";

    foreach ($pessoas as $pessoa) {
        echo "<tr>";
        echo '<td align=center>
        <a href="?excluir=' . $pessoa['id_pessoa'] . '">( X )</a>
        </td>';
        echo '<td align=center>
        <a href="alterar.php?id_pessoa=' . $pessoa['id_pessoa'] . '">( Alterar )</a>
        </td>';
        echo "<td>" . $pessoa['nome'] . "</td>";
        echo "<td>" . $pessoa['cpf'] . "</td>";
        echo "<td>" . $pessoa['email'] . "</td>";
        echo "</tr>";
    }
    echo "</div></div>";
    ?>

</body>

</html>