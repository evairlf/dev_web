<?php

include 'conexao.php';

$conn = getConnection();

$sql = 'SELECT * FROM usuarios WHERE id = :id';

$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', 7);
$stmt->execute();



$result = $stmt->fetchAll();

foreach ($result as $value) {
    echo 'User: '.$value['usuario'];
    echo ' Senha: '.$value['senha'];
}