<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=Clinica;charset=utf8;','root','Wilio@18061994');
if(isset($_POST['enviar'])){
    if(!empty($_POST['name']) AND !empty($_POST['senha']) AND !empty($_POST['email'])){
        $name= htmlspecialchars($_POST['name']);
        $cpf= htmlspecialchars($_POST['cpf']);
        $email= htmlspecialchars($_POST['email']);
        $contact= htmlspecialchars($_POST['contact']);
        $senha=sha1($_POST['senha']);
        $inserUser = $bdd->prepare('INSERT INTO users(name,cpf,email,contact,senha)VALUES(?,?,?,?,?)');
        $inserUser->execute(array($name, $cpf, $email, $contact, $senha));
       
        $recupUser = $bdd->prepare('SELECT * FROM users WHERE name = ? AND senha=?');
        $recupUser->execute(array($name,$senha));
        if($recupUser->rowCount() >0){
            
        $_SESSION['name']= $name;
        $_SESSION['senha']= $senha;
        $_SESSION['id']= $recupUser->fetch()['id'];}

        echo $_SESSION['id'];

    } else{ echo"por favor verifique novamente";}
    }
    ?>
<!DOCTYPE html>
<html>
    ,<head>
        <title> se cadastrar</title>
        <meta charset="utf-8">
    </head>
    <body>
        <form method="POST" action="" align="center">
            <input type="text" name="name" autocomplete="off">
            <br/>
            <input type="text" name="cpf"  autocoplete="off">
            <br/>
            <input type="text" name="email" >
            <br/>
            <input type="text" name="contact">
            <br/>
            <input type="password" name="senha" autocomplete="off" >
            <br/>
            <input type="submit" name="enviar">

        </form>

    </body>
    </html>
