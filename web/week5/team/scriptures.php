<?php 
    try
    {
      $dbUrl = getenv('DATABASE_URL');
    
      $dbOpts = parse_url($dbUrl);
    
      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');
    
      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)
    {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scriptures</title>
</head>
<body>
    <header>
        <h1>Scripture Resources</h1>
    </header>
    <div>
    <form action='scriptures.php' method='post'>
    <?php 
        foreach ($db->query('SELECT id, book, chapter, verse, content FROM scr.scriptures ORDER BY id DESC') as $row)
        {
          echo $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . ' - ' . $row['content'];
          echo '<br/>';
        }
    ?>
    </div>
</body>
</html>