docker-compose up -d
docker exec -ti turbo_backend touch /usr/share/nginx/html/.env
docker exec -ti turbo_backend cd /usr/share/nginx/html
docker exec -ti turbo_backend composer install
docker exec -ti turbo_backend service php8.1-fpm start
