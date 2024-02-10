CREATE DATABASE Gym;
USE Gym;
CREATE TABLE USUARIO (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255),
    pass VARCHAR(255),
    tipo_usuario TINYINT(1),
    CONSTRAINT chk_tipo_usuario CHECK (tipo_usuario IN (0, 1))
);

CREATE TABLE PROYECTO (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255)
);

CREATE TABLE TAREA (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario INT,
    proyecto INT,
    nombre VARCHAR(255),
    estado INT,
    FOREIGN KEY (usuario) REFERENCES USUARIO(id),
    FOREIGN KEY (proyecto) REFERENCES PROYECTO(id),
    CONSTRAINT chk_estado CHECK (estado BETWEEN 1 AND 3)
);

INSERT INTO USUARIO (nombre, pass, tipo_usuario)
VALUES ('toni', '$2y$10$tw5fIbW7Lsd3RjBHlBGxP.zlmnND7fIbOOVyOR8WDZBsNFxXi.ub6', 1);
INSERT INTO USUARIO (nombre, pass, tipo_usuario)
VALUES ('Ivan', '$2y$10$tw5fIbW7Lsd3RjBHlBGxP.zlmnND7fIbOOVyOR8WDZBsNFxXi.ub6', 1);
INSERT INTO USUARIO (nombre, pass, tipo_usuario)
VALUES ('Sergio', '$2y$10$tw5fIbW7Lsd3RjBHlBGxP.zlmnND7fIbOOVyOR8WDZBsNFxXi.ub6', 1);

INSERT INTO PROYECTO (nombre)
VALUES ('Sentadillas');


INSERT INTO TAREA (usuario, proyecto, nombre, estado)
VALUES (1, 1, 'Extraescolar', 1);
