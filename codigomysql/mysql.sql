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
    tipo_usuarios TINYINT(1),
    foto BLOB, 
    CONSTRAINT chk_tipo_usuarios CHECK (tipo_usuarios IN (0, 1, 2))
);

CREATE TABLE CLASES (
    id_clases INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    id_usuarios INT,
    aforo_maximo INT NOT NULL,
    FOREIGN KEY (id_usuarios) REFERENCES usuarios(id_usuarios)
);

CREATE TABLE SALAS (
    id_salas INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE Asignacion_Clases_Salas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_clases INT NOT NULL,
    id_salas INT NOT NULL,
    fecha DATE NOT NULL,
    FOREIGN KEY (id_clases) REFERENCES CLASES(id_clases),
    FOREIGN KEY (id_salas) REFERENCES SALAS(id_salas)
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


INSERT INTO usuarios (nombre, apellidos, telefono, correo_electronico, direccion, pass, tipo_usuarios, foto) 
VALUES 
('Juan', 'Pérez', '555-123-4567', 'juan@example.com', 'Calle 123, Ciudad', 'password123', 1, NULL),
('María', 'López', '555-987-6543', 'maria@example.com', 'Av. Principal 456', 'pass123', 2, NULL),
('Carlos', 'García', '555-555-5555', 'carlos@example.com', 'Calle Secundaria', 'abc123', 0, NULL);

INSERT INTO CLASES (nombre, hora_inicio, hora_fin, id_usuarios,aforo_maximo) 
VALUES 
('Yoga', '09:00:00', '10:00:00', 1,20),
('Pilates', '10:30:00', '11:30:00', 2,30),
('Spinning', '12:00:00', '13:00:00', 3,40);

INSERT INTO SALAS (nombre) 
VALUES 
('Sala 101'),
('Sala 102'),
('Sala 103');

INSERT INTO Asignacion_Clases_Salas (id_clases, id_salas, fecha) 
VALUES 
(1, 1, '2024-02-22'),
(2, 2, '2024-02-23'),
(3, 3, '2024-02-24');

INSERT INTO Maquinas (nombre, foto, descripcion, fecha_adquisicion, ultima_revision, id_sala)
VALUES 
('Máquina de Pesas', NULL, 'Máquina para entrenamiento de fuerza', '2023-01-15', '2024-01-15', 1),
('Cinta de Correr', NULL, 'Equipo para correr en sitio', '2023-02-20', '2024-02-20', 2),
('Bicicleta Estática', NULL, 'Bicicleta para entrenamiento cardiovascular', '2023-03-25', '2024-03-25', 3);