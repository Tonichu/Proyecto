Comandos para entrar en mysql por shell
\sql
\connect root@localhost
select * from usuarios\G; para ver las consultas de manera vertical 

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

CREATE TABLE PUNTUACIONES (
    id_puntuacion INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    puntuacion INT NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuarios)
);

CREATE TABLE CLASES (
    id_clases INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    id_profesor INT, -- Permitir valores nulos para el profesor
    FOREIGN KEY (id_profesor) REFERENCES USUARIOS(id_usuarios) ON DELETE SET NULL -- Permitir valores nulos y establecer en nulo si el profesor es eliminado
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
    fecha_hora_inicio DATETIME,
    fecha_hora_fin DATETIME,
    FOREIGN KEY (id_clases) REFERENCES CLASES(id_clases),
    FOREIGN KEY (id_salas) REFERENCES SALAS(id_salas)
);

CREATE TABLE INSCRIPCIONES (
    id_inscripcion INT PRIMARY KEY AUTO_INCREMENT,
    id_sesion INT NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_sesion) REFERENCES SESIONES(id) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuarios),
    CONSTRAINT unique_user_session UNIQUE (id_sesion, id_usuario)
);

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
INSERT INTO USUARIOS (nombre, apellidos, telefono, correo_electronico, direccion, pass, tipo_usuarios)
VALUES 
        ('Juan', 'López', '123456789', 'juan@example.com', 'Calle Principal 123', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 2),
       ('María', 'González', '987654321', 'maria@example.com', 'Avenida Central 456', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 1),
       ('Pedro', 'Martínez', '555555555', 'pedro@example.com', 'Plaza Mayor 789', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 0),
        ('pepe', 'González', '123456789', 'pepe@example.com', 'Calle 123', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 2),
       ('mariana', 'López', '987654321', 'mariana@example.com', 'Avenida 456', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 2),
       ('Carlos', 'Martínez', '555555555', 'carlos@example.com', 'Plaza Principal', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 1),
       ('Ana', 'Pérez', '333333333', 'ana@example.com', 'Carretera 789', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 2),
       ('yeray', 'Ruiz', '777777777', 'yeary@example.com', 'Bulevar 012', '$2y$10$Dpb5y8OkdJ.TA60LAnp9kuvkbYfiI7ZbLhIi.xcemaLF2TlEfYBVa', 2);

INSERT INTO CLASES (nombre, descripcion, id_profesor)
VALUES ('Yoga', 'Clase de yoga para principiantes',2),
       ('Pilates', 'Clase de pilates enfocada en la flexibilidad y el fortalecimiento',2),
       ('Spinning', 'Clase de spinning para mejorar la resistencia cardiovascular',6);

INSERT INTO SALAS (nombre, aforo)
VALUES ('Sala 1', 5),
       ('Sala 2', 8),
       ('Sala 3', 10);

INSERT INTO Maquinas (nombre, foto, descripcion, fecha_adquisicion, ultima_revision, id_sala)
VALUES ('Máquina 1', NULL, 'Máquina de pesas', '2023-01-15', '2024-02-28', 1),
       ('Máquina 2', NULL, 'Cinta de correr', '2023-02-20', '2024-02-28', 2),
       ('Máquina 3', NULL, 'Bicicleta estática', '2023-03-25', '2024-02-28', 3);

INSERT INTO SESIONES (id_clases, id_salas, fecha_hora_inicio,fecha_hora_fin)
VALUES (1, 1, '2024-03-15 10:00:00', '2024-03-15 11:00:00'),
       (1, 2, '2024-03-17 10:00:00', '2024-03-17 11:30:00'),
       (2, 3, '2024-03-16 18:00:00', '2024-03-16 19:00:00');

INSERT INTO INSCRIPCIONES (id_sesion, id_usuario)
VALUES (1, 1);

       INSERT INTO INSCRIPCIONES (id_sesion, id_usuario)
VALUES (2, 6),
       (1, 4),
       (1, 7),
       (2, 4),
       (2, 7),
       (2, 8);


--la pass es 1234
--INSERT INTO INSCRIPCIONES (id_sesion, id_usuario) VALUES (1, 123);
--INSERT INTO ejemplo (fecha_hora) VALUES (NOW()); meter la fecha actual*
--INSERT INTO ejemplo (fecha_hora) VALUES ('2024-03-01 15:30:00');