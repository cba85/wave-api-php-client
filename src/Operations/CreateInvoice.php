<?php

namespace Wave\Operations;

use Wave\Operations\Contracts\OperationInterface;
use GraphQL\Mutation;
use GraphQL\Variable;
use GraphQL\Query;

class CreateInvoice extends Operation implements OperationInterface
{
    /**
     * Default fields
     *
     * @var array
     */
    protected $defaultFields = [
        'invoiceCreate' => ['didSucceed'],
        'inputErrors' => ['code', 'message', 'path'],
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
        $invoiceCreateFields = implode(',', $queryFields['invoiceCreate']);

        $mutation = (new Mutation('invoiceCreate'))
            ->setVariables([new Variable('input', 'InvoiceCreateInput', true)])
            ->setArguments(['input' => '$input'])
            ->setSelectionSet([
                $invoiceCreateFields
            ]);
        $results = $this->client->runQuery($mutation, false, $variables);

        return $results->getData()->invoiceCreate;
    }
}
