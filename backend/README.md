<p align="center"><a href="#" target="_blank"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPkWVOp7SSTpIMYJxeIKvG2PGQaOp8FxHufya_oucqJO1bkhqUAfu8wx_qpbYd_Mqr0lM&usqp=CAU" width="400" alt="Laravel Logo"></a></p>

# Passo a passo para rodar as configurações necessarias do ambeinte backend, nesse momento você já deve está dentro de seu container com o laravel rodando sem problemas

### Gere as migrate
```sh
php artisan migrate
```
### Rode as seedrs exatamente nessa ordem para não gerar conflitos!

```sh
php artisan db:seed --class=UserSeeder
```
```sh
php artisan db:seed --class=SituationSeeder
```
```sh
php artisan db:seed --class=TaskSeeder
```
### OK! Finalizamos as configurações finais, basta entrar na [frontend](https://github.com/walys/laravel-svelte/tree/master/frontend) onde ira encontrar configurações finais para executar o projeto frontend

