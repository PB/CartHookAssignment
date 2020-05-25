## How to install
`docker-compose up -d`

Run composer and migrations

`docker-compose exec app composer install`

`docker-compose exec app php artisan migrate`

The application should be up and running. 

Visit: `http://127.0.0.1`

## Simple call install
- for users
```
curl --location --request GET 'http://127.0.0.1/api/users' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json'

curl --location --request GET 'http://127.0.0.1/api/users/1' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json'
```
- for user posts
```
curl --location --request GET 'http://127.0.0.1/api/users/1/posts' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json'
```
- for post comments
```
curl --location --request GET 'http://127.0.0.1/api/posts/1/comments' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json'
```

## Cache result
- run commands
```
docker-compose exec app php artisan cache:users
docker-compose exec app php artisan cache:posts
docker-compose exec app php artisan cache:comments
```