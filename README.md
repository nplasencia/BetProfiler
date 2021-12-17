# Bet Profiler

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