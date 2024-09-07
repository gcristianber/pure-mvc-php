<?php

namespace App\Core;

/**
 * Using a Trait Class to share the properties and methods to its children.
 */
trait Model
{
    use \App\Core\Database;

    protected int $offset = 0;
    protected int $limit = 100;
    protected string $orderBy = "DESC";
    protected string $orderColumn = "id";
    protected bool $allowDelete = false;

    /**
     * Returns all the record.
     */
    public function all(): \PDOStatement
    {
        $query = "SELECT * FROM $this->table LIMIT $this->limit OFFSET $this->offset";
        return $this->query($query);
    }

    /**
     * Returns the first record.
     */
    public function first(array $data, array $dataNot = []): \PDOStatement | bool
    {
        $keys = array_keys($data);
        $keysNot = array_keys($dataNot);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keysNot as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");

        $query .= " LIMIT $this->limit OFFSET $this->offset";
        $data = array_merge($data, $dataNot);

        $result = $this->query($query, $data);
        if ($result)
            return $result[0];

        return false;
    }

    /**
     * Returns a certain record based on the condition.
     */
    public function where(array $data, array $dataNot = []): \PDOStatement | bool
    {
        $keys = array_keys($data);
        $keys_not = array_keys($dataNot);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }

        $query = trim($query, " && ");
        $query .= " LIMIT $this->limit OFFSET $this->offset";

        $data = array_merge($data, $dataNot);

        return $this->query($query, $data);
    }


}
