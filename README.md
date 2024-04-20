# Symfony 7 project with Event Dispatcher

## Steps to install the project

- Clone the Project from the command  "git clone https://github.com/mmusaab/users_api.git"
- run the command "cd users_api"
- run the command "docker-compose up --build"

Open docker "users_api" terminal

inside the docker terminal run below commands
- cd project
- composer install
- php bin/console doctrine:migrations:migrate
- php bin/console cache:clear

> symfony server is started on this url http://localhost:8741/

To test the API endpoint, open postman or any other application
Put endpoint in url "http://localhost:8741/api/users"
Set Method to "POST"

add json data in body tab

> { "firstName":  "test1", "lastName":  "test 3", "email":  "test@gmail.com" }

also unit tests are added, please run below command in docker to execute the tests.
- php bin/phpunit

the saved data can be shown in DB and the log file at path 
> ‘project/var/log/postData.txt’