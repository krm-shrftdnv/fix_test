# Fix test

[https://www.postman.com/krm-shrftdnv/workspace/fix-test/overview](API)

```shell
cp .env.template .env
cp .env.template ./go/.env

docker-compose install --build -d

docker exec -it php bash

composer install

exit
```