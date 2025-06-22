<?php

namespace App\Factory;

use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;

class DatabaseConnectionFactory
{
    public function __construct(private ManagerRegistry $doctrine)
    {}

    public function getDefaultConnection(): Connection
    {
        return $this->doctrine->getConnection();
    }

    public function getSecondConnection(): Connection
    {
        return $this->doctrine->getConnection('temp_db');
    }
}