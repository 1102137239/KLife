<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <center>
            <div id="login">
                <form action="Actionlogin.php" method="POST">
                    ±b¸¹:<br>
                    <input type="text" name="account"><br>
                    ±K½X:<br>
                    <input type="password" name="password"><br>                
                    <input type="hidden" name="refer" value="<?php echo (isset($_GET['refer'])) ? $_GET['refer'] : 'index.html'; ?>">
                    <input type="submit" name="submit" value="µn¤J">
                    <!--
                    <a href="./Register.php"><input type="button" name=register" value="µù¥U"></a>
                    <a href="./Alterpw.php"><input type="button" name=register" value="§Ñ°O±K½X"></a>
                    -->
                </form>
            </div>
        </center>
    </body>
</html>
