# Cadastro de Clientes (PHP + SQLite)


Requisitos:
- PHP 7.2+ com extensão sqlite3 ativada
- servidor web (ex: built-in do PHP) ou Apache/Nginx configurado


Como executar localmente (usando PHP built-in):
1. coloque todos os arquivos em uma pasta, por exemplo `cadastro-clientes/`.
2. no terminal, entre na pasta: `cd cadastro-clientes`
3. inicie o servidor: `php -S localhost:8000`
4. abra no navegador: `http://localhost:8000/index.html`


executar testes:
- rode: `php tests/test_db.php`


Observações:
- banco usado: SQLite (arquivo `data/clientes.sqlite`).
- testes unitários simples sem dependências externas (apenas PHP puro).