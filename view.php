<?php
session_start();
if(!isset($_SESSION['email'])){
    die('Not logged in');
}
if (isset($_POST['logout'])){
    header('Location: index.php');
    return;
}
require_once "pdo.php";


?>
<html>
<header>
    <title>d073c284</title>
</header>
<body>
<?php
print '<strong>Tracking Autos for'.$_SESSION['email'].'<strong>';
if(isset($_SESSION['success'])) {
echo '<p style=color:green>'.$_SESSION['success'].'</p><br>';
}

    ?>

<strong>Automobiles</strong>
<ul>
    <?php
    $stmt=$pdo->query("SELECT make,year,mileage FROM autos");
    $rows=$stmt->fetchALL(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        echo ($row["year"].' '.htmlspecialchars($row["make"]).'/'.$row['mileage'].'<br>');
    }
    ?>
</ul>
<a href="add.php">Add New</a>
<a> | </a>
<a href="logout.php">Logout</a>
</body>
</html>