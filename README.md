## Dự án V-Chat ứng dụng chat nội bộ

![./cover.jpeg](/cover.jpeg)

## Hướng dẫn set up dự án

-   Clone or download this repo and place it into your server.
-   `composer install `
-   Chạy file docker để chạy dịch vụ mysql
-   `cp .env.example .env `
-   Create database and modify .env with your DB name and Pusher credentials.
-   `php artisan migrate --seed`
<!--  Lệnh này tạo ra key bảo mật : APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
-   `php artisan key:generate` 
-   `npm install && npm run dev`
-   `php artisan serve`
