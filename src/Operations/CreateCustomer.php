<?php

namespace Wave\Operations;

use Wave\Operations\Contracts\OperationInterface;
use GraphQL\Mutation;
use GraphQL\Variable;
use GraphQL\Query;

class CreateCustomer extends Operation implements OperationInterface
{
    /**
     * Default fields
     *
     * @var array
     */
    protected $defaultFields = [
        'customerCreate' => ['didSucceed'],
        'inputErrors' => ['code', 'message', 'path'],
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
        $customerCreateFields = implode(',', $queryFields['customerCreate']);
        $customerFields = implode(',', $queryFields['customer']);
        $addressFields = implode(',', $queryFields['address']);

        $mutation = (new Mutation('customerCreate'))
            ->setVariables([new Variable('input', 'CustomerCreateInput', true)])
            ->setArguments(['input' => '$input'])
            ->setSelectionSet([
                $customerCreateFields,
                (new Query('inputErrors'))->setSelectionSet($queryFields['inputErrors']),
                (new Query('customer'))->setSelectionSet([
                    $customerFields,
                    (new Query('address'))
                        ->setSelectionSet([
                            $addressFields,
                            (new Query('country'))->setSelectionSet($queryFields['country'])
                        ]),
                    (new Query('currency'))->setSelectionSet($queryFields['currency'])
                ])
            ]);
        $results = $this->client->runQuery($mutation, false, $variables);

        return $results->getData()->customerCreate;
    }
}
