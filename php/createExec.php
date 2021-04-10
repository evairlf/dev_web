<?php
 
 include 'conexao.php';

$conn = getConnection();

//Esse tipo de código nao se usa é muito perigoso

$sql = "INSERT INTO usuarios (usuario,senha) VALUES ('Morangolito','senhuda')";

if($conn->exec($sql)){
    echo 'Foi de boa';
}else{
    echo 'Erro ao salvar';
}
