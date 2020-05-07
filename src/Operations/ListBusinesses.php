<?php

namespace Wave\Operations;

use Wave\Operations\Contracts\OperationInterface;
use GraphQL\Query;

class ListBusinesses extends Operation implements OperationInterface
{
    /**
     * Default fields
     *
     * @var array
     */
    protected $defaultFields = [
        'pageInfo' => ['currentPage', 'totalPages', 'totalCount'],
        'node' => ['id', 'name', 'isClassicAccounting', 'isClassicInvoicing', 'isPersonal']
    ];

    /**
     * Default arguments
     *
     * @var array
     */
    protected $defaultArguments = [
        'businesses' => ['page' => 1, 'pageSize' => 10]
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
        $queryArguments = $this->setArguments($arguments);

        $gql = (new Query('businesses'))
            ->setArguments($queryArguments['businesses'])
            ->setSelectionSet([
                (new Query('pageInfo'))->setSelectionSet($queryFields['pageInfo']),
                (new Query('edges'))->setSelectionSet([
                    (new Query('node'))->setSelectionSet($queryFields['node'])
                ])
            ]);
        $results = $this->client->runQuery($gql);

        return $results->getData()->businesses;
    }
}
