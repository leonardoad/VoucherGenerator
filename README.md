# Voucher Manager

A voucher manager to create discount codes for offers

## Getting Started

This web app was built using Zend Framework, Smarty, JQuery, Twitter-bootstrap and much passion for our work!

### Installing

Clone the project files.

```
$ git clone git@github.com:leonardoad/voucherManager.git
```
Crate and set permission to the templates and images folder:
```
/Libs/View/templates_c
```

Restore the database using the script that is on the path
```
/res/db/voucher.sql
```

Configure the database access information on the file `/site/Application/Config.ini` like the example below
```
db.adapter = pdo_mysql
db.config.host = localhost
db.config.username = root
db.config.password = 'mypassword'
db.config.dbname = voucher
```

To log in as site master admin use:
user: admin
password: menuap

## Author

* **Leonardo Danieli** - [leonardoad](https://github.com/leonardoad)

## Running the tests

### Composer

With the **composer** installed, run the command:
```
composer install
```
It will install the dependencies for the tests

### Tests
Open the comand line prompt on the project's root folder and execute the comand:

```
vendor/bin/phpunit --bootstrap ./site/Application/Models/Voucher.php ./tests/VoucherTest 
```
### Testing API with Postman

All the API requests are on a Postman Collection:

[Postman](https://documenter.getpostman.com/view/3374636/voucher-manager/7LhjkWi) - Postman API Documentation   
## Built With

* [Zend Framework](https://framework.zend.com/) - The web framework used
* [Composer](https://getcomposer.org/) - Dependency Management
* [PHPUnit](https://phpunit.de/) - Used to the tests
  
## Database Schema
![Database Schema](https://github.com/leonardoad/VoucherManager/blob/master/res/Database%20Design.PNG?raw=true)

## Voucher Generator Screen
![Generator](https://github.com/leonardoad/VoucherManager/blob/master/res/img/voucher_generator.PNG?raw=true)

## Voucher List Screen
![List](https://github.com/leonardoad/VoucherManager/blob/master/res/img/vouchers_list.PNG?raw=true)
 

