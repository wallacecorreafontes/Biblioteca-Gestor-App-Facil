# Biblioteca Gestor App Fácil

## Sobre o Projeto

Este projeto é um sistema básico para gerenciar usuários, livros e empréstimos em uma biblioteca, desenvolvido em Laravel 10 com PHP e MySQL.

---

## Funcionalidades Principais

- CRUD completo de usuários da biblioteca (Nome, Email, Número de Cadastro).
- CRUD completo de livros com categorização por gênero.
- Controle do status dos livros: Disponível ou Emprestado.
- Controle de empréstimos com registro da data de empréstimo e data prevista para devolução.
- Marcar empréstimos como devolvidos.
- Identificação automática de empréstimos atrasados com base na data prevista de devolução.

---

#### Funcionamento do Status "Devolvido"

- O status "Devolvido" é definido quando o campo `returned_at` do empréstimo é preenchido, o que ocorre através de uma ação explícita do usuário (botão para marcar como devolvido).
- Essa ação atualiza o registro do empréstimo e também altera o status do livro para "available".

#### Funcionamento do Status "Atrasado"

- O status "Atrasado" é calculado automaticamente pelo sistema, sem intervenção manual.
- A lógica utilizada verifica se a data atual (`today()`) ultrapassou a data prevista de devolução (`due_date`) e se o livro ainda não foi devolvido (`returned_at` está nulo).
- Dessa forma, a marcação de atraso é dinâmica e sempre refletirá o estado real do empréstimo sem depender de atualizações manuais que podem gerar inconsistências.

#### Justificativa Técnica

- Optar por um status "Atrasado" automático melhora a confiabilidade dos dados, pois elimina a possibilidade de erro humano ao marcar um empréstimo como atrasado.
- Essa abordagem está alinhada com boas práticas de desenvolvimento e sistemas de controle de empréstimos reais.
- Caso necessário, o sistema pode ser facilmente estendido para permitir marcação manual via endpoint ou interface.

---
## Como Rodar o Projeto

### Requisitos

- PHP >= 8.x
- Composer
- MySQL
- Laravel 10

### Passos para execução local

1. Clone o repositório:
   ```bash
   git clone https://github.com/wallacecorreafontes/Biblioteca-Gestor-App-Facil.git

2. Instale as dependências:
   ```bash
   composer install

3. Configure seu .env com as credenciais do banco de dados.
   ```bash
   cp .env.example .env
4. Rode as migrations
   ```bash
   php artisan migrate
5. Inicie o servidor:
   ```bash
   php artisan serve
6. Acesse `http://localhost:8000`


