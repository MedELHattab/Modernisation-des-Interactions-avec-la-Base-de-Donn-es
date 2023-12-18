# TableORM - Object-Relational Mapping (ORM) for Database Interaction

## Overview

The `TableORM` class is designed to simplify database interactions by providing a basic Object-Relational Mapping (ORM) for a specific database table in PHP. This class abstracts common database operations, allowing developers to interact with the database in an object-oriented manner.

## Key Features

### 1. Constructor

- **Description**: Initializes a new instance of the `TableORM` class, connecting it to a specific database table.
- **Parameters**:
  - `$table` (string): The name of the associated database table.

### 2. Insert Record

- **Description**: Inserts a new record into the associated table.
- **Parameters**:
  - `$data` (array): An associative array representing column-value pairs for the new record.
- **Returns**:
  - (bool) True on success, false on failure.

### 3. Update Record

- **Description**: Updates an existing record in the associated table.
- **Parameters**:
  - `$data` (array): An associative array representing column-value pairs for the updated record.
  - `$id` (int): The ID of the record to update.
- **Returns**:
  - (bool) True on success, false on failure.

### 4. Delete Record

- **Description**: Deletes a record from the associated table.
- **Parameters**:
  - `$id` (int): The ID of the record to delete.
- **Returns**:
  - (bool) True on success, false on failure.

### 5. Select Records

- **Description**: Retrieves records from the associated table based on specified conditions.
- **Parameters**:
  - `$columns` (string, optional): Columns to select (default is `*` for all columns).
  - `$where` (string, optional): A condition to filter records (default is null for no condition).
- **Returns**:
  - (array) An associative array containing the selected records.