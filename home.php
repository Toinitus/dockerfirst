<?php
require_once 'db.php';

switch ($_GET['page']){
    case 2:
        $result = $pdo->prepare("SELECT * FROM post LIMIT 10, 10");
        $result->execute(array());
        $article = $result->fetchALL();
        break;

    case 3:
        $result = $pdo->prepare("SELECT * FROM post LIMIT 20, 10");
        $result->execute(array());
        $article = $result->fetchALL();
        break;
    
    case 4:
        $result = $pdo->prepare("SELECT * FROM post LIMIT 30, 10");
        $result->execute(array());
        $article = $result->fetchALL();
        break;

    case 5:
        $result = $pdo->prepare("SELECT * FROM post LIMIT 40, 10");
        $result->execute(array());
        $article = $result->fetchALL();
        break;

    default:
        $result = $pdo->prepare("SELECT * FROM post LIMIT 10");
        $result->execute(array());
        $article = $result->fetchALL();
        break;    
}

//$result = $pdo->prepare("SELECT * FROM post LIMIT 50");
//$result->execute(array());
//$article = $result->fetchALL();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/style.css" rel="stylesheet">
    <title>Afficher</title>
</head>
<body>
    <header>
    <h1>Le test D'Antoine</h1>
    </header>
    <section>
        <?php
            $i = 0;
            while($i< count ($article))
            {
                echo "<article> 
                        <h1>".$article[$i]['name']."</h1>
                        <p>".$article[$i]['content']."</p>     
                    </article> ";
                ++$i;     
            }
         ?>
    </section>
    <footer>
		<div class="divCenter">
			<ul class="pagination">
				<li><a href="?page=1" class="active">1</a></li>
				<li><a href="?page=2">2</a></li>
				<li><a href="?page=3">3</a></li>
				<li><a href="?page=4">4</a></li>
				<li><a href="?page=5">5</a></li>
			</ul>
		</div>
	</footer>
</body>
</html>