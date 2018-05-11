# Secret Santa - School projet 2018

## Getting started

### Prerequisites

```sh
# Clone the repo
git clone https://github.com/PaulAndrianoff/symfonyProjet2018

# Modify your db concection in the .env file :
DATABASE_URL=mysql://{YourUser: default is root}:{YourPassword: root on mamp, empty on wamp}@127.0.0.1:{YourPort: default is 8000}/{The local db name you want to create for yourself: symfonyProjet2018}

# Go to the repo folder
cd symfonyProjet2018

# Generate database
php bin/console doctrine:database:create

# Install dependencies
composer install

# Migration
php bin/console make:migration
php bin/console doctrine:migration:migrate
```

### Running

```sh
php bin/console server:run
```

## Tech stack

* PHP 7
* Symfony 4.0
