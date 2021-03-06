<?php

namespace Wave\Operations\Contracts;

/**
 * Operation interface
 */
interface OperationInterface
{
    public function run(array $fields, array $arguments, array $variables);
}
