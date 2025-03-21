# Todo-List

Este é um mini projeto **Todo-List** desenvolvido com **PHP**, **HTML**, **CSS**, **JavaScript** e **MySQL**. O objetivo desse projeto é fornecer uma lista de tarefas simples, onde o usuário pode adicionar, editar, excluir e listar suas tarefas.

## Tecnologias Utilizadas

- **PHP**: Linguagem de programação para o back-end.
- **HTML**: Estruturação da página.
- **CSS**: Estilização da interface.
- **JavaScript**: Interatividade e dinamicidade no front-end.
- **MySQL**: Banco de dados para armazenar as tarefas.

## Como Testar o Projeto

### Passo a Passo para Rodar o Projeto Localmente

### 1. Baixe o arquivo do projeto
Faça o download do arquivo ZIP contendo o projeto e extraia o conteúdo em uma pasta no seu computador.

### 2. Instale o XAMPP
Baixe e instale o [XAMPP](https://www.apachefriends.org/pt_br/index.html) em seu computador. O XAMPP inclui o Apache (servidor web) e o MySQL (banco de dados), que são necessários para rodar o projeto localmente.

### 3. Crie o banco de dados
- Abra o **phpMyAdmin** (acessível pelo painel de controle do XAMPP).
- Crie um banco de dados chamado `todo_list`.

### 4. Crie a tabela no banco de dados
Após criar o banco de dados, execute o seguinte script SQL no **phpMyAdmin** para criar a tabela `tasks`:

```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```
### 5.  Extraia o arquivo do projeto 
Extraia o arquivo ZIP do projeto.
Copie a pasta extraída e cole em C:\xampp\htdocs (ou no diretório htdocs de sua instalação XAMPP).

### 6. Inicie o XAMPP
Abra o painel de controle do XAMPP.
Inicie o Apache (servidor web) e o MySQL (banco de dados).

### 7. Testar o projeto no navegador
Abra o navegador e acesse o seguinte endereço: http://localhost/todo-list
