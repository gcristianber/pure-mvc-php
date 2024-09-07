<?php

namespace App\Core;

class Database
{

    /**
     * Initializes a connection to the database using PDO.
     */
    private function connect(): \PDO | string
    {
        try {
            $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'];
            $con = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);

            return $con;
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    /**
     * Executes the query statement to the database.
     */
    protected function query(string $query, array $data = [])
    {

        $con = $this->connect();
        $stm = $con->prepare($query);

        $check = $stm->execute($data);

        if ($check) {
            $result = $stm->fetchAll(\PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result;
            }
        }

        return false;
    }

    /**
     * Kills the connection to the database.
     */
    private function disconnect() {}
}
