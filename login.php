<?php

session_start();
if(isset($_POST['cancel'])){
    header("Location:index.php");
    return;
}
if(isset($_POST['email']) && (isset($_POST['pass']))) {
    unset($_SESSION['account']);
    $salt = 'XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
    $check = hash('md5', $salt.$_POST['pass']);
    if(strpos($_POST['email'],'@') == false) {
        $_SESSION['error2']="Email must have an at-sign(@)";
        header("Location:login.php");
        return;
    }


    elseif($stored_hash == $check) {
        $_SESSION["email"] = $_POST['email'];
        $_SESSION["pass"] = $_POST['pass'];
        header('Location:view.php');
        return;
    }

    else {
        $_SESSION['error1']="Incorrect Password";
        header('Location:login.php');
        return;

    }

}

?>

<html>
<header>
    <title>d073c284</title>
</header>
<body>
<strong>Please Log In</strong>
<?php
    if(isset($_SESSION['error1'])){
        echo('<p style="color:red">'.$_SESSION['error1'].'</p><br>');
        unset($_SESSION['error1']);
    }
    else if(isset($_SESSION['error2'])){
        echo('<p style="color:red">'.$_SESSION['error2'].'</p><br>');
        unset($_SESSION['error2']);
    }
?>
<form method="post" action="login.php">
    <label for="email">Email</label>
    <input type="text" name="email" id="'email"><br>
    <label for="pass">Passowrd</label>
    <input type="password" name="pass" id="pass"><br>
    <input type="submit" value="Log In">
    <input type="submit" value="Cancel" name="cancel" id="Cancel">
</form>
</body>
</html>