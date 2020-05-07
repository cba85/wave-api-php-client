<?php

namespace Wave;

use Exception;
use GraphQL\Client;

/**
 * Wave API
 */
class Wave
{

    /**
     * Wave API endpoint url
     */
    const ENDPOINT = 'https://gql.waveapps.com/graphql/public';

    /**
     * GraphQL client
     *
     * @var object
     */
    public $client;

    /**
     * Initialize GraphQL client
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->client = new Client(self::ENDPOINT, ['Authorization' => "Bearer {$token}"]);
    }

    /**
     * Dynamic class calling
     *
     * @param string $name
     * @param array $arguments
     * @return object|array
     */
    public function __call(string $name, array $arguments = [])
    {
        $className = "Wave\\Operations\\" . ucwords($name);
        if (!class_exists($className)) {
            throw new Exception('This method is not supported.');
        }
        $class = new $className($this->client);
        for ($i = 0; $i <= 2; $i++) {
            if (!isset($arguments[$i])) {
                $arguments[$i] = [];
            }
        }
        return $class->run($arguments[0], $arguments[1], $arguments[2]);
    }
}
