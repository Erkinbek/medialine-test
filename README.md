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

## Categories

- domain.com/api/categories         | List of all cateogories
- domain.com/api/categories/create  | for creating new category
- domain.com/api/categories/update  | for updating category
- domain.com/api/categories/delete  | for deleting category

## Articles

- domain.com/api/articles           | List of all articles
- domain.com/api/articles/create    | for creating new article
- domain.com/api/articles/update    | for updating article
- domain.com/api/articles/delete    | for deleting article

### domain.com/api/categories

Request method: POST | GET   
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

Request method: POST   
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

Request method: POST
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
  "result": false,
  "message": "Category not found"
}
```

### domain.com/api/categories/delete

Request method: POST
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
  "result": false,
  "message": "Category not found"
}
```

### domain.com/api/articles

Request method: POST | GET   
Response type: JSON
```json
[
  {
    "id": "1",
    "title": "Test",
    "body": "Tested test Tested test Tested test Tested test Tested test Tested test Tested test Tested test Tested test ",
    "created_at": "2021-02-04 18:43:13",
    "updated_at": null,
    "article_id": null,
    "categories": null
  },
  {
    "id": "18",
    "title": "Test #2",
    "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
    "created_at": "2021-02-05 10:16:47",
    "updated_at": null,
    "article_id": "18",
    "categories": "Общество,Городская жизнь, 0-3 года"
  }
]
```
### domain.com/api/articles/category

Request method: POST   

```json
{
    "id": 1
}
```

Response type: JSON (List of all articles belongs to category)   
You must set category id to **id** field

```json
[
    {
        "id": "18",
        "title": "Test #2",
        "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        "created_at": "2021-02-05 10:16:47",
        "updated_at": null,
        "article_id": "18",
        "categories": "Общество,3-7 года,Выборы,Test"
    }
]
```


### domain.com/api/articles/create

Request method: POST
```json
{
  "title": "Test #3",
  "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
  "category": "5,8,9,7"
}
```
Response type: JSON (Result, if all is ok will add id of new article)

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

### domain.com/api/articles/update

Request method: POST
```json
{
  "id": 18,
  "title": "Test #2",
  "body": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
  "category": "1,2,7"
}
```
Response type: JSON (Result, if all is ok will add id of new category)

if success:
```json
{
    "result": true
}
```

if any error:
```json
{
  "result": false,
  "message": "Article not found"
}
```

### domain.com/api/articles/delete

Request method: POST
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
  "result": false,
  "message": "Article not found"
}
```