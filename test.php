<?php

require ("ORM.php");

$tableORM = new TableORM('test');

// Example 1: Insert a record
// $insertData = array('column1' => 'value1', 'column2' => 'value2');
// $result = $tableORM->insertRecord($insertData);
// echo "Insert Result: " . ($result ? "Success" : "Failure") . PHP_EOL;

// Example 2: Update a record with ID 1
$updateData = array('column1' => 'new_value1');
$result = $tableORM->updateRecord($updateData, 1);
echo "Update Result: " . ($result ? "Success" : "Failure") . PHP_EOL;

// Example 3: Delete a record with ID 1
$result = $tableORM->deleteRecord(1);
echo "Delete Result: " . ($result ? "Success" : "Failure") . PHP_EOL;

// Example 4: Select records with a WHERE clause
$selectResult = $tableORM->selectRecords('column1, column2', 'column1 = "value1"');
echo "Selected Records:" . PHP_EOL;
foreach ($selectResult as $row) {
    print_r($row);
}

