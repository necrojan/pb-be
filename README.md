## PB-BE

The environment used in this application locally is 
valet.

### Installation
```
git clone https://github.com/necrojan/pb-be
composer install
cp .env.example .env
Update db credentials
php artisan migrate:fresh --seed
```
