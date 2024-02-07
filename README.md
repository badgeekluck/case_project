## About Project

This is blog api project. It has Sanctum and basic CRUD OPERATIONS.

- first clone repository.
- do this in root directory => mv .env.example .env
- dont forget to check db parameters
- DB_CONNECTION=pgsql
- DB_HOST=pgsql
- DB_PORT=5432
- DB_DATABASE={your db name}
- DB_USERNAME={dont put root here}
- DB_PASSWORD={put random password} 
- cd case_project/ && composer install
- ./vendor/bin/sail up -d
- ./vendor/bin/sail composer install
- ./vendor/bin/sail artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
- ./vendor/bin/sail artisan migrate:fresh --seed

- You can use collections i shared in this project. 
Dont forget to add collections to postman.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
