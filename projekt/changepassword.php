<?php
session_start();
if(!file_exists('korisnici/' . $_SESSION['username'] . '.xml')){
    header('Locatio: login.php');
    die;
}
$error = false;
if(isset($_POST['change'])){
    $old = md5($_POST['o_password']);
    $new = md5($_POST['n_password']);
    $c_new = md5($_POST['c_n_password']);

    $xml = new SimpleXMLElement('korisnici/' . $_SESSION['username'] . '.xml', 0, true);
    if($old == $xml->password){
        if($new == $c_new){
            $xml->password = $new;
            $xml->asXML('korisnici/' . $_SESSION['username'] . '.xml');
            header('Location: logout.php');
            die;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Promjena lozinke</title>
        <style>
        * {
            box-sizing: border-box;
        }
        div {
            width: 500px;
            border: 15px solid green;
            padding: 50px;
            margin: 20px;
            position: fixed;
            top: 200px;
            left: 650px;
        }
        input {
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border-radius: 5px;
            width: 100%;
        }
        input:focus{
            background-color: beige;
        }
        h1{
            text-align: center;
        }
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .centrirano{
            text-align: center;
        }
        
        </style>
    </head>
    <body>
        <div>
            <h1>Promjena lozinke</h1>
            <form method="post" action="">
                <?php
                if($error){
                    echo '<p>Lozinke se ne poklapaju</p>';
                }
                ?>
                <p>Stara lozinka<input type="password" name="o_password" /></p>
                <p>Nova lozinka<input type="password" name="n_password" /></p>
                <p>Potvrdite lozinku<input type="password" name="c_n_password" /></p>
                <p><input type="submit" name="change" value="Promjenite lozinku" /></p>
            </form>
            <hr />
            <a href="index.php">Povratak na popis</a>
        </div>
    </body>
</html>