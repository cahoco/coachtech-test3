# PiGLy
## 環境構築
1. Dockerビルド  
```
git clone git@github.com:cahoco/coachtech-test3.git
cd coachtech-test3
code .
```
2. DockerDesktopアプリを立ち上げる  
```
docker-compose up -d --build
``` 
3. Laravel環境構築  
```
docker-compose exec php bash
```
```
composer install
```
「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成  
```
cp .env.example .env
```
.envに以下の環境変数を追加  
```
DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass
```
4. アプリケーションキーの作成  
```
php artisan key:generate
```
5. マイグレーションの実行  
```
php artisan migrate
```
6. シーディングの実行  
```
php artisan db:seed
```
7. サーバー起動
```
php artisan serve
```
8. http://localhost/login  
をブラウザで開く

##### テストユーザーログイン情報
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
