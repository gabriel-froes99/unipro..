<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "unipro_db";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $perfil = $_POST['perfil'];
    $senha = $_POST['senha'];

    // Prepara a consulta SQL para inserir os dados
    $sql = "INSERT INTO usuarios (nome, email, telefone, perfil, senha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $email, $telefone, $perfil, $senha);

    // Executa a consulta e verifica se deu certo
    if ($stmt->execute()) {
        // Cadastro bem-sucedido, redireciona para a página principal
        header("Location: paginap.html");
        exit(); // Encerra o script após o redirecionamento
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    // Fecha o statement
    $stmt->close();
}

// Fecha a conexão com o banco de dados
$conn->close();
?>