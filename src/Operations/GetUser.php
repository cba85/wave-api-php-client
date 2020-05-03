<?php

namespace Wave\Operations;

use Wave\Operations\Contracts\OperationInterface;
use GraphQL\Query;

class GetUser extends Operation implements OperationInterface
{
    public $defaultFields = ['id', 'firstName', 'lastName', 'defaultEmail', 'createdAt', 'modifiedAt'];

    /**
     * Run operation
     *
     * @param array $arguments
     * @return object
     */
    public function run(array $arguments): object
    {
        $fields = $this->setFields($arguments);

        $gql = (new Query('user'))->setSelectionSet($fields);
        $results = $this->client->runQuery($gql);

        return $results->getData()->user;
    }
}
