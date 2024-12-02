<?php
    session_start();
//print_r($_REQUEST);
if(isset($_POST['submit']) && !empty($_POST['email'])&& !empty($_POST['senha']))
{
    include_once('cadastro.php');
    $email= $_POST['email'];
    $senha= $_POST['senha'];

    print_r('email: ' . $email);
    print_r('senha: ' . $senha);


    $sql= "select * from usuarios where email = '$email' and senha = '$senha'";
    $result = $mysqli->query($sql);

    if(mysqli_num_rows($result) <1)
    {
       unset($_SESSION['email']);
       unset( $_SESSION['senha'] );
        //print_r('nao existe');
        header('Location: login.php'); 
    }
    else
    {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        //print_r('existe');
        header('Location: sistema.php');
    }
}
else
{
    header('Location: login.php');
}
    

?>