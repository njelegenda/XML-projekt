<?php
session_start();
if(!file_exists('korisnici/' . $_SESSION['username'] . '.xml')){
    header('Locatio: login.php');
    die;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Popis zaposlenika</title>
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
        h2{
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
            <h2>Dobrodošao, <?php echo $_SESSION['username']; ?></h2>
            <h3>Popis zaposlenika</hr>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $files = glob('korisnici/*.xml');
                foreach($files as $file){
                    $xml = new SimpleXMLElement($file, 0, true);
                    echo '
                    
                        <tr class="styled-table">
                            <td class="centrirano">'. basename($file, '.xml').'</td>
                            <td class="centrirano">'. $xml->email .'</td>
                        </tr>'; 
                }
                ?>
                </tbody>    
            </table>    
            <hr />
            <a href="changepassword.php">Promjena lozinke</a>
            -
            <a href="logout.php">Odjava</a>
        </div>
    </body>
</html>