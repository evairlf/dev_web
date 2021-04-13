<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_cache_expire(10400);
    session_start();
  }

   $login = $_POST['login'];
   $senha = $_POST['senha'];

   require_once 'php/usuario.php';
   $usuario = new Usuario('localhost','dev_web','root','');
    
    $result = $usuario->validation($login,$senha);

    if($result){
    $_SESSION['login'] = $login;
    $_SESSION['senha'] = $senha;
    header('location:selecionarusuario.php');
    }else{
        unset ($_SESSION['login']);
        unset ($_SESSION['senha']);
        header('location:index.php') ;
        
    }


?>