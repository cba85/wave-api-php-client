# Wave API client

## Install

```bash
$ composer require cba85/wave-api-client
```

## Usage

```php
use Wave\Client;

$wave = new Client('YOUR_WAVE_FULL_ACCESS_TOKEN');
```

### Methods

#### Get user

```php
$optionalFields = ['id', 'firstName'];

$user = $wave->getUser($optionalFields);
```

#### List businesses

```php
$optionalFields = ['pageInfo' => ['totalCount']];
$optionalArguments = ['pageSize' => 25];

$businesses = $wave->listBusinesses($optionalFields, $optionalArguments);
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
$results = $wave->client->operation($query);
$user = $results->data->user;
```

## Wave API documentation

See [Wave API documentation](https://developer.waveapps.com/hc/en-us/articles/360019968212) for reference.

## Tests

Add a test token in an `.env` file based on `.env.example` file example to test Wave API:

```
WAVE_FULL_ACCESS_TOKEN="YOUR_WAVE_FULL_ACCESS_TOKEN"
```

Then launch tests:

```bash
$ ./vendor/bin/phpunit
```
