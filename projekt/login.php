<?php
$error = false;
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if(file_exists('korisnici/' . $username . '.xml')){
        $xml = new SimpleXMLElement('korisnici/' . $username . '.xml', 0, true);
        if($password == $xml->password){
            session_start();
            $_SESSION['username'] = $username;
            header('Location: index.php');
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prijava</title>
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
            font-size: 0.9em;
            font-family: sans-serif;
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
        h2{
            text-align: center;
        }
        
        </style>
    </head>
    <body>
        <div>
            <h2>Arhiv Email adresa zaposlenika </h2>
            <form method="post" action="">
                <p>Korisničko ime <input type="text" name="username" size="20"/></p>
                <p>Lozinka <input type="password" name="password" size="20"/></p>
                <?php
                if($error){
                    echo '<p>Pogrešna lozinka ili ime</p>';
                }
                ?>
                <p><input type="submit" value="Prijava" name="login"/></p>
            </form>
            <a href="register.php">Novi zaposlenik</a>
        </div>
    </body>

</html>
