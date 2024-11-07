<p align="center"><a href="#" target="_blank"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPkWVOp7SSTpIMYJxeIKvG2PGQaOp8FxHufya_oucqJO1bkhqUAfu8wx_qpbYd_Mqr0lM&usqp=CAU" width="400" alt="Laravel Logo"></a></p>

# Teste Pratico

## Passo a passo para rodar o projeto

### Clone Repositório
```sh
git clone https://github.com/walys/laravel-svelte.git
```

### Entre no diretorio laravel-svelte/backend para a execução do ambiente docker para gera os containeres necessarioas para montar e configurar o ambiente backend.
```sh
cd laravel-svelte/backend
```

### Crie o Arquivo .env dentro da pasta project

```sh
cp .env.example .env
```

### Atualize as seguintes variáveis de ambiente no arquivo .env
```dosini
APP_NAME=Laravel - Teste Pratico
APP_KEY=base64:a0N/Tf+B5YQqb+yI8e63OlP9sHLRUl2QAn4/I5T1Jfs=
APP_DEBUG=true
APP_URL=http://localhost:8000/api/V1/

DB_CONNECTION=mysql
DB_HOST=admin_mysql_db
DB_PORT=3306
DB_DATABASE=test_pratice
DB_USERNAME=root
DB_PASSWORD=root
```

### Dentro laravel-svelte/backend execute os seguintes comandos docker dentro da pasta
```sh
docker-compose build
```
```sh
docker-compose up -d
```

### Apos os dois comandos executados, rode os comandos abaixo

### Encontre o id_container com a imagem de nome laravel-svelte_laravel_svelte-docker
```sh
 docker ps -a
```

### Execute e entre no container
```sh
docker exec -it id_container sh
```
### Em outro terminal dentro da pasta projeto rode o seguinte comando

### Ao entrar execute esse comando para dar as devidas permissões

```sh
chown www-data:www-data -R ./storage
```


# Atenção!!!

### Para finalizar as configurações restantes acesse a documentação desntro de [backend](https://github.com/walys/laravel-svelte/tree/master/backend) e [frontend](https://github.com/walys/laravel-svelte/tree/master/frontend) , exatamente nessa ordem.

## Acesse o projeto laravel apartir desse link
[http://localhost:8000/api/V1/](http://localhost:8000/api/V1/)

## Acesse a aplicação web phpmyadmin atravez do link
[http://localhost:8080/](http://localhost:8080/)

### Apos tudo configurado basta acessar a tela de login e logar com as seguintes credenciais:

## Acessando essa rota url você sera direcionado para a tela de login
```sh
http://localhost:5173/
```

## E-mail:
```sh
user@email.com
```

## Senha:
```sh
123456
```