# Wave API PHP client

A PHP client for [Wave](https://www.waveapps.com/) API.

> Note: I've created this package for my personal need. Not all the Wave API operation has been implemented. But you can add an operation by creating a new class in `src/Operations`.

## Install

```bash
$ composer require cba85/wave-api-php-client
```

## Usage

```php
use Wave\Wave;

$wave = new Wave('YOUR_WAVE_FULL_ACCESS_TOKEN');
```

### Available methods

#### Get user

https://developer.waveapps.com/hc/en-us/articles/360032552912-Query-Get-user

```php
$optionalFields = ['user' => ['id', 'firstName']];
$user = $wave->getUser($optionalFields);
```

#### List businesses

https://developer.waveapps.com/hc/en-us/articles/360032908111-Query-List-businesses

```php
$optionalFields = ['pageInfo' => ['totalCount']];
$optionalArguments = ['businesses' => ['pageSize' => 25]];
$businesses = $wave->listbusinesses($optionalFields, $optionalArguments);
```

#### List products

https://developer.waveapps.com/hc/en-us/articles/360032572872-Query-Paginate-list-of-products

```php
 $wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
$products = $wave->listProducts([], [], [
    'businessId' => getenv('WAVE_BUSINESS_ID'),
    'page' => 1,
    'pageSize' => 1
]);
```

#### Get customer by ID

https://developer.waveapps.com/hc/en-us/articles/360032911011-Query-Get-customer-by-id

```php
$optionalFields = ['customer' => ['id', 'name', 'email']];
$wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
$customer = $wave->getCustomerById($optionalFields, [], [
    'businessId' => getenv('WAVE_BUSINESS_ID'),
    'customerId' => getenv('WAVE_CUSTOMER_ID')
]);
```

#### Create customer

https://developer.waveapps.com/hc/en-us/articles/360032569232-Mutation-Create-customer

```php
$optionalFields = ['customer' => ['id', 'name', 'email']];
$wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
$customerCreate = $wave->createCustomer($optionalFields, [], [
    'input' => [
        'businessId' => getenv('WAVE_BUSINESS_ID'),
        'name' => "Santa",
        'firstName' => "Saint",
        'lastName' => "Nicolas",
        'email' => "santa@claus.com",
        'address' => [
            'city' => "North Pole",
            'postalCode' => "H0H H0H",
            'countryCode' => "CA"
        ],
        'currency' => "EUR"
    ]
]);
```

#### Patch customer

https://developer.waveapps.com/hc/en-us/articles/360033059491-Mutation-Patch-customer

```php
$optionalFields = ['customer' => ['id', 'name', 'email']];
$wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
$customerPatch = $wave->patchCustomer([], [], [
    'input' => [
        'id' => getenv('WAVE_CUSTOMER_ID'),
        'email' => "new@email.com"
    ]
]);
```

#### Create invoice

https://developer.waveapps.com/hc/en-us/articles/360019968212-API-Reference

```php
$wave = new Wave(getenv('WAVE_FULL_ACCESS_TOKEN'));
$invoiceCreate = $wave->createInvoice([], [], [
    'input' => [
        'businessId' => getenv('WAVE_BUSINESS_ID'),
        'customerId' => getenv('WAVE_CUSTOMER_ID'),
        'status' => "DRAFT",
        'items' => [
            'productId' => getenv('WAVE_PRODUCT_ID'),
            'description' => "test",
            'quantity' => 1,
            'unitPrice' => 14.99,
            'taxes' => [
                'salesTaxId' => getenv('WAVE_TAX_ID'),
            ]
        ]
    ]
]);
```

### GraphQL query

It's also possible to manually send a GraphQL query using the [GraphQL client](https://github.com/mghoneimy/php-graphql-client) included behind the scene:

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
