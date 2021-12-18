# Bet Profiler

## Project Architecture

In order to implement a Clean Code architecture, this project uses 4 different concepts: entities, interactors, boundaries and gateways.

### Entities

Represent the business logic.

### Interactors

Represent the specific use cases of the application.

### Boundaries

A boundary is formed by two sets of interfaces:
* The first set is used by the Delivery Mechanism controller and implemented by the interactor. It accepts Request Model data structure.
* The second one is used by the interactor and implemented by the Delivery Mechanism presenter. It accepts Response Model data structure.

### Gateways

This interface is used by the interactor and implemented by the Gateway Entity Implementation. This last one will be 
responsible for getting the data from the database and convert them into entities which will be used by the Interactor.

## Docker commands

### Install composer dependencies

```bash
docker-compose run composer install
```

### Update composer dependencies

```bash
docker-compose run composer update
```

## Run unit tests

```bash
docker-compose run phpunit
```

## Generate phpunit configuration

```bash
docker-compose run phpunit --generate-configuration
```