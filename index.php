<?php

require_once 'php/usuario.php';
$usuario = new Usuario('localhost','dev_web','root','');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Usuario</title>

    <link rel="stylesheet" href="css/style.css">

    <script>
        
        function verifica() {
            var email = document.getElementById("login");
            var password = document.getElementById("password");


            if (email.value == "") {
                window.alert("Email nao preenchido");
                email.focus();
                return false;
            }

            if(password.value == ""){
                alert("Senha não preenchida");
                password.focus();
                return false;
            }

        }

    </script>

</head>

<body>

    <form class="form" method="POST" action=ope.php>

        <div class="card">
            <div class="card-top">
                <h2 class="titulo">SAH <br>Sistema de Ajuste De Horas</h2>
                <img class="imglogin" src="css/imagem/login.png" alt="">
                <p>Login de Usuário</p>
            </div>
            <div class="card-group">
                <label>Email</label>
                <input id="loginzinho" type="text" name="login" placeholder="Digite seu email de Login" required>

                <label>Senha</label>
                <input id="password" type="password" name="senha" placeholder="Digite sua senha" required>

                <a
                    href="">Esqueci
                    a senha</a><br>

                <div class="lembre"><input type="checkbox"> Lembre-me </label></div>
                <button class="btn" type="submit" onclick="return verifica()">ACESSAR!</button>

            </div>
        </div>


    </form>

</body>

</html>