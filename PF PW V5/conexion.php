<?php
// Conexión a la base de datos SQLite.
// La base de datos se crea automáticamente si no existe.
$conexion = new PDO('sqlite:' . __DIR__ . '/estudiantes.db');
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Crear la tabla la primera vez que se abre el proyecto.
$conexion->exec("CREATE TABLE IF NOT EXISTS productos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    descripcion TEXT NOT NULL,
    imagen TEXT NOT NULL
)");