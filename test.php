<?php
require ("./vendor/autoload.php");
$db = new DatabaseHandler('localhost', 'root', '', 'task_db');
$tableORM = new TableORM($db, 'your_table');

// Insert example
$insertData = array('column1' => 'value1', 'column2' => 'value2');
$tableORM->insertRecord($insertData);

// Update example
$updateData = array('column1' => 'new_value1', 'column2' => 'new_value2');
$tableORM->updateRecord($updateData, 1);

// Delete example
$tableORM->deleteRecord(1);

// Select example
$selectResult = $tableORM->selectRecords('column1, column2', 'column1 = "value1"');
while ($row = mysqli_fetch_assoc($selectResult)) {
    // Process each row
}

// Close the connection
$db->closeConnection();