<?php
session_start();
if (!isset($_SESSION['email'])){
    die ("Not logged in");
}
require_once "pdo.php";
if (isset($_POST['cancel'])){
    header("Location:view.php");
    return;
}
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if ((!isset($_POST['make'])) || strlen($_POST['make']) < 1) {
        $_SESSION['errorlostinfo'] = 'Make is Required';
        header("Location:add.php");
        return;
    } elseif ((!isset($_POST['year'])) || strlen($_POST['year']) < 1) {
        $_SESSION['errorlostinfo'] = 'Year is Required';
        header("Location:add.php");
        return;
    } elseif ((!isset($_POST['mileage'])) || strlen($_POST['mileage']) < 1) {
        $_SESSION['errorlostinfo'] = 'Mileage is Required';
        header("Location:add.php");
        return;
    } elseif ((!is_numeric($_POST['year'])) || (!is_numeric($_POST['mileage']))) {
        $_SESSION['errorlostinfo'] = "Mileage and year must be numeric";
        header("Location:add.php");
        return;
    } else {
        $sql = "INSERT INTO autos (make,year,mileage)
        VALUES (:mk ,:yr ,:mile)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':mk' => $_POST['make'],
            ':yr' => $_POST['year'],
            ':mile' => $_POST['mileage']));
        $_SESSION['success'] = "Record inserted";
        header("Location:view.php");
    }
}
?>

<html>
<header>
    <title>d073c284</title>
</header>
<body>
<?php
print '<strong>Tracking Autos for'.$_SESSION['email'].'<strong>';
if (isset($_SESSION['errorlostinfo'])){
echo ('<p style="color:red">'.$_SESSION['errorlostinfo'].'</p><br>');
unset($_SESSION['errorlostinfo']);
}

?>
<form method="post">
    <label for="Make">Make:</label>
    <input type="text" name="make" id="make"><br>
    <label for="Year">Year:</label>
    <input type="text" name="year" id="year"><br>
    <label for="Mileage">Mileage:</label>
    <input type="text" name="mileage" id="mileage"><br>
    <input type="submit" value="Add">
    <input type="submit" name="cancel" value="Cancel">

</form>
</body>
</html>
