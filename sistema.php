<?php

session_start();
   // print_r($_SESSION);
    if((isset( $_SESSION['email']) == true) and (!isset($_SESSION ['senha']) == true))
    {   
        unset( $_SESSION['email']);
        unset( $_SESSION['senha'] );
        header('Location: login.php');
    }
     $logado = $_SESSION['email'];
     if (isset($_POST['logout'])) {
        session_destroy(); 
        header('Location: login.php'); 
        exit();
    }
    
    if ((isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true)) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
        exit();
    }
    
    $logado = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postagens</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #fff;
            border-bottom: 1px solid #dbdbdb;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 24px;
            color: #333;
        }

        header input[type="text"] {
            width: 200px;
            padding: 5px;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
        }

        .feed {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px auto;
            max-width: 500px;
        }

        .post {
            background-color: #fff;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
            margin-bottom: 20px;
            width: 100%;
            cursor: pointer;
        }

        .post-header {
            display: flex;
            align-items: center;
            padding: 10px;
        }

        .post-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .post-header .username {
            font-weight: bold;
            color: #333;
        }

        .post-image {
            width: 100%;
            height: auto;
            cursor: pointer;
        }

        .post-footer {
            padding: 10px;
        }

        .post-footer p {
            margin: 0;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            margin-top: 8px;
        }

        .like-button, .comment-button {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-right: 15px;
            font-size: 20px;
        }

        .heart-icon, .comment-icon {
            font-size: 20px;
            color: #bbb;
            transition: color 0.3s;
        }

        .like-button.liked .heart-icon {
            color: #e74c3c;
        }

        .like-count, .comment-count {
            margin-left: 8px;
            font-size: 16px;
            color: #333;
        }

        .comment-section {
            display: none;
            flex-direction: column;
            margin-top: 10px;
        }

        .comment-input {
            width: 100%;
            padding: 5px;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
            margin-top: 10px;
        }

        .comment-list {
            list-style: none;
            padding: 0;
            margin-top: 10px;
        }

        .comment {
            background-color: #f1f1f1;
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 5px;
        }

       
        .full-screen-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .full-screen-post {
            background-color: #fff;
            border-radius: 5px;
            max-width: 90%;
            max-height: 90%;
            width: 500px;
            overflow-y: auto;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.5);
        }

        .close-button {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
    <a href="inovações02.php"><button type="button"><h1>Unipro</h1></button></a>
    <input type="text" placeholder="Buscar...">
    <form action="" method="post" style="display:inline;">
        <button type="submit" name="logout" style="background-color: #f44336; color: white; padding: 10px; border: none; cursor: pointer;">Sair</button>
    </form>
        
    </header>

    <div class="feed">
       
        <div class="post" onclick="openFullScreen(this)">
            <div class="post-header">
                <img src="infinity.jpeg.jfif" alt="Profile Image">
                <div class="username">Usuário1</div>
            </div>
            <img class="post-image" src="infinity.jpeg.jfif" alt="Post Image">
            <div class="post-footer">
                <p><strong>Primeira postagem interessante.</strong> Este é um exemplo de conteúdo para a primeira postagem.</p>
                <div class="action-buttons">
                    <div class="like-button" onclick="toggleLike(this)">
                        <span class="heart-icon">&#10084;</span>
                        <span class="like-count">0</span>
                    </div>
                    <div class="comment-button" onclick="toggleComments(this)">
                        <span class="comment-icon">&#128172;</span>
                        <span class="comment-count">0</span>
                    </div>
                </div>
                <div class="comment-section">
                    <input type="text" class="comment-input" placeholder="Adicione um comentário..." onkeypress="addComment(event, this)">
                    <ul class="comment-list"></ul>
                </div>
            </div>
        </div>

        
        <div class="post" onclick="openFullScreen(this)">
            <div class="post-header">
                <img src="unipro.jpeg.webp" alt="Profile Image">
                <div class="username">Usuário2</div>
            </div>
            <img class="post-image" src="unipro.jpeg.webp" alt="Post Image">
            <div class="post-footer">
                <p><strong>Explorando novos projetos.</strong> Este é um exemplo de conteúdo para a segunda postagem.</p>
                <div class="action-buttons">
                    <div class="like-button" onclick="toggleLike(this)">
                        <span class="heart-icon">&#10084;</span>
                        <span class="like-count">0</span>
                    </div>
                    <div class="comment-button" onclick="toggleComments(this)">
                        <span class="comment-icon">&#128172;</span>
                        <span class="comment-count">0</span>
                    </div>
                </div>
                <div class="comment-section">
                    <input type="text" class="comment-input" placeholder="Adicione um comentário..." onkeypress="addComment(event, this)">
                    <ul class="comment-list"></ul>
                </div>
            </div>
        </div>

        

    </div>

    <div class="full-screen-overlay" onclick="closeFullScreen()">
        <div class="close-button" onclick="closeFullScreen()">&#10006;</div>
        <div class="full-screen-post"></div>
    </div>

    <script>
        function toggleLike(element) {
            const likeCount = element.querySelector(".like-count");
            let count = parseInt(likeCount.textContent);

            if (element.classList.contains("liked")) {
                element.classList.remove("liked");
                likeCount.textContent = count - 1;
            } else {
                element.classList.add("liked");
                likeCount.textContent = count + 1;
            }
        }

        function toggleComments(element) {
            const commentSection = element.parentElement.nextElementSibling;
            commentSection.style.display = commentSection.style.display === "flex" ? "none" : "flex";
        }

        function addComment(event, inputElement) {
            if (event.key === "Enter" && inputElement.value.trim() !== "") {
                const commentList = inputElement.nextElementSibling;
                const newComment = document.createElement("li");
                newComment.className = "comment";
                newComment.textContent = inputElement.value.trim();

                commentList.appendChild(newComment);

                const commentCount = inputElement.parentElement.previousElementSibling.querySelector(".comment-count");
                commentCount.textContent = parseInt(commentCount.textContent) + 1;

                inputElement.value = ""; 
            }
        }

        function openFullScreen(postElement) {
            const overlay = document.querySelector(".full-screen-overlay");
            const fullScreenPost = document.querySelector(".full-screen-post");

            fullScreenPost.innerHTML = postElement.innerHTML;
            overlay.style.display = "flex";
        }

        function closeFullScreen() {
            document.querySelector(".full-screen-overlay").style.display = "none";
        }
    </script>
</body>
</html>
