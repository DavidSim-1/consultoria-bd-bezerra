CREATE DATABASE IF NOT EXISTS bd_bezerra
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bd_bezerra;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('cliente', 'admin') NOT NULL DEFAULT 'cliente',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    descricao TEXT NOT NULL,
    preco_base DECIMAL(10,2) DEFAULT NULL,
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orcamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    servico_id INT NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('Pendente', 'Em análise', 'Aprovado', 'Recusado') NOT NULL DEFAULT 'Pendente',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (servico_id) REFERENCES servicos(id)
);

CREATE TABLE IF NOT EXISTS acessos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

INSERT INTO servicos (nome, descricao, preco_base) VALUES
('Desenvolvimento de sites', 'Criação de sites institucionais e páginas para empresas.', 800.00),
('Suporte técnico', 'Ajuda na identificação e resolução de problemas em computadores e sistemas.', 120.00),
('Consultoria em redes', 'Análise e orientação para instalação e melhoria de redes.', 350.00),
('Segurança da informação', 'Orientações para melhorar a proteção de dados e sistemas.', 500.00);
