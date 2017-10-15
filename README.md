
# Flypay Coding Test resolution by Antonio Cordasco

## Installation

simply run composer install from the root

to test in the browser, launch the PHP embedded server with: php -S localhost:8000

## Running tests

from the root, run: vendor/bin/behat for the integration tests

from the root, run: vendor/bin/phpunit tests/ --stderr for the unit tests

## Things to know

I've used php-cs-fixer in PhpStorm to quickly fix all the coding standard issues

Unit tests are done with PHPUnit and cover the DAOs

Integration tests are done with Behat and Mockery. A special header called X-MOCK-FIXTURE is being used
so that the system knows which fixture to load. Inside the fixture every call to the DAO layer is mocked.
This is because the DAOs are tested by the unit tests. The integration tests only cover the controllers logic.

