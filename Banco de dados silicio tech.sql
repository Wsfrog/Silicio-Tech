-- Banco de dados principal
DROP DATABASE IF EXISTS etech;
CREATE DATABASE etech;
USE etech;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    tipo ENUM('morador', 'funcionario', 'admin') NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (email, senha, nome, tipo) 
VALUES
('funcionario@condominio.com', '400289', 'Funcionário', 'funcionario'),
('morador@condominio.com', '654321', 'Morador', 'morador'),
('admin@condominio.com', '123456', 'Administrador', 'admin'); 

-- Tabela para os moradores
CREATE TABLE IF NOT EXISTS moradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    apartamento VARCHAR(10) NOT NULL UNIQUE,
    email VARCHAR(100),
    telefone VARCHAR(15)
);

INSERT INTO moradores (nome, apartamento, email, telefone) VALUES
('João da Silva', '101', 'joao@example.com', '11987654321'),
('Maria Oliveira', '102', 'maria@example.com', '11987654322');

-- Tabela para reservas de áreas de lazer
 create table reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    morador_id INT,
    area VARCHAR(50),
    data_reserva DATE,
    hora_inicio TIME,
    hora_fim TIME,
    status VARCHAR(20),
     FOREIGN KEY (morador_id) REFERENCES moradores(id)
);


-- Tabela para feedbacks
CREATE TABLE IF NOT EXISTS feedbacks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    morador_id INT,
    mensagem TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (morador_id) REFERENCES moradores(id)
);

-- Tabela para encomendas
CREATE TABLE encomendas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    morador_id INT,
    descricao VARCHAR(100),
    data_recebimento DATE,
    status VARCHAR(20)
);

drop table encomendas;
-- Tabela de produtos de mercadinho
CREATE TABLE IF NOT EXISTS ingresso (
    idIngresso INT PRIMARY KEY AUTO_INCREMENT,
    nomeEvento VARCHAR(100) NOT NULL,
    quantidadeDisponivel INT NOT NULL,
    preco DECIMAL(10,2) NOT NULL
);

INSERT INTO ingresso (nomeEvento, quantidadeDisponivel, preco) VALUES 
('Água mineral', 200, 2.50),
('Refrigerantes', 200, 5.00),
('Sucos', 200, 4.00),
('Biscoitos', 200, 3.00),
('Chocolates', 200, 6.50),
('Café', 200, 10.00),
('Chá', 200, 3.50),
('Snacks', 200, 4.00),
('Sabão em pó', 200, 12.00),
('Detergente', 200, 3.00),
('Desinfetante', 200, 4.50),
('Água sanitária', 200, 4.00),
('Esponjas', 200, 1.50),
('Panos de limpeza', 200, 2.00),
('Limpadores multiuso', 200, 8.00),
('Álcool 70%', 200, 5.50),
('Sabonetes', 200, 1.00),
('Shampoos', 200, 15.00),
('Condicionadores', 200, 15.00),
('Pasta de dente', 200, 2.50),
('Escovas de dente', 200, 1.50),
('Papel higiênico', 200, 7.00),
('Fraldas descartáveis', 200, 25.00),
('Absorventes', 200, 6.00),
('Curativos', 200, 4.00),
('Band-aids', 200, 3.00),
('Antissépticos', 200, 7.00),
('Analgésicos', 200, 10.00),
('Pomadas', 200, 8.00),
('Termômetros', 200, 15.00),
('Canetas', 200, 1.00),
('Lápis', 200, 0.50),
('Papel sulfite', 200, 12.00),
('Cadernos', 200, 7.00),
('Grampeadores', 200, 5.00),
('Grampos', 200, 1.00),
('Fitas adesivas', 200, 2.50),
('Chave de fenda', 200, 3.50),
('Martelo', 200, 10.00),
('Parafusos', 200, 0.10),
('Fita isolante', 200, 1.50),
('Extensão elétrica', 200, 15.00),
('Pilhas', 200, 5.00),
('Baterias', 200, 8.00),
('Ração para cães', 200, 50.00),
('Ração para gatos', 200, 45.00),
('Brinquedos para pets', 200, 20.00),
('Areia higiênica', 200, 10.00),
('Coleiras', 200, 12.00),
('Carregadores de celular', 200, 20.00),
('Adaptadores de tomada', 200, 5.00),
('Guarda-chuvas', 200, 15.00),
('Lanternas', 200, 10.00),
('Velas', 200, 2.00),
('Fósforos', 200, 10.00);

INSERT INTO encomendas (morador_id, descricao, data_recebimento, status)
VALUES (1, 'Caixa de livros', '2024-11-10', 'Disponível');

INSERT INTO encomendas (morador_id, descricao, data_recebimento, status)
VALUES (2, 'Pacote de roupas', '2024-11-11', 'Retirado');

INSERT INTO encomendas (morador_id, descricao, data_recebimento, status)
VALUES (2, 'Eletrodoméstico', '2024-11-12', 'Disponível');

