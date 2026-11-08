<?php
// Conexión a la base de datos SQLite.
// La base de datos se crea automáticamente si no existe.
$conexion = new PDO('sqlite:' . __DIR__ . '/estudiantes.db');
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Crear la tabla la primera vez que se abre el proyecto.
$conexion->exec("CREATE TABLE IF NOT EXISTS estudiantes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    correo TEXT NOT NULL,
    carrera TEXT NOT NULL
)");
