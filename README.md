# BD Bezerra — Consultoria em Tecnologia da Informação

Aplicação web local para uma empresa fictícia de consultoria em TI. Desenvolvida com HTML, CSS, JavaScript, PHP e MySQL, utilizando PDO e sessões PHP.

## Requisitos
- XAMPP (Apache e MySQL)
- Navegador atualizado
- PHP 8.0 ou superior recomendado

## Instalação
1. Copie a pasta `consultoria_bd_bezerra` para `C:\xampp\htdocs\`.
2. Abra o XAMPP e inicie **Apache** e **MySQL**.
3. Acesse `http://localhost/phpmyadmin`.
4. Importe o arquivo `database.sql` (aba **Importar**). Ele cria o banco `bd_bezerra`.
5. Confira as configurações em `config/database.php`. O padrão do XAMPP é usuário `root` e senha vazia.
6. Abra `http://localhost/consultoria_bd_bezerra/criar_admin.php`.
7. Crie a conta administrativa. **Depois de criar a conta, apague `criar_admin.php` da pasta do projeto.**
8. Acesse `http://localhost/consultoria_bd_bezerra/`.

## Conta administrativa
A conta é criada no primeiro acesso a `criar_admin.php`. O próprio usuário define e-mail e senha. Não existe senha administrativa fixa no código.

## Estrutura
```text
consultoria_bd_bezerra/
├── admin/
│   ├── index.php
│   ├── servicos.php
│   ├── servico_form.php
│   ├── servico_excluir.php
│   ├── clientes.php
│   ├── orcamentos.php
│   └── acessos.php
├── assets/
│   ├── css/style.css
│   └── js/script.js
├── config/database.php
├── includes/
│   ├── auth.php
│   ├── header.php
│   └── footer.php
├── cliente/
│   ├── index.php
│   ├── solicitar.php
│   └── meus_orcamentos.php
├── database.sql
├── index.php
├── cadastro.php
├── login.php
├── logout.php
└── criar_admin.php
```

## Funcionalidades
- Página inicial com apresentação da empresa, serviços e dois sócios.
- Cadastro, login e encerramento de sessão.
- Área do cliente para consultar serviços e enviar/acompanhar pedidos de orçamento.
- Área administrativa protegida por sessão e perfil.
- CRUD de serviços (criar, listar, editar e excluir).
- Consulta de clientes, pedidos e registros de acesso.
- Senhas armazenadas com `password_hash()` e verificadas com `password_verify()`.

## Modelo do banco de dados
- `usuarios`: clientes e administradores.
- `servicos`: catálogo de serviços.
- `orcamentos`: solicitações feitas pelos clientes.
- `acessos`: histórico de login com data e hora.

Relacionamentos:
- Um usuário pode possuir vários orçamentos.
- Um serviço pode aparecer em vários orçamentos.
- Um usuário pode possuir vários registros de acesso.

## Observações
- O projeto foi preparado para execução local com XAMPP.
- Para publicar na internet, configure HTTPS, credenciais próprias e variáveis de ambiente; não publique senhas.
- `criar_admin.php` deve ser removido após a criação do primeiro administrador.
- Os dois sócios e os serviços são fictícios e podem ser personalizados no arquivo `index.php` e no banco de dados.
