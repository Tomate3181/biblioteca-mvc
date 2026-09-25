-- Script para criar o banco de dados e a tabela de livros

CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE biblioteca;

CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    genero VARCHAR(100),
    ano_publicacao INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Exemplos de dados para teste
-- INSERT INTO livros (titulo, autor, genero, ano_publicacao, quantidade) VALUES 
-- ('O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 'Infantil', 1943, 3),
-- ('Dom Casmurro', 'Machado de Assis', 'Romance', 1899, 2),
-- ('1984', 'George Orwell', 'Ficção', 1949, 1);