# 🚀 Laravel 30 Days Exercises first 26 Days

## 📌 Projektist

See projekt on loodud Laracasti õppesarja "[30 Days to Learn Laravel 11](https://laracasts.com/series/30-days-to-learn-laravel-11)" harjutused 1.-26.päevani.

🔗 **Harjutuste kood:** [Laravel30days](https://github.com/sirlikont/Laravel30days)  
🔗 **Lõppprojekt:** [Laravel30DaysFinalProject](https://github.com/sirlikont/Laravel30DaysFinalProject)


## 🛠️ Tehniline stack

- **Backend:** Laravel 12 (v12.17.0)
- **Frontend:** Blade
- **Andmebaas:** SQLite
- **CSS raamistik:** Tailwind CSS


## 🚀 Paigaldus

```bash
# Klooni repositoorium
git clone https://github.com/sirlikont/Laravel30DaysFinalProject.git
cd Laravel30DaysFinalProject

# Paigalda sõltuvused
composer install
npm install && npm run build

# Seadista keskkond
cp .env.example .env

# Genereeri key
php artisan key:generate

# Käivita andmebaas (vajadusel muuda .env faili)
php artisan migrate --seed

# Käivita arendusserver
php artisan serve
```


## ✨ Autor

```php
// Autorikontakt
$author = [
    'name' => 'Sirli Kont',
    'email' => 'sirlikont@gmail.com',
    'github' => 'https://github.com/sirlikont'
];
```
