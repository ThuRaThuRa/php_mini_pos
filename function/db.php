<?php
$conn = new PDO("mysql:host=localhost;dbname=pos", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function query($sql, $param = [])
{
    global $conn;
    $stmt = $conn->prepare($sql);
    return $stmt->execute($param);
}

function getOne($sql, $param = [])
{
    global $conn;
    $stmt = $conn->prepare($sql);

    $stmt->execute($param);
    return $stmt->fetch(PDO::FETCH_OBJ);
}
function getAll($sql, $param = [])
{
    global $conn;
    $stmt = $conn->prepare($sql);

    $stmt->execute($param);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}