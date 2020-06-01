<?php

namespace Wave\Operations;

/**
 * Operation
 */
abstract class Operation
{
    /**
     * GraphQL client
     *
     * @var GraphQL\Client
     */
    protected $client;

    /**
     * Constructor
     *
     * @param GraphQL\Client $client
     */
    public function __construct(\GraphQL\Client $client)
    {
        $this->client = $client;
    }

    /**
     * Convert fields to GraphQL format
     *
     * @param array $fields
     * @return array
     */
    public function setFields(array $fields): array
    {
        foreach ($this->defaultFields as $key => $defaultSubFields) {
            !empty($fields[$key]) ? $queryFields[$key] = $fields[$key] : $queryFields[$key]  = $defaultSubFields;
        }

        return $queryFields;
    }

    /**
     * Convert arguments to GraphQL format
     *
     * @param array $arguments
     * @return array
     */
    public function setArguments(array $arguments): array
    {
        foreach ($this->defaultArguments as $key => $defaultValue) {
            !empty($arguments[$key]) ? $queryVariables[$key] = $arguments[$key] : $queryVariables[$key] = $defaultValue;
        }

        return $queryVariables;
    }
}
