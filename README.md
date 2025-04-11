# PiGLy
## 環境構築
Dockerビルド  
```
git clone git@github.com:cahoco/coachtech-test3.git
```
DockerDesktopアプリを立ち上げる  
```
docker-compose up -d --build
```
mysql:  
    platform: linux/x86_64(この文追加)  
    image: mysql:8.0.26  
    environment:  
Laravel環境構築  
```
docker-compose exec php bash
```
```
composer install
```
「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成  
.envに以下の環境変数を追加  
```
DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass
```
アプリケーションキーの作成  
```
php artisan key:generate
```
マイグレーションの実行  
```
php artisan migrate
```
シーディングの実行  
```
php artisan db:seed
```

テストユーザーログイン情報
メールアドレス：test@example.com
パスワード：0000

## 使用技術(実行環境)
* PHP 7.4.9
* Laravel 8.83.8
* MySQL 15.1
## ER図
<img width="534" alt="er_diagram" src="https://github.com/user-attachments/assets/47e7322f-6d76-45ae-8672-e75df4e33ab8" />

## URL
* 開発環境：http://localhost/
* phpMyAdmin:：http://localhost:8080/
