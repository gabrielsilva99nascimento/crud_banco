CREATE DATABASE financas;

USE financas;

-- Tabela para armazenar tipos de transação
CREATE TABLE tipo_transacao (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(50) NOT NULL
);

-- Tabela para armazenar as transações
CREATE TABLE transacao (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    data DATE NOT NULL,
    tipo_id INT,
    FOREIGN KEY (tipo_id) REFERENCES tipo_transacao(id)
);

-- Inserindo tipos de transação
INSERT INTO tipo_transacao (descricao) VALUES ('Aluguel'), ('Pagamento'), ('Prolabore');
