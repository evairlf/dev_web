<?php
 require_once 'php/usuario.php';
 $usuario = new Usuario('localhost','dev_web','root','');

 session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
      unset($_SESSION['login']);
      unset($_SESSION['senha']);
      header('location:index.php');
      }
    
    $logado = $_SESSION['login'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Trabalhador</title>

    <link rel="stylesheet" href="css/style.css">

    <script>

        function validaEssaMerda() {
            var dataEntrada = document.getElementById("dataEntrada");
            var horaEntrada = document.getElementById("horaEntrada");
            var horaSaida = document.getElementById("horaSaida");
            var option = document.getElementById("coconivia");

            if (dataEntrada.value == "") {
                alert("Data Invalida");
                dataEntrada.focus();
                return false;

            }

            if (horaEntrada.value == "") {
                alert("Hora de Entrada Invalida");
                horaEntrada.focus();
                return false;
            }

            if (horaSaida.value == "") {
                alert("Hora de saida Invalida");
                horaSaida.focus();
                return false;
            }

            if (option.value == "") {
                alert("selecione uma opção");
                option.focus();
                return false;
            }


        }


    </script>

</head>

<body>
        <?php
        if(isset($_POST[''])){
            
        }
        ?>
    <form class="editar" action="" method="POST">
        <div class="indice">
            <ul">
                <li><a href="inseretrabalhador.php">Inserir</a></li>
                <li><a href="editaHora.php">Editar</a></li>
                <li><a href="Visualizar.php">Visualizar</a></li>
            </ul>
        </div>
        <div class="card-insere-trabalhador">

        <div class="usuario-perfil" >
            <h2 class="usuario"><?php 
            $user = $usuario->getTrab_id();
            for ($i=0; $i < count($user); $i++) { 
                foreach ($user[$i] as $k => $v) {
                    if($k == "usuario"){
                    echo "Usuario: ".$v;
                    }
            }
        }
           
            ?></h2>
            <h2 class="perfil"><?php 
            $user = $usuario->getTrab_id();
            for ($i=0; $i < count($user); $i++) { 
                foreach ($user[$i] as $k => $v) {
                    if($k == "Tipo"){
                    echo "Tipo: ".$v;
                    }
            }
        }
           
            ?></h2>
        </div>
            <div class="card-group">
                <h2>Inserir Hora</h2>
                <table align="center" style="width: 110%;">
                    <thread>
                        <tr>
                            <th>Data</th>
                            <th>Hora Entrada</th>
                            <th>Hora Saida</th>
                            <th>Justificativa</th>
                        </tr>
                        <td><input id="dataEntrada" name="dataEntrada" type="date" min="2020-1-1" max="2020-12-31" required></td>
                        <td><input id="horaEntrada" name="horaEntrada" type="time" min="2020-1-1" max="2020-12-31" required></td>
                        <td><input id="horaSaida" name="horaSaida" type="time"></td>
                        <td><form action="" method="POST"><select id="Justificativa" name="Justificativa">
                            <option select disable value="">Selecione</option>
                            <option value="Prod. Conteudo">Prod.Conteudo</option>
                            <option value="Versionamento">Versionamento</option>
                            <option value="Capacitação">Capacitação</option>
                            <option value="Emprestimo">Empréstimo</option>
                        </select></form>
                            </td>
                            <?php
                            
                 if(isset($_POST['dataEntrada'])){
                    $dataEntrada = addslashes($_POST['dataEntrada']);
                    $horaEntrada = addslashes($_POST['horaEntrada']);
                    $horaSaida = addslashes($_POST['horaSaida']);
                    $id_user = $usuario->getTrab_idwithLogin($_SESSION['login']);
                    $idzinho;
                    for ($i=0; $i < count($id_user); $i++) { 
                        foreach ($id_user[$i] as $k => $v) {
                            if($k == "ID_user"){
                                $idzinho = $v;
                            }
                        }
                    }
                   
                    $Justificativa = addslashes($_POST['Justificativa']);
                   if($usuario->inserirHoras($dataEntrada,$horaEntrada,$horaSaida,$Justificativa,$idzinho)){
                       header('http://localhost/dev_web/inseretrabalhador.php');
                   }
                 }
                ?>
                    </thread>
                </table>

                <div><button class="btn" style="width: 25%;" type="submit" onclick="return validaEssaMerda()">Inserir</button></div>

                <h2>Lista De Horas</h2>
                <table align="center" style="width: 110%;">
                    <thread>
                        <tr>
                            <th>Data</th>
                            <th>Hora Entrada</th>
                            <th>Hora Saida</th>
                            <th>Total Horas</th>
                            <th>Justificativa</th>
                        </tr>
                        <?php
            $dados = $usuario->searchDb();
            if(count($dados) > 0){
                
                for($i=0;$i < count($dados); $i++){
                    echo "<tr>";
                    $sum = null;
                    $entrada = null;
                    $saida = null;
                    foreach ($dados[$i] as $k => $v) {
                       

                        if($k == "horaEntrada"){
                            $entrada = new DateTime($v);
                        }else if($k == "horaSaida"){
                            $saida = new DateTime($v);
                        }

                        if($k != "horaEntrada" && $k != "horaSaida" && $k!= "dataAtual" && $k != "ID_horaTrab" && $k != "ID_user"){
                            $sum = $entrada->diff($saida);
                            echo "<td>".$sum->h."</td>";
                        } 

                        if($k != "ID_horaTrab" && $k != "ID_user"){
                            echo "<td>".$v."</td>";
                        }
                    }
                    ?><?php
                    echo "<tr>";
                    
                }
                
            }
            ?>
                    </thread>
                </table>

                
                <button class="btn" style="width: 20%;float:center ;" type="submit">Voltar</button><button class="btn" style="width: 20%;float:right ;" type="button">Enviar para Analise</button>
                     
                
            </div>

        </div>


    </form>

</body>

</html>