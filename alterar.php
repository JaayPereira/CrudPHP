<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<?php
$pdo = new PDO('mysql:host=localhost;dbname=crudJaya', 'root', '');

if (isset($_GET['id_pessoa'])) {
    $id_pessoa = (int) $_GET['id_pessoa'];
    $sql = $pdo->prepare("SELECT * FROM tab_dados WHERE id_pessoa = $id_pessoa");
    $sql->execute();
    $pessoas = $sql->fetchAll();
    foreach ($pessoas as $pessoa) {
        echo "<form method='POST'>";
        echo "<legend>Insira os dados abaixo</legend>";
        echo "<fieldset>";
        echo "<div>";
        echo "Nome: <input type='text' name='nome' value='" . $pessoa['nome'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Matrícula: <input type='text' name='cpf' value='" . $pessoa['cpf'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "Nota 1: <input type='text' name='email' value='" . $pessoa['email'] . "'>";
        echo "</div>";
        echo "<div>";
        echo "<input type='submit' value='Enviar'>";
        echo "<input type='reset' value='Limpar Dados'>";
        echo "</div>";
        echo "<br>";
        echo "</fieldset>";
        echo "</form>";
    }
}

if (isset($_POST['nome'])) {
    $sql = $pdo->prepare("UPDATE tab_dados SET nome = ?, cpf = ?, email = ? WHERE id_pessoa = $id_pessoa");
    $sql->execute(array($_POST['nome'], $_POST['cpf'], $_POST['email']));
    echo "<h1>Usuário com id = $id_pessoa alterado com sucesso!</h1>";
    //fazer botao para voltar para a pagina de listagem
    echo "<a href='index.php'>Voltar</a>";
}