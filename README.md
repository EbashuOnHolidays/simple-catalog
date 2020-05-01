### Build, start, stop, repeat.

Hosts file:
```shell script
192.168.5.1   catalog.io
```

Build:
```shell script
docker-compose build
```

Start:
```shell script
docker-compose up -d
```

Stop:
```shell script
docker-compose stop
```

### Connect to containers

Nginx:
```shell script
docker exec -it simple_catalog_nginx bash
```

MySQL:
```shell script
docker exec -it simple_catalog_mysql bash
```

PHP:
```shell script
docker exec -it simple_catalog_php bash

composer install

php artisan migrate --seed

php artisan key:generate
```

Node.js:
```shell script
docker exec -it simple_catalog_node bash

npm install

npm run dev
```
