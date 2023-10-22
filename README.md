## How To Use

1. Clone the repositories.
2. Install composer.
   
```bash
composer install
```

3. Generate laravel key.
   
```bash
php artisan key:generate
```

4. Open in code editor.
5. Setting database name in .env.
6. Use seeder

```bash
php artisan db:seed --class=BukuSeeder
```
   
7. Run artisan serve in port 8000 for turn on the api.
   
```bash
php artisan serve
```

8. Run artisan serve in port 8001 in different terminal for turn on the interface web.
   
```bash
php artisan serve --port=8001
```

9. Open the localhost with browser using port 8001.
10. Done!
