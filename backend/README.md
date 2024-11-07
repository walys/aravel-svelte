<p align="center"><a href="#" target="_blank"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQPkWVOp7SSTpIMYJxeIKvG2PGQaOp8FxHufya_oucqJO1bkhqUAfu8wx_qpbYd_Mqr0lM&usqp=CAU" width="400" alt="Laravel Logo"></a></p>

# Passo a passo rodar as configurações necessarias do ambeinte backend

### Rode as migrate
```sh
php artisan migrate
```
### Rode as seedrs na ordem

```sh
php artisan db:seed --class=UserSeeder
```
```sh
php artisan db:seed --class=SituationSeeder
```
```sh
php artisan db:seed --class=TaskSeeder
```
