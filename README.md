
# Documentação do Projeto Cadastro de Fornecedores

## Como Rodar o Projeto

1. **Instalar Dependências**: Execute `./vendor/bin/sail composer install`.
2. **Configurar o Banco de Dados**: Atualize o arquivo `.env` com as credenciais do banco de dados.
3. **Rodar Migrações**: Execute `./vendor/bin/sail artisan migrate` para criar as tabelas necessárias.
4. **Iniciar o Servidor**: Use `./vendor/bin/sail artisan serve` para iniciar o servidor de desenvolvimento.

## Testes

- **Seeders**: Utilize `./vendor/bin/sail artisan db:seed` para popular o banco de dados com dados de teste.
- **Testes de Rotas**: As rotas podem ser testadas utilizando ferramentas como Postman.


## Visão Geral

Este projeto é uma API para gerenciar fornecedores, permitindo operações CRUD e consultas por CNPJ. A API é construída utilizando o framework Laravel e faz uso de serviços externos para obter informações de CNPJ.


## Funcionalidades

### 1. Listar Fornecedores

- **Rota**: `GET /api/suppliers`
- **Descrição**: Retorna uma lista de fornecedores com base em filtros opcionais (`name_company`, `ativo`).

### 2. Buscar Fornecedor por CNPJ

- **Rota**: `GET /api/suppliers/search-cnpj`
- **Descrição**: Busca informações de um fornecedor utilizando o CNPJ.
- **Parâmetro**: `cnpj` (string, obrigatório, tamanho 14)

### 3. Criar Fornecedor

- **Rota**: `POST /api/suppliers`
- **Descrição**: Cria um novo fornecedor.
- **Dados**: 
  - `name` (opcional)
  - `name_company` (opcional)
  - `email` (obrigatório, único)
  - `cnpj` (obrigatório, único, tamanho 14)
  - `street`, `number`, `city`, `state`, `zip_code`, `contact` (obrigatórios)
  - `complement`, `neighborhood`, `ativo` (opcionais)

### 4. Mostrar Fornecedor

- **Rota**: `GET /api/suppliers/{id}`
- **Descrição**: Retorna os detalhes de um fornecedor específico pelo ID.

### 5. Atualizar Fornecedor

- **Rota**: `PUT /api/suppliers/{id}`
- **Descrição**: Atualiza as informações de um fornecedor existente.
- **Dados**: Mesmos campos que a criação, com validação de unicidade para `email` e `cnpj`.

### 6. Deletar Fornecedor

- **Rota**: `DELETE /api/suppliers/{id}`
- **Descrição**: Remove um fornecedor do sistema.

## Serviços Externos

- **BrasilApiService**: Serviço utilizado para buscar informações de CNPJ através da API Brasil.

## Requisitos

- **PHP**: Versão compatível com Laravel.
- **Laravel**: Framework PHP utilizado para o desenvolvimento da API.
- **Banco de Dados**: Configurado para armazenar informações dos fornecedores.
>>>>>>> 4d00663 (projeto cadastro de fornecedores para teste da Revenda mais.)


