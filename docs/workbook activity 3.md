# PHP + Database
- PHP
- Docker
- Postgresql
- MongoDB

## 1. Modifying Documentation: Update Readme
- [ ] Check all the TODO Tasks
- [ ] Delete `TODO` mark when done modifying

## 2. Modifying Composer: Update `composer.json`
Change the following:
- [ ] your-username-here
- [ ] project-name-here
- [ ] add author/s
```json
"authors": [
    {
        "name": "your-username-here",
        "email": "your-email-here@gmail.com"
    },
    {
        "name": "your-username-here",
        "email": "your-email-here@gmail.com"
    }
],
```
(DONE)
## 3. Modifying Docker: Update `compose.yml`
Change the following:
- [ ] Change all `web-app-php`.
> Using `ctrl` + `shift` + `D`, each press in `D` will select another similar text and its not case sensetive.
- [ ] Update Database names: `MONGO_INITDB_DATABASE` & `POSTGRES_DB`
- [ ] (Optional) Can Change External ports <External Port>:<Internal Port> ex.: "27017:27017" -> "23567:27017"

(Done)
## 4. Update the Checker
- [ ] `mongodbChecker.handler.php`
    - [ ] change the `27017` with your updated port with internal/external port
    > $mongo = `new MongoDB\Driver\Manager("mongodb://host.docker.internal:27017");` -> `$mongo = new MongoDB\Driver\Manager("mongodb://host.docker.internal:23567");`
- [ ] `postgreChecker.handler.php`
    - [ ] change the `5112` with your updated port with internal/external port
    > `$port = "5112";` -> `$port = "5555";`
- [ ] Spin up the project: in terminal use the command: `docker compose up` and in new cmd is `docker compose watch`
- [ ] Add the checker in any pages and wait for either of the 2:
    All working: 
    ```html
    ✅ Connected to MongoDB successfully.
    ✅ PostgreSQL Connection
    ```

    Need Debugging:
    ```html
    ❌ MongoDB connection failed: ...
    ❌ Connection Failed: ...
    ```

(done)
## 5. Installing Dependencies
In this demo we will install a environment setter dependency.
- `vlucas/phpdotenv`

format: `composer require <name of the dependencies>`

sample:
```ps
composer require vlucas/phpdotenv
```
(done)
## 6. Modifying `.env`: Update `.env`
Make sure important informations are hidden and tucked . as in testing of for the checker they should be changed from hard codded to env based

- [ ] Fill all the following data
> Restart the docker after this. both `docker compose watch` and `docker compose up`
- [ ] Change the hard coded of checkers to env based
- [ ] Create a `envSetter.util.php` code distributing all the env
> add the following code before distributing it to a variable
```php
<?php

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

// Distribute the data using array key
$typeConfig = [
    'key' => $_ENV['ENV_NAME'],
];
```
- [ ] Update `mongodbChecker.handler.php` and `postgreChecker.handler.php`
    All working:
    ```html
    ✅ Connected to MongoDB successfully.
    ✅ PostgreSQL Connection
    ```

    Need Debugging:
    ```html
    ❌ MongoDB connection failed: ...
    ❌ Connection Failed: ...
    ```

(Done)
## 7. Using Tools: Connecting Database to UI Database Manager
Using `Database` a tool at the tool tab manage and view your database
- [ ] Make Sure the Database is working. Go to Docker Desktop and make sure the `image` of `postgre` is green.
- [ ] In `Database` click `Create Connection`
- [ ] Select `PostgreSQL`
- [ ] Setup connection: Port, Username, Password and Database
> can be view the data in `compose.yaml`
- [ ] Click Connect and should show: `Connection Success!` then `Save`


## 8. Design Database: Creating Database formula preparation for automation
Using the GUI of database you need to formulate your data structure on how you will handle datas of your system.
in this demo we need to have a design for our users
Task: Users can be divided into group, they can login, basic information and role.

- [ ] Design a structure
- [ ] Create Base Pattern using the tool by simple selecting the database from `Database`
    - [ ] Select your <database name> ex.: `mydatabase`
    - [ ] Select `Tables` and look for the `+` sign then click it
    - [ ] Create Sample code then copy
    - [ ] Goto your `Explorer`
    - [ ] Create new file for that specific model ex.: `user.model.sql`
    - [ ] Add conditional command on your SQL code
        - [ ] between `CREATE TABLE` and `<table name>` add the following code `IF NOT EXISTS`

Task:
Create more tables for the following
- [ ] Meetings
- [ ] Meeting ↔ User assignments (meeting_user)
- [ ] Tasks

Just Copy the following for the `meeting_users.model.sql`
```sql
CREATE TABLE IF NOT EXISTS meeting_users (
    meeting_id INTEGER NOT NULL REFERENCES meeting (id),
    user_id INTEGER NOT NULL REFERENCES users (id),
    role VARCHAR(50) NOT NULL,
    PRIMARY KEY (meeting_id, user_id)
);
```

## 9. Automation: Creating Resetter
Creating automation needs first a logic on what is the process and what should be expected output.
ex.: Processing `Giniling`, learn what is its `IPO`
- Input: Meat
- Process: Grind
- Output: Giniling

In this step we will design an automation that resets the database when needed and remodeling it.
- Input: Database Code
- Process: Automatically Create
- Output: Create the Tables Ready for Use

- [ ] Creating a new util code `dbResetPostgresql.util.php`

- [ ] Setting up requirements
> Just copy this
```php
declare(strict_types=1);

// 1) Composer autoload
require 'vendor/autoload.php';

// 2) Composer bootstrap
require 'bootstrap.php';

// 3) envSetter
require_once UTILS_PATH . '/envSetter.util.php';
```

- [ ] Adding the database host and connecting
```php
// ——— Connect to PostgreSQL ———
$dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
$pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);
```

- [ ] Using specific commands to use to automatically generate the database tables
```php
// Just indicator it was working
echo "Applying schema from database/user.model.sql…\n";

$sql = file_get_contents('database/user.model.sql');

// Another indicator but for failed creation
if ($sql === false) {
  throw new RuntimeException("Could not read database/user.model.sql");
} else {
    echo "Creation Success from the database/user.model.sql";
}

// If your model.sql contains a working command it will be executed
$pdo->exec($sql);
```

- [ ] Make sure it clean the tables
```php
echo "Truncating tables…\n";
foreach (['users'] as $table) {
  $pdo->exec("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
}
```

- [ ] Add the command in the composer.json
    - below `scripts` add a new library key set
    - `"postgresql:reset": "php utils/dbResetPostgresql.util.php`

- [ ] Test it if working
    - in terminal use command `composer postgresql:reset`


## 10. Adding Seeder: Able to Disable and Enable
