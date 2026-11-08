<?php
require 'conexion.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nombre = trim($_POST['nombre'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$carrera = trim($_POST['carrera'] ?? '');

if (!$id || $nombre === '' || $carrera === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    exit('Datos inválidos. Regresa al formulario.');
}

$consulta = $conexion->prepare('UPDATE estudiantes SET nombre = ?, correo = ?, carrera = ? WHERE id = ?');
$consulta->execute([$nombre, $correo, $carrera, $id]);

header('Location: crud.php');
exit;