INSERT INTO encomendas (morador_id, descricao, data_recebimento, status)
VALUES (1, 'Material de escritório', '2024-11-13', 'Retirado');

INSERT INTO encomendas (morador_id, descricao, data_recebimento, status)
VALUES (2, 'Equipamento eletrônico', '2024-11-10', 'Disponível');

-- Tabela de vendas de ingressos
CREATE TABLE IF NOT EXISTS vendasingressos (
    idVenda INT PRIMARY KEY AUTO_INCREMENT,
    IngressoId INT,
    quantidadeVendida INT,
    dataVenda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (IngressoId) REFERENCES ingresso(idIngresso)
);

-- Dados de exemplo podem ser ajustados conforme necessário


CREATE TABLE IF NOT EXISTS funcionarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    cargo VARCHAR(80) NOT NULL
);



select * from funcionarios;

CREATE TABLE IF NOT EXISTS tarefas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_funcionario INT,
    descricao VARCHAR(255) NOT NULL,
    data DATE,
    status ENUM('pendente', 'concluída') DEFAULT 'pendente',
    horario TIME,
    FOREIGN KEY (id_funcionario) REFERENCES funcionarios(id) ON DELETE SET NULL
);

INSERT INTO tarefas (descricao) VALUES 
('Limpar a área da recepção'),
('Verificar correspondências na portaria'),
('Realizar ronda no estacionamento'),
('Acompanhar manutenção do elevador'),
('Registrar visitantes no sistema');

select * from tarefas;

INSERT INTO funcionarios (nome, email, senha, cargo) 
VALUES ('João Silva', 'joao@exemplo.com', 'senha_segura', 'Portaria');
INSERT INTO funcionarios (nome, email, senha, cargo) 
VALUES ('Adriano', 'adriano@exemplo.com', 'adriano123', 'Portaria');

SELECT * FROM funcionarios;

INSERT INTO tarefas (id_funcionario, descricao, data, status) 
VALUES 
(1, 'Limpar a área da recepção', CURDATE(), 'pendente'),
(1, 'Verificar correspondências na portaria', CURDATE(), 'pendente'),
(1, 'Realizar ronda no estacionamento', CURDATE(), 'pendente'),
(1, 'Acompanhar manutenção do elevador', CURDATE(), 'pendente'),
(1, 'Registrar visitantes no sistema', CURDATE(), 'pendente'),
(2, 'Limpar a área da recepção', CURDATE(), 'pendente'),
(2, 'Verificar correspondências na portaria', CURDATE(), 'pendente'),
(2, 'Realizar ronda no estacionamento', CURDATE(), 'pendente'),
(2, 'Acompanhar manutenção do elevador', CURDATE(), 'pendente'),
(2, 'Registrar visitantes no sistema', CURDATE(), 'pendente');


CREATE TABLE registros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    veiculo VARCHAR(100) NOT NULL,
    placa VARCHAR(20) NOT NULL,
    cpf VARCHAR(20) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    destino VARCHAR(100),
    apartamento VARCHAR(20)
);

CREATE TABLE visitantes (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- ID único para cada visitante
    nome VARCHAR(255) NOT NULL,                 -- Nome do visitante
    documento VARCHAR(20) NOT NULL,             -- CPF ou outro documento de identificação
    veiculo VARCHAR(255),                       -- Veículo (opcional)
    placa VARCHAR(20),                          -- Placa do veículo
    telefone VARCHAR(20),                       -- Telefone de contato
    data_entrada DATETIME NOT NULL,             -- Data e hora de entrada
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Data e hora de criação do registro
);

CREATE TABLE mensagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio DATETIME NOT NULL
);

INSERT INTO mensagens (nome, mensagem, data_envio)
VALUES 
('Maria Oliveira', 'Gostaria de saber se haverá reunião de condomínio este mês.', '2024-11-24 09:30:00'),
('Carlos Mendes', 'O portão da garagem está com problemas para abrir.', '2024-11-24 10:15:00'),
('Ana Souza', 'Solicito uma limpeza extra na área de lazer.', '2024-11-24 11:00:00'),
('Pedro Santos', 'Podem confirmar se minha encomenda já chegou?', '2024-11-24 12:45:00'),
('Juliana Lima', 'Há lâmpadas queimadas no corredor do 3º andar.', '2024-11-24 13:20:00');

ALTER TABLE reservas ADD COLUMN data DATE NOT NULL;
ALTER TABLE reservas 

ADD COLUMN horario_inicio TIME,
ADD COLUMN horario_fim TIME;

ALTER TABLE mensagens ADD COLUMN resposta TEXT; -- Adicionado dia 24/11
ALTER TABLE moradores ADD COLUMN senha VARCHAR(255) NOT NULL; -- Adicionado dia 24/11

select * from mensagens;
select * from reservas;
select * from moradores;