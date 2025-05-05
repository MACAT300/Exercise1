<?php

    // 1. database info
    $host = 'mysql';
    $database_name = 'todoapp';
    $database_user = 'root';
    $database_password = 'secret';

    // 2. connect to DB
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );

    // data from the form
    $task_id = $_POST["task_id"];
    $task_completed = $_POST["task_completed"];

    // 3. update the task completed status in database
    if ( $task_completed === '0' ) {
        // 3.1 SQL command
        $sql = "UPDATE todos SET completed = 1 WHERE id = :id";
    } else {
        // 3.1 SQL command
        $sql = "UPDATE todos SET completed = 0 WHERE id = :id";
    }

    // 3.2 prepare
    $query = $database->prepare( $sql );
    // 3.3 execute
    $query->execute([
        "id" => $task_id
    ]);

    // 4. redirect
    header("Location: index.php");
    exit; 