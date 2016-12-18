Система учёта рабочего времени
==================================

Система реализована на Yii2 RESTfull API в связке с AngularJs.

DIRECTORY STRUCTURE
-------------------

      client/             содержит клиентскую часть приложения (AngularJs)
      server/             содержит серверную часть приложения (Yii2 RESTful API)


REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0 and MySQL or 10.1.19-MariaDB.


INSTALLATION
------------

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/server/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=reportSystem',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.

### Client config

Edit the file `client/app.js` with real data, for example:

```
'use strict';
// Ссылка на серверную часть приложения
var serviceBase = 'http://localhost/server/web/';
...
```
Миграции
------------
Для создания таблиц в бд необходимо выполнить миграции в Yii:
```
path/to/server/>php yii migrate
```
