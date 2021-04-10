<?php
 
 include 'conexao.php';

$conn = getConnection();


$sql = 'INSERT INTO usuarios (usuario,senha) VALUES (?,?)';

$user = 'Mocacão';
$pass = '12345';

$stmt = $conn->prepare($sql);
$stmt->bindParam(1,$user);
$stmt->bindValue(2,"12345");


if($stmt->execute()){
    echo 'Usuario Inserido Com Sucesso';
}else{
    echo 'Coe Doguirran ta errado truta!';
}

