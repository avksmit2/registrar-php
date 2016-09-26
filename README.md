# _{Hair Salon}_

#### _An application that holds a hair salon's stylists and their individual clients, {September 23, 2016}_

#### By _**Angela Smith**_

## Description

_{A mySQL database holds a salon's stylists and their individual clients.  The user can see a list of the stylists and the clients that belong to them. New stylists may be added and new clients to any stylist.}_

## Specifications

| Behavior      | Input       |Output|
| ------------- |-------------| -----|
| Behavior |Input | Output |
| Behavior |Input | Output |
| Behavior |Input | Output |


## Setup/Installation Requirements

* Clone the repository.
* Type in _"apachectl start"_ in the command line.
* Open a browser and navigate to _localhost:8080/phpmyadmin_, enter username: _"root"_ and password: _"root"_ if prompted.
* Go to the Import tab and under "File to import", browse computer to project, select the zip file and press "Go".
* Using the command line, navigate to the project's root directory.
* Install dependencies by running _$composer install_.
* Navigate to the /web directory and start a local server with _$php -S localhost:8000_.
* Open a browser and go to the address http://localhost:8000 to view the application.

* If there is no file to import, type in the command line _"mysql.server start"_ and then _"mysql -uroot -proot"_.
* Type in _"CREATE DATABASE hair_salon;"_.
* Type in _"USE hair_salon;"_.
* Create the tables by typing in _"CREATE TABLE stylists (id serial PRIMARY KEY, name VARCHAR(255));"_ and _"CREATE TABLE clients (id serial PRIMARY KEY, stylist_id INT, name VARCHAR(255), phone VARCHAR(255), last_visit DATE, notes VARCHAR(255));"_.

## Known Bugs

_There are no known bugs at this time_

## Support and contact details

_Angela Smith: avksmit2@gmail.com_

## Technologies Used

_PHP,
mySQL,
Silex,
Twig,
PHPUnit,
Bootstrap,_

### License

*This webpage is licensed under the MIT license.*

Copyright (c) 2016 **_Angela Smith_**
