# _University Registrar_

#### _An application that shows students and courses at a university, {September 27, 2016}_

#### By _**Angela Smith**_

## Description

_{This application will show the courses and students at a university. The user can see a course and all of the students enrolled in it as well as a student and all of the courses they are enrolled in. A student can be added to a course and a course can be added to a student.}_

## Specifications

| Behavior      | Input       |Output|
| ------------- |-------------| -----|
| This application will allow a user to add a student and return the information added | "Becky" | "Becky" |
| This application will allow a user to add students and return all of the current students | "Becky", "Francis" | ["Becky", "Francis"] |
| This application will allow a user to delete all of the students | "Becky" | "" |
| This application will allow a user to update a students | "Becky", "Rebecca" | "Rebecca" |
| This application will allow a user to add a course and return the information added | "Biology" | "Biology" |
| This application will allow a user to add courses and return all of the current courses | "Biology", "English" | ["Biology", "English"] |
| This application will allow a user to delete all of the courses | "Biology" | "" |
| This application will allow a user to update a course | "Biology", "Biology 101" | "Biology 101" |
| This application will allow a user to add courses to a student and return all of the courses the student is enrolled in | "Biology", "English" | ["Biology", "English"] |
| This application will allow a user to add students to a course and return all of the students enrolled in the course | "Becky", "Francis" | ["Becky", "Francis"] |
| This application will allow a user to delete a student from a course and return all of the students enrolled in the course | "Becky", "Francis" | ["Becky"] |
| This application will allow a user to delete a course from a student and return all of the courses the student is enrolled in | "Biology", "English" | ["Biology"] |


## Setup/Installation Requirements

* Clone the repository.
* Type in _"apachectl start"_ in the command line.
* Open a browser and navigate to _localhost:8080/phpmyadmin_, enter username: _"root"_ and password: _"root"_ if prompted.
* Go to the Import tab and under "File to import", browse computer to project, select the zip file and press "Go".
* Using the command line, navigate to the project's root directory.
* Install dependencies by running _$composer install_.
* Navigate to the /web directory and start a local server with _$php -S localhost:8000_.
* Open a browser and go to the address http://localhost:8000 to view the application.

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
