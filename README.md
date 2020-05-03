# Wave API PHP client

## Install

```bash
$ composer require cba85/wave-api-php-client
```

## Usage

```php
use Wave\Wave;

$wave = new Wave('YOUR_WAVE_FULL_ACCESS_TOKEN');
```

### Methods

#### Get user

```php
$optionalFields = ['id', 'firstName'];
$user = $wave->getUser($optionalFields);
```

### GraphQL query

It's also possible to manually send a GraphQL query:

```php
 $query = <<<'GRAPHQL'
            query {
                user {
                    id
                    firstName
                    lastName
                    defaultEmail
                    createdAt
                    modifiedAt
                }
            }
            GRAPHQL;
$wave = new Wave('YOUR_WAVE_FULL_ACCESS_TOKEN');
$results = $wave->client->runRawQuery($query, false);
```

## Wave API documentation

See [Wave API documentation](https://developer.waveapps.com/hc/en-us/articles/360019968212) for reference.

## Tests

Add Wave tokens and ids in an `.env` file based on `.env.example` file example to test Wave API.

Then launch tests:

```bash
$ ./vendor/bin/phpunit
```
