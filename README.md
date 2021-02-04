DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      modules/             contains modules classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=medialine',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

INSTALLATION
------------
Run migration command

~~~
yii migrate
~~~



**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.


# Routes

- domain.com/api/categories         | List of all cateogories
- domain.com/api/categories/create  | for creating new category
- domain.com/api/categories/update/id  | for updating category
- domain.com/api/categories/delete/id  | for deleting category

### domain.com/api/categories

Request type: GET   
Response type: JSON
