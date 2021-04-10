<?php

include 'conexao.php';

$conn = getConnection();



if(isset($_POST['dataEntrada']) || isset($_POST['horaEntrada']) || isset($_POST['horaSaida']) || isset($_POST['Justificativa'])){
    $dataEntrada = $_POST['dataEntrada'];
    $horaEntrada = $_POST['horaEntrada'];
    $horaSaida = $_POST['horaSaida'];
    $Justificativa = $_POST['Justificativa'];
    echo 'Hora de Saida: '.$horaSaida.'<br>';
    echo 'Hora Entrada: '.$horaEntrada.'<br>';
    echo 'Data: '.$dataEntrada.'<br>';
    echo 'Justificativa: '.$Justificativa.'<br>';
}


$sql = 'INSERT INTO horaTrabahador (usuario,senha) VALUES (?,?)';

