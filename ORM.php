<?php

require_once 'Database.php';
/**
 * Class TableORM
 * 
 * Represents a basic Object-Relational Mapping (ORM) for interacting with a database table.
 */
class TableORM
{
    /**
     * @var PDO The database connection.
     */
    private $conn;

    /**
     * @var string The name of the database table.
     */
    private $table;

    /**
     * TableORM constructor.
     *
     * @param string $table The name of the database table.
     */
    public function __construct($table)
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->table = $table; // Set the $table property
    }

    // public function createUser($username, $email, $password) {
    //     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //     $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([$username, $email, $hashedPassword]);

    //     return $stmt->rowCount() > 0;
    // }


    /**
     * Inserts a new record into the associated table.
     *
     * @param array $data An associative array where keys are column names and values are corresponding values for the new record.
     *
     * @return bool Returns true on success and false on failure.
     */
    public function insertRecord($data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $this->table($columns) VALUES($values)";

        $stmt = $this->conn->prepare($sql);

        $types = str_repeat('s', count($data));
        $params = array_values($data);
        $stmt->execute($params); // Use execute directly for binding parameters

        return $stmt->rowCount() > 0;
    }


    /**
     * Updates an existing record in the associated table.
     *
     * @param array $data An associative array where keys are column names and values are new values for the record.
     * @param int $id The ID of the record to update.
     *
     * @return bool Returns true on success and false on failure.
     */
    public function updateRecord($data, $id)
    {
        $args = array();

        foreach ($data as $key => $value) {
            $args[] = "$key = ?";
        }

        $sql = "UPDATE $this->table SET " . implode(',', $args) . " WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $types = str_repeat('s', count($data) + 1);
        $params = array_values($data);
        $params[] = $id;
        $stmt->execute($params); // Use execute directly for binding parameters

        return $stmt->rowCount() > 0;
    }


    /**
     * Deletes a record from the associated table.
     *
     * @param int $id The ID of the record to delete.
     *
     * @return bool Returns true on success and false on failure.
     */
    public function deleteRecord($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }


    /**
     * Retrieves records from the associated table based on the provided conditions.
     *
     * @param string $columns The columns to select (default is * for all columns).
     * @param string|null $where The condition to filter records (default is null for no condition).
     *
     * @return array Returns an associative array containing the selected records.
     */
    public function selectRecords($columns = "*", $where = null)
    {
        $sql = "SELECT $columns FROM $this->table";

        if ($where !== null) {
            $sql .= " WHERE $where";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get the result as an array
    }
}
