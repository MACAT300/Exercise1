<?php
    // 1. database info
    $host = 'mysql';
    $database_name = 'todoapp';
    $database_user = 'root';
    $database_password = '';

    // 2. connect to DB
    $database = new PDO(
        "mysql:host=$host;dbname=$database_name",
        $database_user,
        $database_password
    );

    // 3. load the data
    // SQL command
    $sql = "SELECT * FROM todos";
    // prepare
    $query = $database->prepare( $sql );
    // execute
    $query->execute();
    // fetch all
    $tasks = $query->fetchAll();

?>
<!DOCTYPE html>
<html>
  <head>
    <title>TODO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My Todo List</h3>
        <ul class="list-group">
        <?php foreach( $tasks as $task ) : ?>
          <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
              <form
                method="POST"
                action="complete_task.php">
                    <input type="hidden" 
                        name="task_id"
                        value="<?= $task["id"]; ?>" />
                    <input type="hidden" 
                        name="task_completed"
                        value="<?= $task["completed"]; ?>" />
                    <?php if ( $task["completed"] === 1 ) : ?>
                        <button class="btn btn-sm btn-success">
                            <i class="bi bi-check-square"></i>
                        </button>
                        <span class="ms-2 text-decoration-line-through"><?= $task["label"]; ?></span>
                    <?php else : ?>
                        <button class="btn btn-sm">
                            <i class="bi bi-square"></i>
                        </button>
                        <span class="ms-2"><?= $task["label"]; ?></span>
                    <?php endif; ?>
                </form>
            </div>
            <div>
                <form
                    method="POST"
                    action="delete_task.php"
                    >
                    <input type="hidden" 
                        name="task_id"
                        value="<?= $task["id"]; ?>" />
                    <button class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
        <div class="mt-4">
          <form
            method="POST"
            action="add_task.php"
            class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="label"
              required
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>