<?php

namespace Wave\Operations;

use Wave\Operations\Contracts\OperationInterface;
use GraphQL\Query;
use GraphQL\Variable;

class GetCustomerById extends Operation implements OperationInterface
{
    /**
     * Default fields
     *
     * @var array
     */
    protected $defaultFields = [
        'customer' => ['id', 'name', 'firstName', 'lastName', 'email', 'mobile', 'phone', 'fax', 'tollFree', 'website', 'createdAt', 'modifiedAt'],
        'address' => ['addressLine1', 'addressLine2', 'city', 'postalCode'],
        'country' => ['code', 'name'],
        'currency' => ['code', 'name', 'symbol']
    ];

    /**
     * Run operation
     *
     * @param array $fields
     * @param array $arguments
     * @param array $variables
     * @return object
     */
    public function run(array $fields = [], array $arguments = [], array $variables = []): object
    {
        $queryFields = $this->setFields($fields);
        $customerFields = implode(',', $queryFields['customer']);
        $addressFields = implode(',', $queryFields['address']);

        $gql = (new Query('business'))
            ->setVariables([
                new Variable('businessId', 'ID', true),
                new Variable('customerId', 'ID', true),
            ])
            ->setArguments(['id' => '$businessId'])
            ->setSelectionSet([
                (new Query('customer'))
                    ->setArguments(['id' => '$customerId'])
                    ->setSelectionSet([
                        $customerFields,
                        (new Query('address'))
                            ->setSelectionSet([
                                $addressFields,
                                (new Query('country'))->setSelectionSet($queryFields['country'])
                            ]),
                        (new Query('currency'))->setSelectionSet($queryFields['currency'])
                    ])
            ]);

        $results = $this->client->runQuery($gql, false, $variables);

        return $results->getData()->business->customer;
    }
}
