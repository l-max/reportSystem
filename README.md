Система учёта рабочего времени
==================================

Система реализована на Yii2 RESTfull API в связке с AngularJs.

СТРУКТУРА КАТАЛОГОВ
-------------------

      client/             содержит клиентскую часть приложения (AngularJs)
      server/             содержит серверную часть приложения (Yii2 RESTful API)


ТРЕБОВАНИЯ
------------

Минимальные требования: PHP 5.4.0, MySQL

УСТАНОВКА
----------

### Установка с помощью Composer
~~~
git clone https://github.com/lapmax/reportSystem.git
composer self-update
composer global require "fxp/composer-asset-plugin:~1.1.1"
cd reportSystem/server
composer install
~~~

НАСТРОЙКА
-------------

### БАЗЫ ДАННЫХ

Для настройки необходимо изменить файл `server/config/db.php` подставив свои данные, для примера:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=reportSystem',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

**ПРИМЕЧАНИЕ:**
- Передварительно нужно убедиться что база данных с таким именем существует иначе создать новую.

### НАСТРОЙКА КЛИЕНТСКОЙ ЧАСТИ

Для настройки отредактируйте файл `client/app.js` изменив адрес http://localhost/server/web/ на адрес до вашего API сервера, к примеру:

```
'use strict';
// Ссылка на серверную часть приложения
var serviceBase = 'http://localhost/server/web/';
...
```
МИГРАЦИИ
------------
Для создания таблиц в базе данных необходимо выполнить миграции Yii в командной строке:
```
path/to/server/>php yii migrate
```
ЗАПУСК ПРИЛОЖЕНИЯ
-----------------
Запуск приложения осуществляется открытием в браузере файла `/client/index.html`. В случае когда домменое имя `localhost` доступ к приложению будет: `http://localhost/client/`.

РАБОТА С API СЕРВЕРОМ
---------------------
Предположим что путь до сервера будет `http://localhost/server/web/`. 

Тогда для работы с API сервером реализованы следующие запросы:
```
GET http://localhost/server/web/reports - получить все отчеты;
HEAD http://localhost/server/web/reports - получить заголовок ответа на запрос GET http://localhost/server/web/reports;
POST http://localhost/server/web/reports - создать новый отчет;
GET http://localhost/server/web/reports/123 - получить данные отчета с id=123;
HEAD http://localhost/server/web/reports/123 - получить заголовок ответа GET http://localhost/server/web/reports/123;
PATCH http://localhost/server/web/reports/123 и PUT http://localhost/server/web/reports/123 - изменить данные отчета с id=123;
DELETE http://localhost/server/web/reports/123 - удалить отчет с id=123;
OPTIONS http://localhost/server/web/reports - получить список доступных методов запроса для http://localhost/server/web/reports;
OPTIONS http://localhost/server/web/reports/123 - получить список доступных методов запроса для http://localhost/server/web/reports/123.
```
Так же реализованы запросы для работы с ресурсом projects.
