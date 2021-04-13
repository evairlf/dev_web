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
    <title>Edita Hora</title>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>

    <form class= "editar"action="">
        <div class="indice-lado">
            <ul style="list-style: none;">
            <li><a href="inseretrabalhador.php">Inserir</a></li>
            <li><a href="editaHora.php">Editar</a></li>
            <li><a href="">Visualizar</a></li>
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
            <h2>Consulta</h2>
            <table align="center">
                <thread>
                    <tr>
                        <th>Data Entrada</th>
                        <th>Data Saida</th>
                        <th>Justificativa</th>
                    </tr>
                    <td><input type="date"></td>
                    <td><input type="date"></td>
                    <td> <select>
                        <option>Prod.Conteudo</option>
                        <option>Versionamento</option>
                        <option>Capacitação</option>
                        <option>Empréstimo</option>
                    </select></td>
                </thread>
            </table>

            <div><button id="bt-insere"type="submit">Inserir</button></div>
            
            <h2>Lista De Horas</h2>
            <table align="center">
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
                    echo "<tr>";
                    
                }
                
            }
            ?>
                </thread>
            </table>
            <div class="icons"><img src="css/imagem/pdf-download-2617 (2).png" alt=""><img src="css/imagem/excel-4963.png" alt=""><img src="css/imagem/printer-1434.png" alt=""></div>
            <div><h2>Legenda: </h2>
                <p id="legenda"><img src="css/imagem/u206.png" alt="xinforinfolaespectral"> Editar <img src="css/imagem/u220.png" alt="xinforinfolaespectral"> Apagar</p>
            </div>

        </div>
       <h2 id="text">ENVIADO PARA O AVALIADOR!</h2>
       
        </div>
        
        
    </div>

        
</form>
    
</body>
</html>