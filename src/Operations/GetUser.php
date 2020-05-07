<?php

namespace Wave\Operations;

use Wave\Operations\Contracts\OperationInterface;
use GraphQL\Query;

class GetUser extends Operation implements OperationInterface
{
    public $defaultFields = [
        'user' => ['id', 'firstName', 'lastName', 'defaultEmail', 'createdAt', 'modifiedAt']
    ];

    /**
     * Run operation
     *
     * @param array $arguments
     * @return object
     */
    public function run(array $arguments): object
    {
        $fields = $arguments[0];
        $queryFields = $this->setFields($fields);

        $gql = (new Query('user'))->setSelectionSet($queryFields['user']);
        $results = $this->client->runQuery($gql);

        return $results->getData()->user;
    }
}
