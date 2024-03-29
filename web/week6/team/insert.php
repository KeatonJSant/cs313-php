<?php 
session_start();

require_once("scrDb.php");
$db = get_db();

$book = $_POST['book'];
$chapter = $_POST['chapter'];
$verse = $_POST['verse']; 
$content = $_POST['content'];
$topic = $_POST['topic'];

if (isset($book)) {

    $query = 'INSERT INTO scr.scriptures (book, chapter, verse, content) VALUES (:book, :chapter, :verse, :content)';
    $stmt = $db -> prepare($query);
    $stmt->bindValue(':book', $book, PDO::PARAM_STR);
    $stmt->bindValue(':chapter', $chapter, PDO::PARAM_INT);  
    $stmt->bindValue(':verse', $verse, PDO::PARAM_INT);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);  
    $result = $stmt->execute(); 

    $query = 'SELECT id, book, chapter, verse, content FROM scr.scriptures WHERE book = :book AND chapter = :chapter AND verse = :verse AND content = :content';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':book', $book, PDO::PARAM_STR);
    $stmt->bindValue(':chapter', $chapter, PDO::PARAM_INT);  
    $stmt->bindValue(':verse', $verse, PDO::PARAM_INT);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->execute();
    $scr_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    $count = sizeof($topic);

    for ($i=0; $i < $count; $i++) {
        $query = 'SELECT topic_id, topic FROM scr.topics WHERE topic = :topic';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':topic', $topic[$i], PDO::PARAM_STR);
        $stmt->execute();
        $topic_id = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $query = 'INSERT INTO scr.link (topic_id, scr_id) VALUES (:t_id, :s_id)'; 
        $stmt = $db -> prepare($query);
        $stmt->bindValue(':t_id', $topic_id[0]['topic_id'], PDO::PARAM_INT);
        $stmt->bindValue(':s_id', $scr_ids[0]['id'], PDO::PARAM_INT); 
        $result = $stmt->execute(); 
        
    }

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
    <div>
        <form action="insert.php" method="post">
            <input type="text" name="book" placeholder="Book"><br>
            <input type="text" name="chapter" placeholder="chapter"><br>
            <input type="text" name="verse" placeholder="verse"><br>
            <textarea name="content" cols="30" rows="10"></textarea>
            <?php 
                echo "<br>";
                foreach ($db->query('SELECT topic FROM scr.topics') as $topic) {
                    echo "<input type='checkbox' name='topic[]' value='" . $topic['topic'] . "'>" . $topic['topic'];
                }
            ?>    
            <br><input type="submit" value="Go Go"> 
        </form>
    </div>
    <div>
        <?php
        foreach ($db->query('SELECT id, book, chapter, verse, content FROM scr.scriptures ORDER BY id DESC') as $row)
        {
          echo $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . ' - ' . $row['content'];
          $query = 'SELECT topic FROM scr.scriptures sc LEFT JOIN scr.link l ON id = scr_id LEFT JOIN scr.topics t ON t.topic_id = l.topic_id WHERE id = :scr_id';
          $stmt = $db -> prepare($query);
          $stmt->bindValue(':scr_id', $row['id'], PDO::PARAM_INT);
          $stmt->execute();
          $toppics = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if ($toppics[0]['topic'] != NULL) {
            if (sizeof($toppics) > 1) {
                echo " - Topics:";
                foreach ($toppics as $topic) 
                {
                    echo " " . $topic['topic'];
                }
            } else {
                echo " - Topic:";
                foreach ($toppics as $topic) 
                {
                    echo " " . $topic['topic'];
                }
            }
          }
          
          echo '<br/>';
        }
        ?>
    </div>
</body>
</html>