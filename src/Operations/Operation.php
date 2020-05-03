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
     * @return string|array
     */
    public function setFields(array $fields)
    {
        if (count($this->defaultFields) == count($this->defaultFields, COUNT_RECURSIVE)) {
            $fields ? $queryFields = $fields : $queryFields = $this->defaultFields;
        } else {
            foreach ($this->defaultFields as $key => $defaultSubFields) {
                $fields[$key] ? $queryFields[$key] = $fields[$key] : $queryFields[$key]  = $defaultSubFields;
            }
        }

        return $queryFields;
    }
}
