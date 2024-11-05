# CRUD de Transações Financeiras

Um sistema de CRUD para gerenciar transações financeiras, permitindo a criação, visualização, atualização e exclusão de transações com integração de frontend em Angular e backend em PHP com banco de dados MySQL.

## Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Uso](#uso)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Endpoints da API](#endpoints-da-api)
- [Contato](#contato)

---

## Sobre o Projeto

Este projeto foi desenvolvido para gerenciar transações financeiras de forma simples. Ele permite adicionar, listar, atualizar e excluir transações, onde cada transação pode ser classificada como receita ou despesa. 

## Tecnologias Utilizadas

- **Backend:** PHP
- **Frontend:** Angular
- **Banco de Dados:** MySQL
- **ORM (Opcional):** PDO para manipulação de dados
- **Servidor Local:** Apache ou Nginx

## Pré-requisitos

- **PHP** 7.4 ou superior
- **MySQL** 5.7 ou superior
- **Node.js** e **npm** (para rodar o frontend em Angular)
- **Servidor Web** (como Apache ou Nginx)

## Instalação

### Passo 1: Configurar o Banco de Dados

1. Crie um banco de dados no MySQL, por exemplo, `transacoes_financeiras`.
2. Crie as tabelas necessárias (exemplo abaixo):

```sql
CREATE TABLE tipo_transacao (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(50) NOT NULL
);

CREATE TABLE transacao (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao VARCHAR(100) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    data DATE NOT NULL,
    tipo_id INT,
    FOREIGN KEY (tipo_id) REFERENCES tipo_transacao(id)
);
```
3. Popule a tabela tipo_transacao com dados iniciais:
```sql
INSERT INTO tipo_transacao (descricao) VALUES ('Receita'), ('Despesa');
```

### Passo 2: Configurar o Backend

1. Clone o repositório:

```
git clone https://github.com/seu_usuario/seu_repositorio.git

cd seu_repositorio
```
2. Configure o arquivo de conexão com o banco de dados no controlador (TransacaoController.php):
```
$this->pdo = new PDO("mysql:host=localhost;dbname=transacoes_financeiras", "usuario", "senha");
```

### Passo 3: Configurar o Frontend (Angular)

1. No diretório do frontend (frontend/), instale as dependências:

```
npm install OR npm i
```
2. Inicie o servidor de desenvolvimento Angular:
```
ng serve
```

### Passo 4: Configurar o Servidor Local (opcional)

1. Configure seu servidor web (Apache ou Nginx) para apontar o backend para a pasta pública `(index.php)`.

## Uso

### Operações de CRUD

1. Criar: Preencha o formulário de transações e clique em "Adicionar".
2. Listar: A lista de transações é carregada automaticamente.
3. Atualizar: Clique em uma transação para editar os campos e salve as alterações.
4. Excluir: Clique no botão "Excluir" em uma transação para removê-la.


### Estrutura do projeto

- index.php: Arquivo principal do backend
- controllers/TransacaoController.php: Controlador de transações com métodos para as operações CRUD
- frontend/: Diretório do frontend em Angular

### Endpoints da API

- GET /transacao: Listar todas as transações
- POST /transacao: Criar uma nova transação
- PUT /transacao/{id}: Atualizar uma transação
- DELETE /transacao/{id}: Excluir uma transação

# Contato

- Criado por **Gabriel Silva**
- https://www.linkedin.com/in/gabriel-silva-11236b292/