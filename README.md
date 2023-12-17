# MyCrud ORM

MyCrud ORM is a simple Object-Relational Mapping (ORM) library for PHP that facilitates database interactions using an object-oriented approach. It provides a basic structure for handling common database operations and can be easily extended for specific use cases.

## Features

- **BaseORM Class:** Contains common functionality for handling CRUD operations.
- **TableORM Class:** Extends BaseORM and provides table-specific operations.

DatabaseHandler Class
__construct($servername, $username, $password, $dbname)

..Purpose: Initializes a new instance of the DatabaseHandler class and establishes a connection to the database.

..Parameters:
$servername: The name of the server hosting the database.
$username: The username used to connect to the database.
$password: The password used to connect to the database.
$dbname: The name of the database to connect to.
connectDatabase()

..Purpose: Establishes a connection to the database using the provided connection details.
Return: Returns a MySQLi object representing the database connection.
insertRecord($table, $data)

..Purpose: Inserts a new record into the specified table.

..Parameters:
$table: The name of the table to insert the record into.
$data: An associative array where keys are column names and values are the corresponding values for the new record.
Return: Returns true on success and false on failure.
updateRecord($table, $data, $id)

..Purpose: Updates an existing record in the specified table.

..Parameters:
$table: The name of the table to update the record in.
$data: An associative array where keys are column names and values are the new values for the record.
$id: The ID of the record to update.
Return: Returns true on success and false on failure.
deleteRecord($table, $id)

..Purpose: Deletes a record from the specified table.

..Parameters:
$table: The name of the table to delete the record from.
$id: The ID of the record to delete.
Return: Returns true on success and false on failure.
selectRecords($table, $columns = "*", $where = null)

..Purpose: Retrieves records from the specified table based on the provided conditions.

..Parameters:
$table: The name of the table to select records from.
$columns: The columns to select (default is * for all columns).
$where: The condition to filter records (default is null for no condition).
Return: Returns a MySQLi result set containing the selected records.
closeConnection()

..Purpose: Closes the database connection.
TableORM Class
__construct(DatabaseHandler $db, $table)

..Purpose: Initializes a new instance of the TableORM class for a specific table.

..Parameters:
$db: An instance of the DatabaseHandler class representing the database connection.
$table: The name of the table associated with this ORM instance.
insertRecord($data)

..Purpose: Inserts a new record into the associated table.

..Parameters:
$data: An associative array where keys are column names and values are the corresponding values for the new record.
Return: Returns true on success and false on failure.
updateRecord($data, $id)

..Purpose: Updates an existing record in the associated table.

..Parameters:
$data: An associative array where keys are column names and values are the new values for the record.
$id: The ID of the record to update.
Return: Returns true on success and false on failure.
deleteRecord($id)

..Purpose: Deletes a record from the associated table.

..Parameters:
$id: The ID of the record to delete.
Return: Returns true on success and false on failure.
selectRecords($columns = "*", $where = null)

..Purpose: Retrieves records from the associated table based on the provided conditions.

..Parameters:
$columns: The columns to select (default is * for all columns).
$where: The condition to filter records (default is null for no condition).
Return: Returns a MySQLi result set containing the selected records.
getAllRecords($columns = "*", $where = null)

..Purpose: Overrides the getAllRecords method from the BaseORM class, allowing retrieval of all records from the associated table.

..Parameters: Same as the selectRecords method.
Return: Returns a MySQLi result set containing all records from the associated table.
