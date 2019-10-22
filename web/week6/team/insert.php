<?php 
require_once("scrDb.php");
$db = get_db();
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
    <div>
        <form action="insert.php" method="post">
            <input type="hidden" name="sent" value="True">
            <input type="text" name="book" placeholder="Book"><br>
            <input type="text" name="chapter" placeholder="chapter"><br>
            <input type="text" name="verse" placeholder="verse"><br>
            <textarea name="content" cols="30" rows="10"></textarea>
            <?php 
                // $query = 'SELECT topic FROM scr.topics';
                // $stmt = $db -> prepare($query);
                // $stmt = execute();
                // $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // vardump($topics);
                echo "<br>";
                foreach ($db->query('SELECT topic FROM scr.topics') as $topic) {
                    echo "<input type='checkbox' name='topic' value='" . $topic['topic'] . "'>" . $topic['topic'];
                }
            ?>     
        </form>
    </div>
</body>
</html>