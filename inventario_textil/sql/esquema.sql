CREATE DATABASE IF NOT EXISTS inventario_textil;
USE inventario_textil;

CREATE TABLE telas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(100) NOT NULL,
    color VARCHAR(50) NOT NULL,
    largo FLOAT NOT NULL,
    fecha_ingreso DATE NOT NULL
);
