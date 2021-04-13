<?php

include 'conexao.php';

$conn = getConnection();



if(isset($_POST['dataEntrada']) || isset($_POST['horaEntrada']) || isset($_POST['horaSaida']) || isset($_POST['Justificativa'])){
    $dataEntrada = $_POST['dataEntrada'];
    $horaEntrada = $_POST['horaEntrada'];
    $horaSaida = $_POST['horaSaida'];
    $Justificativa = $_POST['Justificativa'];
   /* echo 'Hora de Saida: '.$horaSaida.'<br>';
    echo 'Hora Entrada: '.$horaEntrada.'<br>';
    echo 'Data: '.$dataEntrada.'<br>';
    echo 'Justificativa: '.$Justificativa.'<br>';*/
}


$sql = 'INSERT INTO horaTrabalhador (dataAtual,horaEntrada,horaSaida,Justificativa) VALUES (?,?,?,?)';

$stms = $conn->prepare($sql);
$stms->bindParam(1,$dataEntrada);
$stms->bindParam(2,$horaEntrada);
$stms->bindParam(3,$horaSaida);
$stms->bindParam(4,$Justificativa);

if($stms->execute()){
    echo 'Dados inseridos com sucesso!';
}else{
    echo 'Deu Alguma Merda';
}

