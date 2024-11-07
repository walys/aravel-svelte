<div style="display: inline_block"><br>

<img align="center" alt="laravel" height="30" width="40" 
src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original-wordmark.svg" />

<img align="center" alt="Php" height="30" width="40" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg" />

<img align="center" alt="svelte" height="30" width="40" 
  src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/svelte/svelte-original.svg" />

<img align="center" alt="Js" height="30" width="40" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-plain.svg">

<img align="center" alt="jquery" height="30" width="40" 
src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/jquery/jquery-original-wordmark.svg" />


  <img align="center" alt="HTML" height="30" width="40" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg">


  <img align="center" alt="CSS" height="30" width="40" src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg">


  <img align="center" alt="Bootstrap" height="30" width="40" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" />

<img align="center" alt="mysql" height="30" width="40" 
src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original-wordmark.svg" />

<img align="center" alt="docker" height="30" width="40" 
src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original-wordmark.svg" />



# Teste Pratico

## Passo a passo para rodar o projeto

### Clone Repositório
```sh
git clone https://github.com/walys/laravel-svelte.git
```

### Entre no diretorio laravel-svelte.
```sh
cd laravel-svelte/backend
```

### Execute os seguintes comandos docker dentro da pasta
```sh
docker-compose build
```
```sh
docker-compose up -d
```

### Apos os dois comandos executados, rode os comandos abaixo

Encontre o id_container com a imagem de nome laravel-svelte_laravel_svelte-docker
```sh
 docker ps -a
```

Execute e entre no container
```sh
docker exec -it id_container sh
```
### Em outro terminal dentro da pasta projeto rode o seguinte comando

Ao entrar execute esse comando para dar as devidas permissões
```sh
chown www-data:www-data -R ./storage
```

Crie o Arquivo .env dentro da pasta project
```sh
cp .env.example .env
```

### Atualize as seguintes variáveis de ambiente no arquivo .env
```dosini
APP_NAME=Laravel - Teste Pratico
APP_KEY=base64:a0N/Tf+B5YQqb+yI8e63OlP9sHLRUl2QAn4/I5T1Jfs=
APP_DEBUG=true
APP_URL=http://localhost:9000/

DB_CONNECTION=mysql
DB_HOST=admin_mysql_db
DB_PORT=3306
DB_DATABASE=test_pratice
DB_USERNAME=root
DB_PASSWORD=root
```
# Atenção!!!

### Para finalizar as configurações restantes acesse a documentação desntro de [projeto] e [frontend]

Acesse o projeto laravel apartir desse link
[http://localhost:9000/](http://localhost:9000/)

Acesse a aplicação web phpmyadmin atravez do link
[http://localhost:9001](http://localhost:9001)


Usuário
```sh
root
```

Senha
```sh
root
```