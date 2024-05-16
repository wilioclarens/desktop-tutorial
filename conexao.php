<?php
session_start();
$bdd=new PDO('mysql:host=localhost;dbname=clinica;charset=utf8;','root','Wilio@18061994');
if(isset($_POST['enviar'])){
    if(!empty($_POST['name']) AND !empty($_POST['senha'])){
        $name= htmlspecialchars($_POST['senha']);//Proibir o usuário de carregar código HTML ou JavaScript
        $senha=sha1($_POST['senha']);//Método SHA1 para criptografar a senha
        $inserUser= $bdd->prepare('INSERT INTO users(name,senha) VALUES(?,?)');
        $inserUser->execute(array($name,$senha));

        $recupUser=$bdd->prepare('SELECT * FROM users WHERE name= ? AND senha = ?');
        $recupUser->execute(array($name,$senha));
        
        if ($recupUser->rowcount() > 0){
            $_SESSION['name']= $name;
            $_SESSION['senha']= $seha;
            $_SESSION['id']=$recupUser->fetch()['id'];

        }else{ echo "Seu nome ou senha está incorreto, por favor, verifique novamente, obrigado!"}

    } else{
        echo "Por favor, preencha todos os campos";
    }
}
!DOCTYPE html>
<html>
    <head>
        <title> conexao </title>
        <meta Charset="utf-8">
    </head>
    <body>

        <form method="POST" action="" align="center">
            <input type="text" name="name" autocomplete="off">
            <br/>
            <input type="password" name="senha" autocompleto="off">
            <br/>
            <input type="submit" name="enviar">
        </form>
     </body>
    </html>
    
