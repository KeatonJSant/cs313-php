<?php 
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="shark.png" type="image/gif">
    <link rel="stylesheet" type="text/css" media="screen" href="shopping.css" />
    <title>Epic Sharks | Cart</title>
</head>
<body>
    <header>
        <?php echo $_SESSION['username'] . "'s Cart"; ?>
    </header>
    <div id="navbar">
        <div>
            <a class="element" href="browse.php">browse</a>
        </div>        
    </div>
    <?php 
        foreach ($_SESSION['cart'] as $i => $value) {
            echo "<div>";
            echo "<form class='cart_form' action='remove.php' method='post'>";
            echo "<div class='container'>";
            echo "<div class='item1'>";
            echo "<h4>" . $_SESSION['cart'][$i][0] . "</h4>";
            echo "<p>Price: $" . $_SESSION['cart'][$i][1] . "</p>";
            echo "</div>";
            echo "<div class='item2'>";
            echo "<img class='pokemon_cart' src='" . $_SESSION['cart'][$i][2] . "' alt='" . $_SESSION['cart'][$i][0] . "'>";
            echo "</div>";            
            echo "<input type='hidden' name='product_index' value='$i'>";
            echo "<input type='submit' value='Remove'>";            
            echo "</form>";
            echo "</div>";
        }        
    ?>
    
</body>
</html>