<?php
require 'conexion.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    exit('ID inválido.');
}

$consulta = $conexion->prepare('DELETE FROM estudiantes WHERE id = ?');
$consulta->execute([$id]);

header('Location: crud.php');
exit;
