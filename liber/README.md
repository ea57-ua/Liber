# Liber

## Comandos

### Preparción del proyecto
```
composer install
cp .env.example .env
```
Actualizar dependencias:
```
composer update
```
Preparar la base de datos:
```
php artisan key:generate
php artisan migrate:install
```
### Migraciones

| Descripción	                           | 	Comando                                                                  |
|----------------------------------------|---------------------------------------------------------------------------|
| 	  Inicializar la base de datos        | `php artisan migrate:install`                                             |
| 	      Crear una migración             | `php artisan make:migration create_products_table --create=products`      |
| 	     Migración que modifica una tabla | `php artisan make:migration add_price_to_products_table --table=products`	 |
| 	    Lanzar últimas migraciones        | `php artisan migrate`	                                                    |
| 	  Deshacer la última migración        | 	 `php artisan migrate:rollback`                                          |
| 	  Deshacer todas las migraciones      | `php artisan migrate:reset`	                                              |
| 	  Ver estado de las migraciones       | `php artisan migrate:status`	                                              |
### Dependencias y paquetes 

### Notas para el desarrollador
| | |
|---|--|
| **Base de datos**|liber|
|**Usuario**|admin|
|**Contraseña**|admin|
| **Motor**|MySQL|

