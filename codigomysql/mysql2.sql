Comandos para entrar en mysql por shell
\sql
\connect root@localhost

CREATE DATABASE Gym;
USE Gym;
CREATE TABLE USUARIOS (
    id_usuarios INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    telefono VARCHAR(255),
    correo_electronico VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    pass VARCHAR(255) NOT NULL,
    tipo_usuarios TINYINT(1) DEFAULT 2,
    foto BLOB, 
    CONSTRAINT chk_tipo_usuarios CHECK (tipo_usuarios IN (0, 1, 2))
);

CREATE TABLE CLASES (
    id_clases INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(250) NOT NULL
);

CREATE TABLE SALAS (
    id_salas INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    aforo INT
);

CREATE TABLE SESIONES (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_clases INT NOT NULL,
    id_salas INT NOT NULL,
    fecha_hora DATETIME,
    FOREIGN KEY (id_clases) REFERENCES CLASES(id_clases),
    FOREIGN KEY (id_salas) REFERENCES SALAS(id_salas)
);
/*--INSERT INTO ejemplo (fecha_hora) VALUES (NOW()); meter la fecha actual*
--INSERT INTO ejemplo (fecha_hora) VALUES ('2024-03-01 15:30:00');*/

CREATE TABLE USUARIOS_SESIONES (
    id_sesion INT NOT NULL,
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_sesion, id_usuario),
    FOREIGN KEY (id_sesion) REFERENCES SESIONES(id),
    FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuarios)
);
/*--INSERT INTO USUARIOS_SESIONES (id_sesion, id_usuario) VALUES (1, 123);*/

CREATE TABLE Maquinas (
    id_maquina INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    foto BLOB,
    descripcion VARCHAR(255),
    fecha_adquisicion DATE,
    ultima_revision DATE,
    id_sala INT,
    FOREIGN KEY (id_sala) REFERENCES SALAS(id_salas)
);
/*INSERT INTO SESIONES (id_clases, id_salas, fecha_hora) 
VALUES 
(1, 1, '2024-02-22'),
(2, 2, '2024-02-23'),
(3, 3, '2024-02-24');*/


INSERT INTO USUARIOS (nombre, apellidos, telefono, correo_electronico, direccion, pass, tipo_usuarios)
VALUES ('Juan', 'López', '123456789', 'juan@example.com', 'Calle Principal 123', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 2),
       ('María', 'González', '987654321', 'maria@example.com', 'Avenida Central 456', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 1),
       ('Pedro', 'Martínez', '555555555', 'pedro@example.com', 'Plaza Mayor 789', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 0);
/*--la pass es 1234*/
INSERT INTO CLASES (nombre, descripcion)
VALUES ('Yoga', 'Clase de yoga para principiantes'),
       ('Pilates', 'Clase de pilates enfocada en la flexibilidad y el fortalecimiento'),
       ('Spinning', 'Clase de spinning para mejorar la resistencia cardiovascular');

INSERT INTO SALAS (nombre, aforo)
VALUES ('Sala 1', 30),
       ('Sala 2', 20),
       ('Sala 3', 25);

INSERT INTO SESIONES (id_clases, id_salas, fecha_hora)
VALUES (1, 1, '2024-03-02 10:00:00'),
       (2, 2, '2024-03-03 11:30:00'),
       (3, 3, '2024-03-04 15:00:00');

INSERT INTO USUARIOS_SESIONES (id_sesion, id_usuario)
VALUES (1, 1),
       (2, 2),
       (3, 3);


INSERT INTO Maquinas (nombre, foto, descripcion, fecha_adquisicion, ultima_revision, id_sala)
VALUES ('Máquina 1', NULL, 'Máquina de pesas', '2023-01-15', '2024-02-28', 1),
       ('Máquina 2', NULL, 'Cinta de correr', '2023-02-20', '2024-02-28', 2),
       ('Máquina 3', NULL, 'Bicicleta estática', '2023-03-25', '2024-02-28', 3);