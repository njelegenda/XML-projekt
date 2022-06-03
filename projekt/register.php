<?php
$errors = array();
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    if(file_exists('korisnici/' . $username . '.xml')){
        $errors[] = 'Ime već postoji' ;   
    }
    if ($username == ''){
        $errors[] = 'Unesite ime';
    }
    if($email == ''){
        $errors[] = 'Unesite email';
    }
    if($password == ''){
        $errors[] = 'Unesite lozinku';
    }
    if($c_password == ''){
        $errors[] = 'Ponovno unesite lozinku';
    }
    if($password != $c_password){
        $errors[] = 'Lozinke se ne poklapaju';
    }
    if(count($errors) == 0){
        $xml = new SimpleXMLElement('<user></user>');
        $xml->addChild('email', ($email));
        $xml->addChild('password', md5($password));
        $xml->asXML('korisnici/' . $username . '.xml');
        header('Location: login.php');
        die;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Registracija</title>
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
        h1{
            text-align: center;
        }
        
        </style>
    </head>
    <body>
        <div>
            <h1>Prijava novog korisnika</h1>
            <form method="post" action="">
                <?php
                if(count($errors) > 0){
                    echo '<ul>';
                    foreach($errors as $e){
                        echo '<li>' . $e . '</li>';
                    }
                }
                ?>
                <p>Korisničko ime <input type="text" name="username" size="20" /></p>
                <p>Email <input type="text" name="email" size="20" /></p>
                <p>Lozinka <input type="password" name="password" size="20" /></p>
                <p>Potvrdite lozinku <input type="password" name="c_password" size="20" /></p>
                <p><input type="submit" name="login" value="Registracija" ?></p>
            </form>
            <a href="login.php">Povratak na prijavu</a>
        </div>
    </body>
</html>