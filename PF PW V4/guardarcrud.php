<?php
require 'conexion.php';

$nombre = trim($_POST['nombre'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$carrera = trim($_POST['carrera'] ?? '');

if ($nombre === '' || $carrera === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    exit('Datos inválidos. Regresa al formulario.');
}

$consulta = $conexion->prepare('INSERT INTO estudiantes (nombre, correo, carrera) VALUES (?, ?, ?)');
$consulta->execute([$nombre, $correo, $carrera]);

header('Location: crud.php');
exit;
