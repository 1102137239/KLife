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
                    帳號:<br>
                    <input type="text" name="account"><br>
                    密碼:<br>
                    <input type="password" name="password"><br>                
                    <input type="hidden" name="refer" value="<?php echo (isset($_GET['refer'])) ? $_GET['refer'] : 'index.html'; ?>">
                    <input type="submit" name="submit" value="登入">
                </form>
            </div>
        </center>
    </body>
</html>
