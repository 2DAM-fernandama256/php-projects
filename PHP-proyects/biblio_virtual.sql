CREATE DATABASE biblioteca_virtual;
USE biblioteca_virtual;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id_usuario INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin int default 0
);

-- Tabla de categorias
CREATE TABLE categorias (
    id_categoria INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL
);

-- Tabla de libros
CREATE TABLE libros (
    id_libro INT(11) AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    id_categoria INT(11),
    disponible int DEFAULT 1,
    imagen VARCHAR(255), 
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

-- Tabla de reservas
CREATE TABLE reservas (
    id_reserva INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT(11),
    id_libro INT(11),
    fecha_reserva DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_libro) REFERENCES libros(id_libro)
);

-- INSERTS
INSERT INTO categorias (nombre) VALUES
('Novela'),
('Infantil'),
('Ciencia Ficción'),
('Clásicos'),
('Romance');

--Las contraseñas son 1234, pero ya os la doy encriptadas.
INSERT INTO usuarios (nombre_usuario, email, password, is_admin) VALUES
('user_1', 'user1@example.com', '$2y$04$mSW8a1/FOG3XrP7ATgJk3ONpfiZaeF0alZUBth4q4cS/XWC4vEe2m',0),
('user_2', 'user2@example.com', '$2y$04$oV4EifbRH11T8xvrb.9rgumeko0j0CwxI.0aB2lZBMtOizyvjwNkq',0),
('user_3', 'user3@example.com', '$2y$04$9kMjaKpwWaeEr1fQZUzZIOFNkGG4ksaDMH1BVEj2msMrhiIJqx8cK',0),
('admin', 'admin@example.com', '$2y$04$9kMjaKpwWaeEr1fQZUzZIOFNkGG4ksaDMH1BVEj2msMrhiIJqx8cK',1);

INSERT INTO libros (titulo, autor, id_categoria, disponible, imagen) VALUES
('Cien años de soledad', 'Gabriel García Márquez', 1, 0,'cienañossoledad.jpg'),
('El principito', 'Antoine de Saint-Exupéry', 2, 1,'elprincipito.jpg'),
('La chica de nieve', 'Javier Castillo', 3, 0,'lachicadenieve.jpg'),
('Don Quijote de la Mancha', 'Miguel de Cervantes', 4, 1,'donquijote.jpg'),
('Orgullo y prejuicio', 'Jane Austen', 5, 1,'orgulloyprejuicio.jpg');

INSERT INTO libros (titulo, autor, id_categoria, disponible, imagen) VALUES
('La sombra del viento','Carlos Ruiz Zafón',3,0,'lasombradelviento.jpg');

INSERT INTO reservas (id_usuario, id_libro) VALUES
(1, 1), 
(2, 3); 

