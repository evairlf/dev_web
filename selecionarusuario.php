<?php
    session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
      unset($_SESSION['login']);
      unset($_SESSION['senha']);
      header('location:index.php');
      }
    
    $logado = $_SESSION['login'];

    require_once 'php/usuario.php';
    $usuario = new Usuario('localhost','dev_web','root','');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Perfil</title>

    <link rel="stylesheet" href="css/style.css">

    <script>

        function valida() {

            var bagui = document.getElementById("bagui");

            if(bagui.value == ""){
                alert("sem conteudo");
                bagui.focus();
                return false;
            }  

        }
        
    </script>

</head>
<body>

    <form class= "formzao" method="POST">

    <div class="card">
        <div class ="card-top">
            <h2 class="titulo">Selecione o perfil de Usuário</h2>
            <p>Perfis de Usuários</p>
        </div>
        
        <div>
            <select id="bagui" name="bagui">
                <option select disable value="">Selecione</option>
                <option value="Trabalhador">Trabalhador</option>
                <option value="Coordenador de curso">Coordenador de curso</option>
                <option value="Coordenador de Núcleo Pedagógico">Coordenador de Núcleo Pedagógico</option>
            </select>
            <?php
                 if(isset($_POST['bagui'])){
                    $tipo = addslashes($_POST['bagui']);
                   if($usuario->setTipo($tipo)){
                       header('location:inseretrabalhador.php');
                   }
                 }
                ?>
                <button class="btn" type="submit" onclick="return valida()">ACESSAR!</button>
        </div>

        
    </div>

        
</form>
    
</body>
</html>