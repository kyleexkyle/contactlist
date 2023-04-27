## How to install
1. open your terminal
2. clone the project `git clone https://github.com/kyleexkyle/contactlist.git`
3. cd into the project `cd contactlist`
4. `composer install`
5. `cp .env.example .env`
6. `php artisan key:generate`
7. `php artisan migrate`(remember to modify you .env file first before migrating)
8. `php artisan db:seed`
9. `npm install`
10. `npm run dev` (compile for development) OR `npm run build` (compile for production)

## Login Credentials

email: fdc@test.com

password: 12345678
