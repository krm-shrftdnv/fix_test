# Fix test

[API](https://www.postman.com/krm-shrftdnv/workspace/fix-test/overview)

```shell
cp .env.template .env
cp .env.template ./go/.env

docker-compose install --build -d

docker exec -it php bash

composer install

exit

docker exec -it database bash
psql -U postgres
create database fix_test
exit
exit
```

Создание таблиц в бд описано в db.sql

Запуск музыки происходит по запросу **/party/start**, все записи из таблицы song перемешиваются и кладутся в
amqp-очередь, откуда считываются go-сервисом для переключения песен. 

Узнать текущие действия посетителей можно по запросу **/party**.