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

Request type: POST   
Response type: JSON (List of categories returns recursive by parent)
```json
[
   {
      "id":"9",
      "title":"Спорт",
      "parent_id":null,
      "created_at":"2021-02-04 16:38:12",
      "updated_at":null
   },
   {
      "id":"4",
      "title":"День города",
      "parent_id":null,
      "created_at":"2021-02-04 16:35:53",
      "updated_at":null,
      "children":[
         {
            "id":"6",
            "title":"Детская площадка",
            "parent_id":"4",
            "created_at":"2021-02-04 16:37:34",
            "updated_at":null,
            "children":[
               {
                  "id":"7",
                  "title":" 0-3 года",
                  "parent_id":"6",
                  "created_at":"2021-02-04 16:38:00",
                  "updated_at":null
               }
            ]
         },
         {
            "id":"5",
            "title":"Cалюты",
            "parent_id":"4",
            "created_at":"2021-02-04 16:36:59",
            "updated_at":null
         }
      ]
   }
]
```

### domain.com/api/categories/create

Request type: POST   
```json
{
    "title": "Test",
    "parent_id": 2
}
```
Response type: JSON (Result, if all is ok will add id of new category)

if success:
```json
{
    "result": true,
    "id": 10
}
```

if any error:
```json
{
    "result": false
}
```

### domain.com/api/categories/update

Request type: POST
```json
{
    "id": 10,
    "title": "Tested",
    "parent_id": 2
}
```
Response type: JSON (Result, if all is ok will add id of new category)

if success:
```json
{
    "result": true,
    "id": 10
}
```

if any error:
```json
{
    "result": false
}
```

### domain.com/api/categories/delete

Request type: POST
```json
{
    "id": 10
}
```
Response type: JSON

if success:
```json
{
    "result": true
}
```

if any error:
```json
{
    "result": false
}
```