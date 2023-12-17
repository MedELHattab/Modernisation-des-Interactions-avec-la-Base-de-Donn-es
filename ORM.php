<?php

namespace MyCrud; // Adjust the namespace to follow PSR-1

class BaseORM
{
    protected $db;

    public function __construct(DatabaseHandler $db)
    {
        $this->db = $db;
    }

    /**
     * Get all records from the table.
     *
     * @param string $table The table name.
     * @param string $columns The columns to select.
     * @param string|null $where The WHERE clause.
     * @return mixed The result set.
     */
    public function getAllRecords($table, $columns = "*", $where = null)
    {
        $sql = "SELECT $columns FROM $table";

        if ($where !== null) {
            $sql .= " WHERE $where";
        }

        $stmt = $this->db->prepareStatement($sql);
        $stmt->executeStatement();

        return $stmt->getResult();
    }

}

class TableORM extends BaseORM
{
    private $table;

    public function __construct(DatabaseHandler $db, $table)
    {
        parent::__construct($db);
        $this->table = $table;
    }

    public function insertRecord($data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $this->table($columns) VALUES($values)";

        $stmt = $this->db->prepareStatement($sql);

        $types = str_repeat('s', count($data));
        $params = array_values($data);
        $stmt->bindParams($types, ...$params);

        return $stmt->executeStatement();
    }

    public function updateRecord($data, $id)
    {
        $args = array();

        foreach ($data as $key => $value) {
            $args[] = "$key = ?";
        }

        $sql = "UPDATE $this->table SET " . implode(',', $args) . " WHERE id = ?";

        $stmt = $this->db->prepareStatement($sql);

        $types = str_repeat('s', count($data) + 1);
        $params = array_values($data);
        $params[] = $id;
        $stmt->bindParams($types, ...$params);

        return $stmt->executeStatement();
    }

    public function deleteRecord($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";

        $stmt = $this->db->prepareStatement($sql);
        $stmt->bindParams('i', $id);

        return $stmt->executeStatement();
    }

    public function selectRecords($columns = "*", $where = null)
    {
        $sql = "SELECT $columns FROM $this->table";

        if ($where !== null) {
            $sql .= " WHERE $where";
        }

        $stmt = $this->db->prepareStatement($sql);
        $stmt->executeStatement();

        return $stmt->getResult();
    }
    
    /**
     * Get all records from the table.
     *
     * @param string $columns The columns to select.
     * @param string|null $where The WHERE clause.
     * @return mixed The result set.
     */
    public function getAllRecords($columns = "*", $where = null)
    {
        return parent::getAllRecords($this->table, $columns, $where);
    }
}
