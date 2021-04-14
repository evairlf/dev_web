<?php
require_once 'php/usuario.php';
$usuario = new Usuario('localhost', 'dev_web', 'root', '');

session_start();
if ((!isset($_SESSION['login']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    header('localhost/dev_web/index.php');
}

$logado = $_SESSION['login'];

?>

<!DOCTYPE html <html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edita Hora</title>

    <link rel="stylesheet" href="css/style.css">
    <script>
        function validaHora() {
            var dataEntrada = document.getElementById("dataEntrada");
            var dataSaida = document.getElementById("dataSaida");
            var opcao = document.getElementById("opcao");
            var dataLimiteMin = new Date("2020-1-1");
            var dataLimiteMax = new Date("2020-12-31");



            if (dataEntrada < dataLimiteMin) {
                alert("Data Invalida");
                dataEntrada.focus();
                return false;
            }



            if (opcao.value == "") {
                alert("Selecione uma opção!");
                alert("CAD" + dataLimiteMax);
                opcao.focus();
                return false;
            }





        }
    </script>


</head>

<body>

        
<div class="indice">
        <ul class="indice">
            <li><a href="inseretrabalhador.php">Inserir</a></li>
            <li><a href="editaHora.php">Editar</a></li>
            <li><a href="Visualizar.php">Visualizar</a></li>
        </ul>
    </div> 
   <div class="planEditarHora">
        
        <form class="card-insere-trabalhador" action="" method="POST">
         
            <div class="">

                <div class="usuario-perfil">
                    <h2 class="usuario"><?php
                                        $user = $usuario->getTrab_id();
                                        for ($i = 0; $i < count($user); $i++) {
                                            foreach ($user[$i] as $k => $v) {
                                                if ($k == "usuario") {
                                                    echo "Usuario: " . $v;
                                                }
                                            }
                                        }

                                        ?></h2>
                    <h2 class="perfil"><?php
                                        $user = $usuario->getTrab_id();
                                        for ($i = 0; $i < count($user); $i++) {
                                            foreach ($user[$i] as $k => $v) {
                                                if ($k == "Tipo") {
                                                    echo "Tipo: " . $v;
                                                }
                                            }
                                        }

                                        ?></h2>
                </div>
                <div class="">
                    <h2>Consulta</h2>
                    <table align="center">
                        <thread>
                            <tr>
                                <th>Data Entrada</th>
                                <th>Data Saida</th>
                                <th>Justificativa</th>
                            </tr>
                            <td><input id="dataEntrada" name="dataEntrada" type="date" min="2020-1-1" max="2020-12-31" required></td>
                            <td><input id="dataSaida" name="dataSaida" type="date" min="2020-1-1" max="2020-12-31" required></td>
                            <td>
                                <form action="" method="POST"><select id="Justificativa" name="Justificativa">
                                        <option select disable value="">Todas</option>
                                        <option value="Prod. Conteudo">Prod.Conteudo</option>
                                        <option value="Versionamento">Versionamento</option>
                                        <option value="Capacitação">Capacitação</option>
                                        <option value="Emprestimo">Empréstimo</option>
                                    </select></form>
                            </td>
                        </thread>
                    </table>
                    <?php
                    if (isset($_POST['dataEntrada'])) {
                        $dataEntrada = addslashes($_POST['dataEntrada']);
                        $dataSaida = addslashes($_POST['dataSaida']);
                        $id_user = $usuario->getTrab_idwithLogin($_SESSION['login']);
                        $Justificativa = addslashes($_POST['Justificativa']);
                        $idzinho;
                        for ($i = 0; $i < count($id_user); $i++) {
                            foreach ($id_user[$i] as $k => $v) {
                                if ($k == "ID_user") {
                                    $idzinho = $v;
                                }
                            }
                        }
                        
                    }
                    if(isset($_POST['dataSaida'])){
                        $dados = $usuario->searchWithDate($dataEntrada, $dataSaida, $idzinho, $Justificativa);
                    }
                    
                    unset($_POST['dataSaida']);
                    unset($_POST['dataEntrada']);
                    ?>

                    <div><button id="bt-insere" type="submit" onclick="return validaHora()">Inserir</button></div>
        </form>
        <form class="" action="" method="GET">
            <h2>Lista De Horas</h2>


            <table align="center">
                <thread>
                    <tr>
                        <th>Data</th>
                        <th>Hora Entrada</th>
                        <th>Hora Saida</th>
                        <th>Total Horas</th>
                        <th>Justificativa</th>
                        <th>Opções</th>
                    </tr>

                    <?php
                    if (!empty($dados)) {
                        if(count($dados)>0){
                        for ($i = 0; $i < count($dados); $i++) {
                            echo "<tr>";
                            $sum = null;
                            $entrada = null;
                            $saida = null;
                            $ID_Horatrab = null;
                            foreach ($dados[$i] as $k => $v) {

                                if ($k == "horaEntrada") {
                                    $entrada = new DateTime($v);
                                } else if ($k == "horaSaida") {
                                    $saida = new DateTime($v);
                                }

                                if ($k != "horaEntrada" && $k != "horaSaida" && $k != "dataAtual" && $k != "ID_horaTrab" && $k != "ID_user") {
                                    $sum = $entrada->diff($saida);
                                    echo "<td>" . $sum->h . "</td>";
                                }

                                if ($k != "ID_horaTrab" && $k != "ID_user") {
                                    echo "<td>" . $v . "</td>";
                                }


                            }
                    ?>      
                            
                            <td><a href="editaHora.php?edit=<?php echo $dados[$i]['ID_horaTrab']; ?>"><img src="css/imagem/u206.png"></a>
                                <a href="editaHora.php?value=<?php echo $id_hora = $dados[$i]['ID_horaTrab']; ?>">
                                    <img src="css/imagem/u220.png" alt=""></a>
                            </td><?php
                                   
                        }
                    }
                            }
                                    ?>


                </thread>
            </table>

            <div>
                <h2>Legenda: </h2>
                <p id="legenda"><img src="css/imagem/u206.png" alt="xinforinfolaespectral"> Editar <img src="css/imagem/u220.png" alt="xinforinfolaespectral"> Apagar</p>
            </div>

    </div>
    <div class="bts"><button id="bt-insere" type="submit">Voltar</button>
        <a href="analise.html" type="button"> <button id="bt-insere" type="button">Enviar para Analise</button></a>
    </div>

    </div>

    </div>
    </form>




    </div>
    
</body>

</html>

<?php

if (isset($_GET['value'])) {
    $usuario1 = addslashes($_SESSION['login']);
    $id_trab = addslashes($_GET['value']);
    $usuario->deleteFromTable($id_trab);
   // header("location: index.php");
}
?>