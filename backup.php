 <?php
 include 'navigation.php';
// Database connection details
$mysqlHostName = "localhost";
$mysqlUserName = "root";
$mysqlPassword = "";
$DbName = "mydb";

// Export database
if (isset($_POST['export'])) {
    exportDatabase($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName);
}

// Restore database
//if (isset($_POST['restore']) && $_FILES['backup_file']['error'] == 0) {
    //restoreDatabase($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName, $_FILES['backup_file']['tmp_name']);
//}

function exportDatabase($host, $user, $pass, $name) {
    // Connect to MySQL
    $connection = @mysql_connect($host, $user, $pass);
    if (!$connection) {
        die('Could not connect to MySQL: ' . mysql_error());
    }
    mysql_select_db($name, $connection);

    $tables = mysql_query('SHOW TABLES');
    $content = '';

    while ($table = mysql_fetch_row($tables)) {
        $tableName = $table[0];
        $createTableQuery = mysql_query("SHOW CREATE TABLE $tableName");
        $createTable = mysql_fetch_row($createTableQuery);
        $content .= "\n\n" . $createTable[1] . ";\n\n";

        $result = mysql_query("SELECT * FROM $tableName");
        while ($row = mysql_fetch_assoc($result)) {
            $values = array_map('mysql_real_escape_string', array_values($row));  // Escape each value
            $content .= "INSERT INTO $tableName VALUES ('" . implode("', '", $values) . "');\n";
        }
    }
    $filename = "backup_{$name}_" . date("Y-m-d") . ".sql";
    header('Content-Type: application/octet-stream');
    header("Content-disposition: attachment; filename=\"$filename\"");
    echo $content;
    exit;
}

//function restoreDatabase($host, $user, $pass, $name, $backupFile) {
    // Connect to MySQL
   // $connection = @mysql_connect($host, $user, $pass);
    //if (!$connection) {
       // die('Could not connect to MySQL: ' . mysql_error());
   // }
    //mysql_select_db($name, $connection);

    // Read the backup file content and remove comments
   // $content = preg_replace('/^\s*--.*/m', '', file_get_contents($backupFile));
  //  $queries = explode(";\n", $content);

    // Truncate tables to avoid duplicates
   // $tables = mysql_query("SHOW TABLES");
    //while ($table = mysql_fetch_row($tables)) {
       // mysql_query("TRUNCATE TABLE `$table[0]`");
  //  }

   // foreach ($queries as $query) {
       // if (trim($query) && strpos(strtolower($query), 'create table') === false) {
          //  mysql_query($query);
       // }
   // }

   // echo "Database restored successfully!";
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Backup </title>
    <link rel="stylesheet"href="bootstrap/bootstrap.min.css">
    <style>
        body{
                font-family: 'Times New Roman';
                font-size:14pt;
                margin-top:5%;
                place-items:center;
            }
            .menu a{
                background-color: #fff;
                height: 45px;
                width: 90%;
                margin-left: 11px;
                text-align: center;
                font-family: 'Times New Roman';
                font-size:17pt;
                border-radius: 25px;
                text-decoration: none;
            }
            .menu a:hover{
                background-color: lightgray;
                width: 90%;
            }
        .container{padding:50px;}
        .form-title{
           margin-top:5%;
           font-weight: 600;
           text-align: center;
           padding-bottom: 5%;
           color:black;
           text-shadow: 2px 2px 2px black;}
           </style>
</head>
<body>

<div class="container">
        <div class="row">
            <div class="col-md-6  mt-5  m-auto bg-light shadow font-monospace  border border-dark">
            <h1 class="form-title">Export Database</h1>

             <!-- Export Form -->
        <form method="POST">
        <div class="form-group">
        <button type="submit" name="export"class="w-50 bg-success text-white">Database Backup</button>
        </div>
    </form>

    <!-- Restore Form -->
   <!-- <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="backup_file"><b>Choose Backup File to Restore<b></label>
        <input type="file" name="backup_file" id="backup_file" class="form-control">
        </div>
        <div class="form-group">
     <button type="submit" name="restore"class="w-50 bg-primary text-white">Restore Database</button>
        </div>
    </form>-->

    <?php if (isset($_POST['export'])): ?>
        <div class="message">Backup created successfully! <a href="<?php echo "backup_{$DbName}_" . date("Y-m-d") . ".sql"; ?>" download>Download Backup</a></div>
    <?php endif; ?>

    
</div>
</div>
</div>
</body>
</html>