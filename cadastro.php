<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    echo "Método não permitido";
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "unipro_db";

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $perfil = $_POST['perfil'];
    $senha = $_POST['senha'];

   
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, telefone, perfil, senha) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $email, $telefone, $perfil, $senha);

   
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>
