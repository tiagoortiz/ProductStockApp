# ProductStockApp

ProductStockApp é um CRUD de produtos feito com Laravel.

## Instalação

### 1. Clonar o repositório

Você pode clonar o repositório através do comando git clone:
```
git clone https://github.com/tiagoortiz/ProductStockApp.git
```

Caso preferir, pode realizar o download diretamente pelo Github.

### 2. Instalar as dependências via composer

Para que todas as dependências do projeto sejam instaladas, você precisa ter o composer instalado.
Caso não tenha o composer instalado, você pode fazer o download [aqui](https://getcomposer.org/).

Após o composer instalado, execute o código abaixo para instalar as dependências do projeto
```
composer install
```

Continuamos com a instalação do npm para que o Bootstrap.css seja corretamente configurado.
```
npm install
```

Por fim, finalizamos a instalação das dependências com o comando:
```
composer require laravel/ui
```

### 3. Criar uma cópia do arquivo .env

Precisamos gerar um arquivo .env para colocarmos as informações de configuração. Para isto, faça uma cópia 
do arquivo '.env.example' e renomeie para '.env'.

### 4. Gerar uma chave de encriptação

Por padrão, o Laravel exige uma chave de encriptação para seus projetos. Para isto, geramos a chave através do comando:
```
php artisan key:generate
```

### 5. Criar um banco de dados

Crie o banco de dados e coloque as informações relativas ao mesmo dentro do arquivo '.env'.

### 6. Realize a migração do banco de dados

Para iniciarmos o banco de dados com as tabelas necessárias, rode o comando:
```
php artisan migrate
```

### 7. Rode a aplicação

Após todas etapas concluidas, podemos rodar a aplicação:
```
php artisan serve
```

O Laravel utiliza a porta 8000, então você poderá acessar no seu localhost:8000, em caso de instalação em ambiente local.

## Especificações

PHP v7.4.6
Laravel Framework v7.26.1
MariaDB v10.4.11
Composer v1.10.10
npm v6.14.5
