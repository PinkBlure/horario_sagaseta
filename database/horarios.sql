-- CREACIÓN DE TABLAS

CREATE TABLE Grupo (
    id_grupo INT PRIMARY KEY AUTO_INCREMENT,
    nombre_grupo_largo VARCHAR(100) NOT NULL,
    nombre_grupo_corto VARCHAR(50) NOT NULL
);

CREATE TABLE Profesor (
    id_profesor INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Aula (
    id_aula INT PRIMARY KEY AUTO_INCREMENT,
    nombre_aula VARCHAR(50) NOT NULL
);

CREATE TABLE Asignatura (
    id_asignatura INT PRIMARY KEY AUTO_INCREMENT,
    nombre_asignatura_largo VARCHAR(100) NOT NULL,
    nombre_asignatura_corto VARCHAR(50) NOT NULL,
    id_grupo INT,
    id_profesor INT NULL,
    id_aula INT NULL,
    FOREIGN KEY (id_grupo) REFERENCES Grupo(id_grupo),
    FOREIGN KEY (id_profesor) REFERENCES Profesor(id_profesor),
    FOREIGN KEY (id_aula) REFERENCES Aula(id_aula)
);

-- INSERCIÓN DE DATOS

-- Grupo

INSERT INTO `Grupo` (`id_grupo`, `nombre_grupo_largo`, `nombre_grupo_corto`) VALUES
(NULL, '2º CFGS Informática: Desarrollo de Aplicaciones Web', '2º CFGS INF DAW')

-- Profesor

INSERT INTO `Profesor` (`id_profesor`, `nombre`, `apellido`, `correo`) VALUES (NULL, 'Badel del Cristo', 'Hernández Hernández', 'bcherher@canariaseducacion.es')


-- Aula

INSERT INTO `Aula` (`id_aula`, `nombre_aula`) VALUES
(NULL, 'P2ª-12 IN4'),
(NULL, 'P2ª-14 IN3');
