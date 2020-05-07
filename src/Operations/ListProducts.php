<?php

namespace Wave\Operations;

use Wave\Operations\Contracts\OperationInterface;
use GraphQL\Query;
use GraphQL\Variable;

class ListProducts extends Operation implements OperationInterface
{
    /**
     * Default fields
     *
     * @var array
     */
    protected $defaultFields = [
        'business' => ['id'],
        'pageInfo' => ['currentPage', 'totalPages', 'totalCount'],
        'node' => ['id', 'name', 'description', 'unitPrice', 'isSold', 'isBought', 'isArchived', 'createdAt', 'modifiedAt'],
        'defaultSalesTaxes' => ['id', 'name', 'abbreviation', 'rate']
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
        $businessFields = implode(',', $queryFields['business']);
        $nodeFields = implode(',', $queryFields['node']);

        $gql = (new Query('business'))
            ->setVariables([
                new Variable('businessId', 'ID', true),
                new Variable('page', 'Int', true),
                new Variable('pageSize', 'Int', true)
            ])
            ->setArguments(['id' => '$businessId'])
            ->setSelectionSet([
                $businessFields,
                (new Query('products'))
                    ->setArguments([
                        'page' => '$page',
                        'pageSize' => '$pageSize',
                    ])
                    ->setSelectionSet([
                        (new Query('pageInfo'))->setSelectionSet($queryFields['pageInfo']),
                        (new Query('edges'))->setSelectionSet([
                            (new Query('node'))->setSelectionSet([
                                $nodeFields,
                                (new Query('defaultSalesTaxes'))->setSelectionSet($queryFields['defaultSalesTaxes'])
                            ])
                        ])
                    ])
            ]);
        $results = $this->client->runQuery($gql, false, $variables);

        return $results->getData()->business->products;
    }
}
