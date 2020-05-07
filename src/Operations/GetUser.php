<?php

namespace Wave\Operations;

use Wave\Operations\Contracts\OperationInterface;
use GraphQL\Query;

class GetUser extends Operation implements OperationInterface
{
    /**
     * Default fields
     *
     * @var array
     */
    protected $defaultFields = [
        'user' => ['id', 'firstName', 'lastName', 'defaultEmail', 'createdAt', 'modifiedAt']
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

        $gql = (new Query('user'))->setSelectionSet($queryFields['user']);
        $results = $this->client->runQuery($gql);

        return $results->getData()->user;
    }
}
