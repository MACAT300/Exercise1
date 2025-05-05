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

    $label = $_POST["label"];

    // 3. check if the label is not empty
    if ( empty( $label ) ) {
        echo "Please fill up the task field";
    } else {
        // 4. add the task into the table
        // 4.1 SQL
        $sql = "INSERT INTO todos (`label`) VALUES (:label)";
        // 4.2 prepare
        $query = $database->prepare( $sql );
        // 4.3 execute
        $query->execute([
            "label" => $label
        ]);
        // 5. redirect
        header("Location: index.php");
        exit;
    }