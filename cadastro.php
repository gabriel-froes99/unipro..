<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(response_code: 405);
    echo "Método não permitido";
    exit();
}

ini_set(option: 'display_errors', value: 1);
ini_set(option: 'display_startup_errors', value: 1);
error_reporting(error_level: E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "unipro_db";

    
    $conn = new mysqli(hostname: $localhost, username: $root, password: null,  database: $unipro_db);

    
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $perfil = $_POST['perfil'];
    $senha = $_POST['senha'];

   
    $stmt = $conn->prepare(query: "INSERT INTO usuarios (nome, email, telefone, perfil, senha) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param(types: "sssss", var: $nome, vars: $email, int: $telefone, int: $perfil, int:$senha);
   
    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
