# FoodMakers - Cardápio Digital
Esta é uma app conceito, para aprender os básicos da ferramenta Laravel.

## Estruturação da app
Nesta app temos dois projetos, separados em pastas diferentes : `foodmakers-admin` e `foodmakers-cliente`, ambas utilizando a estrutura MVC.

### Estrutura de cada projeto
Cada projeto é um MVC, que constitui 3 principais partes: **Model, View e Controller**. 

Nas **Views** temos todo o `HTML`, toda a parte visual da aplicação, que é alimentada com informações pelas **Controllers**, 
as quais seguem os modelos de daodos definidos pelas **Models**

## Como rodar o projeto
Para rodar o projeto, você deve precisará ter o [Laravel](https://laravel.com/docs/11.x/installation), o [PHP](https://www.php.net/), o [Composer](https://getcomposer.org/), o [Node JS](https://nodejs.org/pt) e o [MySql](https://dev.mysql.com/downloads/installer/) instaldos.

### Database
Primeiramente, crie um banco de dados de nome `foodmakers` no sua instância local de MySql, para que a app possa acessar o database. 
Para fazer isso, abra o seu `MySql Shell` (ou CMD normal) e, com seu usuário MySql, logado execute:
```
CREATE DATABASE foodmakers;
```

### Variáveis de ambiente
É importante que você substitua as variáveis de ambiente nos seus arquivos `.env`(nas duas pastas de projeto) para se conectar com o database que acabou de criar:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=foodmakers
DB_USERNAME={SEU_USUARIO}
DB_PASSWORD={SUA_SENHA}
```
_OBS: Se não tiver um arquivo `.env`, pode criar um, copiando de `.env.example`, e depois substituir._

## Rodando a App Admin
A App admin é o primeiro projeto que deve ser iniciado, pois nele, você poderá criar os produtos que aparecerão na app Cliente no futuro.
Com um terminal aberto no diretório do projeto Admin, execute os seguintes comandos:

```
npm install
npm run build
```

Isto instalará as dependências necessárias para compilar o frontend da App.
Depois, crie as tabelas do banco de dados com as migrations existentes, executando o seguinte comando:
```
php artisan migrate
```

Certifique-se também de que a app contém uma _Application key_ gerada:
```
php artisan key:generate
```

Após as _Migrations_ tiverem sido executadas, você pode iniciar a app com o seguinte comando:
```
php artisan serve --port=8080
```

_OBS: Estamos mudando a porta padrão desta aplicação para que possamos rodar os dois projetos simultaneamente_

Agora com o projeto Admin rodando, você pode ir até a rota `/register` e criar um novo usuário, para que posssa fazer login na app posteriormente em `/`

## Rodando a App Cliente
Vamos repetir um processo parecido na app Cliente, executando os seguintes comando no diretório da mesma:
```
npm install
npm run build
php artisan migrate
php artisan key:generate
php artisan serve --port=8000
```

Com isso, você poderá fazer login com o mesmo usuário que criou anteriormente, ou criar um novo usuário para acessar esta App.
Nesta App, você poderá escolher produtos e montar carrinhos de compra, e fazer pedidos que ficarão registrados no database automaticamente.
