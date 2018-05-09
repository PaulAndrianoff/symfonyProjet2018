# Secret Santa - School projet 2018

## Getting started

### Prerequisites

```sh
# Clone the repo
git clone https://github.com/PaulAndrianoff/symfonyProjet2018

# Go to the repo folder
cd symfonyProjet2018

# Generate database
php bin/console doctrine:database:create

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
